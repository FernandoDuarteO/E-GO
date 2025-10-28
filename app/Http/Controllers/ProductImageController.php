<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductImageRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function __construct()
    {
        // Ajusta middleware si lo necesitas (auth, can:manage-product, etc.)
        $this->middleware('auth')->except(['index']);
    }

    /**
     * Store one or multiple images for a product.
     *
     * Accepts either:
     *  - file (single upload) OR
     *  - media_files[] (multiple uploads)
     *
     * Optional: order / orders[], alt / alts[] to set metadata.
     */
    public function store(ProductImageRequest $request)
    {
        $validated = $request->validated();

        $product = Product::findOrFail($validated['product_id']);

        $created = [];

        DB::beginTransaction();
        try {
            // Single file upload (file)
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $path = $file->store('products', 'public');

                $image = $product->images()->create([
                    'file_path' => $path,
                    'order' => $validated['order'] ?? null,
                    'alt' => $validated['alt'] ?? null,
                ]);

                $created[] = $image;
            }

            // Multiple files upload (media_files[])
            if ($request->hasFile('media_files')) {
                $files = $request->file('media_files');
                $orders = $validated['orders'] ?? [];
                $alts = $validated['alts'] ?? [];

                foreach ($files as $index => $file) {
                    $path = $file->store('products', 'public');

                    // Determine order and alt for this file if provided (orders/alts arrays indexed to files order)
                    $order = isset($orders[$index]) ? (int) $orders[$index] : $index;
                    $alt = $alts[$index] ?? null;

                    $image = $product->images()->create([
                        'file_path' => $path,
                        'order' => $order,
                        'alt' => $alt,
                    ]);

                    $created[] = $image;
                }
            }

            DB::commit();

            // Si es petición AJAX JSON, devolver los recursos creados
            if ($request->wantsJson()) {
                return response()->json(['created' => $created], 201);
            }

            return redirect()->back()->with('success', 'Imágenes guardadas correctamente.');
        } catch (\Throwable $e) {
            DB::rollBack();
            // borrar archivos que hayan quedado si es necesario (no estrictamente implementado aquí)
            return redirect()->back()->withErrors(['error' => 'Error al guardar las imágenes: ' . $e->getMessage()]);
        }
    }

    /**
     * Update metadata of a product image or replace its file.
     * Expects:
     *  - optional 'file' to replace the image file
     *  - optional 'order', 'alt'
     */
    public function update(ProductImageRequest $request, ProductImage $productImage)
    {
        // ProductImageRequest works here because rules use sometimes / required_without
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            // Replace file if provided
            if ($request->hasFile('file')) {
                // delete old file if exists
                if ($productImage->file_path && Storage::disk('public')->exists($productImage->file_path)) {
                    Storage::disk('public')->delete($productImage->file_path);
                }
                $file = $request->file('file');
                $path = $file->store('products', 'public');
                $productImage->file_path = $path;
            }

            if (array_key_exists('order', $validated)) {
                $productImage->order = $validated['order'];
            }

            if (array_key_exists('alt', $validated)) {
                $productImage->alt = $validated['alt'];
            }

            // If product_id is provided and different, re-assign (optional)
            if (array_key_exists('product_id', $validated) && $validated['product_id'] != $productImage->product_id) {
                $product = Product::findOrFail($validated['product_id']);
                $productImage->product()->associate($product);
            }

            $productImage->save();
            DB::commit();

            if ($request->wantsJson()) {
                return response()->json(['image' => $productImage], 200);
            }

            return redirect()->back()->with('success', 'Imagen actualizada correctamente.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Error al actualizar la imagen: ' . $e->getMessage()]);
        }
    }

    /**
     * Delete a product image (DB row + storage file).
     */
    public function destroy(Request $request, ProductImage $productImage)
    {
        DB::beginTransaction();
        try {
            // delete file from storage if exists
            if ($productImage->file_path && Storage::disk('public')->exists($productImage->file_path)) {
                Storage::disk('public')->delete($productImage->file_path);
            }

            $productImage->delete();
            DB::commit();

            if ($request->wantsJson()) {
                return response()->json(['deleted' => true], 200);
            }

            return redirect()->back()->with('success', 'Imagen eliminada correctamente.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Error al eliminar la imagen: ' . $e->getMessage()]);
        }
    }

    /**
     * Reorder multiple images. Accepts an array like:
     *  orders: [{id: 12, order: 0}, {id: 15, order: 1}, ...]
     *
     * This endpoint is useful when you allow drag & drop ordering in the UI.
     */
    public function reorder(Request $request)
    {
        $data = $request->validate([
            'orders' => ['required', 'array'],
            'orders.*.id' => ['required', 'integer', 'exists:product_images,id'],
            'orders.*.order' => ['required', 'integer'],
        ]);

        DB::beginTransaction();
        try {
            foreach ($data['orders'] as $row) {
                ProductImage::where('id', $row['id'])->update(['order' => (int) $row['order']]);
            }
            DB::commit();

            return response()->json(['updated' => true], 200);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}