<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Entrepreneur;
use App\Models\Entrepreneurship;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form (Breeze original).
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information (Breeze original).
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Show combined view (entrepreneur + entrepreneurship).
     * Tries to find records created during registration and link them.
     */
    public function showProfile(): View
    {
        $user = Auth::user();

        // Try to load entrepreneur by user_id
        $entrepreneur = Entrepreneur::where('user_id', $user->id)->first();

        // Try to load entrepreneurship related
        $entrepreneurship = null;

        if ($entrepreneur) {
            // Load hasOne relation if defined
            if (method_exists($entrepreneur, 'entrepreneurship')) {
                $entrepreneurship = $entrepreneur->entrepreneurship()->first();
            }

            // If no related entrepreneurship found, try to find by user_id
            if (! $entrepreneurship) {
                $entrepreneurship = Entrepreneurship::where('user_id', $user->id)->first();
                if ($entrepreneurship && ! $entrepreneurship->entrepreneur_id) {
                    $entrepreneurship->entrepreneur_id = $entrepreneur->id;
                    $entrepreneurship->save();
                }
            }
        } else {
            // No entrepreneur record: maybe entrepreneurship was created at registration
            $entrepreneurship = Entrepreneurship::where('user_id', $user->id)->first();

            if ($entrepreneurship) {
                // Create (or get) entrepreneur and link
                $entrepreneur = Entrepreneur::firstOrCreate(
                    ['user_id' => $user->id],
                    ['name' => $user->name ?? $entrepreneurship->business_name ?? '']
                );

                if (! $entrepreneurship->entrepreneur_id) {
                    $entrepreneurship->entrepreneur_id = $entrepreneur->id;
                    $entrepreneurship->save();
                }
            } else {
                // Neither exists: return an empty entrepreneur (will be filled by the form)
                $entrepreneur = Entrepreneur::firstOrNew(['user_id' => $user->id]);
                $entrepreneurship = null;
            }
        }

        return view('profile_combined.show', compact('user', 'entrepreneur', 'entrepreneurship'));
    }

    /**
     * Helper: sanitize validated data
     * - Trim strings but KEEP empty strings (don't convert to null)
     * - For numeric fields, keep '' as '' (we convert to 0 when assigning if necessary)
     */
    protected function sanitizeValidated(array $data): array
    {
        foreach ($data as $k => $v) {
            if (is_string($v)) {
                $data[$k] = trim($v);
            }
        }
        return $data;
    }

    /**
     * Update entrepreneur profile (personal).
     * Also updates User name/email when present so header shows updated name.
     *
     * Important behaviour:
     * - If user clears a text field and submits (sends empty string), we persist empty string ''
     *   (this avoids DB errors when column is NOT NULL and also shows as empty in the form).
     * - For numeric fields (age) if user submits empty string we save 0 (adjust if you prefer NULL).
     */
    public function updateProfile(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'age' => 'nullable|integer|min:0',
            'sex' => 'nullable|string|max:10',
            'identification_card' => 'nullable|string|max:50',
            'telephone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'country' => 'nullable|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'municipality' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'media_file' => 'nullable|image|max:4096',
        ]);

        // Sanitize: trim strings but keep empty strings
        $data = $this->sanitizeValidated($data);

        // Update user fields if present in request.
        // Safety: do NOT overwrite user->name with NULL; only update if non-empty string provided.
        if (array_key_exists('name', $data) && $data['name'] !== null && $data['name'] !== '') {
            $user->name = $data['name'];
        }

        if (array_key_exists('email', $data) && $data['email'] !== null && $data['email'] !== '') {
            if ($data['email'] !== $user->email) {
                $user->email = $data['email'];
                $user->email_verified_at = null;
            }
        }

        $user->save();

        // Get or prepare entrepreneur
        $entrepreneur = Entrepreneur::firstOrNew(['user_id' => $user->id]);

        // Fields we allow to be cleared (saved as empty string)
        $entrepreneurFields = [
            'name', 'sex', 'identification_card', 'telephone',
            'email', 'country', 'nationality', 'municipality', 'department'
        ];

        foreach ($entrepreneurFields as $f) {
            if (array_key_exists($f, $data)) {
                // assign even if empty string
                $entrepreneur->$f = $data[$f] === null ? '' : $data[$f];
            }
        }

        // Age: numeric. If user sent an empty string (''), set to 0 to avoid NOT NULL failures.
        if (array_key_exists('age', $data)) {
            if ($data['age'] === null || $data['age'] === '') {
                $entrepreneur->age = 0;
            } else {
                $entrepreneur->age = (int) $data['age'];
            }
        }

        // Handle avatar upload (entrepreneur)
        if ($request->hasFile('media_file')) {
            $path = $request->file('media_file')->store('avatars', 'public');

            // Optional: delete old file
            // if (! empty($entrepreneur->media_file)) {
            //     Storage::disk('public')->delete($entrepreneur->media_file);
            // }

            $entrepreneur->media_file = $path;
        }

        $entrepreneur->user_id = $user->id;
        $entrepreneur->save();

        return Redirect::route('profile.combined.show')->with('success', 'Perfil guardado correctamente.');
    }

    /**
     * Update entrepreneurship (business) data.
     * Uses transaction to keep entrepreneur and business consistent.
     * Accepts business_media_file for business photo/logo upload.
     */
    public function updateBusiness(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:2000',
            'address' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'business_media_file' => 'nullable|image|max:4096',
            'business_name' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'years_experience' => 'nullable|integer|min:0',
            'business_type' => 'nullable|string|max:255',
        ]);

        $data = $this->sanitizeValidated($data);

        DB::beginTransaction();
        try {
            // Ensure entrepreneur exists (migrations now provide defaults, so firstOrCreate is safe)
            $entrepreneur = Entrepreneur::firstOrCreate(
                ['user_id' => $user->id],
                ['name' => $user->name ?? ($data['business_name'] ?? '')]
            );

            // Find business by entrepreneur_id or user_id
            $business = Entrepreneurship::where('entrepreneur_id', $entrepreneur->id)
                ->orWhere('user_id', $user->id)
                ->first();

            if (! $business) {
                $business = new Entrepreneurship();
                $business->entrepreneur_id = $entrepreneur->id;
                $business->user_id = $user->id;
            }

            // Assign business fields (allow clearing for text fields -> save empty string)
            $businessFields = [
                'name', 'description', 'address', 'type', 'telephone',
                'email', 'business_name', 'department', 'business_type'
            ];
            foreach ($businessFields as $f) {
                if (array_key_exists($f, $data)) {
                    $business->$f = $data[$f] === null ? '' : $data[$f];
                }
            }

            // years_experience numeric: if empty -> 0
            if (array_key_exists('years_experience', $data)) {
                if ($data['years_experience'] === null || $data['years_experience'] === '') {
                    $business->years_experience = 0;
                } else {
                    $business->years_experience = (int) $data['years_experience'];
                }
            }

            // Handle business logo/photo upload (business_media_file)
            if ($request->hasFile('business_media_file')) {
                $path = $request->file('business_media_file')->store('logos', 'public');

                // Optional: delete previous logo
                // if (! empty($business->media_file)) {
                //     Storage::disk('public')->delete($business->media_file);
                // }

                $business->media_file = $path;
            }

            $business->save();

            // Ensure linkage (defensive)
            if ($business->entrepreneur_id !== $entrepreneur->id) {
                $business->entrepreneur_id = $entrepreneur->id;
                $business->save();
            }

            DB::commit();

            return Redirect::route('profile.combined.show')->with('success', 'Emprendimiento guardado correctamente.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return Redirect::route('profile.combined.show')->with('error', 'Error al guardar el emprendimiento: ' . $e->getMessage());
        }
    }

    /**
     * Delete the user's account. (requires password)
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Delete the user's account (no password flow, e.g., social users).
     */
    public function destroyAccount(Request $request): RedirectResponse
    {
        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('status', 'Tu cuenta ha sido eliminada exitosamente.');
    }
}