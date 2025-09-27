<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrepreneur;
use App\Http\Requests\EntrepreneurRequest;

class EntrepreneurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entrepreneurs = Entrepreneur::latest()->paginate(5);
        return view('entrepreneurs.index', compact('entrepreneurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $entrepreneurs = new Entrepreneur();
        return view('entrepreneurs.create', compact('entrepreneurs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EntrepreneurRequest $request)
    {
    $data = $request->validated();

    if ($request->hasFile('media_file')) {
        $file = $request->file('media_file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('uploads', $filename, 'public');
        $data['media_file'] = $path;
    }

    Entrepreneur::create($data);

    return redirect()->route('entrepreneurs.index')->with('success', 'Emprendedor creado con éxito');
}

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $entrepreneurs = Entrepreneur::find($id);
        return view('entrepreneurs.show', compact('entrepreneurs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $entrepreneurs = Entrepreneur::find($id);
        return view('entrepreneurs.edit', compact('entrepreneurs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EntrepreneurRequest $request, Entrepreneur $entrepreneur)
{
    $data = $request->validated();

    if ($request->hasFile('media_file')) {
        $file = $request->file('media_file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('uploads', $filename, 'public');
        $data['media_file'] = $path;
    }

    $entrepreneur->update($data);

    return redirect()->route('entrepreneurs.index')->with('success', 'Emprendedor actualizado con éxito');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $entrepreneurs = Entrepreneur::find($id);
        $entrepreneurs->delete();

        return redirect()->route('entrepreneurs.index')->with('deleted', 'Emprendedor eliminado correctamente');
    }
}
