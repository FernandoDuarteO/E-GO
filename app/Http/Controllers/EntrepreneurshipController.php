<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrepreneurship;
use App\Http\Requests\EntrepreneurshipRequest;

use App\Models\Entrepreneur;
use App\Models\Client;


class EntrepreneurshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entrepreneurships = Entrepreneurship::with('entrepreneur', 'client')->paginate(5);
        return view('entrepreneurships.index', compact('entrepreneurships'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $entrepreneurships = new Entrepreneurship();
        $entrepreneurs = Entrepreneur::all();
        $clients = Client::all();
        return view('entrepreneurships.create', compact('entrepreneurships', 'entrepreneurs', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EntrepreneurshipRequest $request)
{
    $data = $request->validated();

    if ($request->hasFile('media_file')) {
        $file = $request->file('media_file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('uploads', $filename, 'public');
        $data['media_file'] = $path;
    }

    Entrepreneurship::create($data);

    return redirect()->route('entrepreneurships.index')->with('success', 'Emprendimiento creado con éxito');
}

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $entrepreneurships = Entrepreneurship::find($id);
        $entrepreneurs = Entrepreneur::all();
        $clients = Client::all();
        return view('entrepreneurships.show', compact('entrepreneurships', 'entrepreneurs', 'clients'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $entrepreneurships = Entrepreneurship::find($id);
        $entrepreneurs = Entrepreneur::all();
        $clients = Client::all();
        return view('entrepreneurships.edit', compact('entrepreneurships', 'entrepreneurs', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EntrepreneurshipRequest $request, Entrepreneurship $entrepreneurship)
    {
    $data = $request->validated();

    if ($request->hasFile('media_file')) {
        $file = $request->file('media_file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('uploads', $filename, 'public');
        $data['media_file'] = $path;
    }

    $entrepreneurship->update($data);

    return redirect()->route('entrepreneurships.index')->with('success', 'Emprendimiento actualizado con éxito');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $entrepreneurships = Entrepreneurship::find($id);
        $entrepreneurships->delete();
        return redirect()->route('entrepreneurships.index')->with('deleted', 'Emprendimiento eliminado con éxito.');
    }
}
