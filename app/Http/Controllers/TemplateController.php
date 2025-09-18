<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use App\Http\Requests\TemplateRequest;

use App\Models\Entrepreneur;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $templates = Template::with('entrepreneur')->paginate(5);
        return view('templates.index', compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $templates = new Template();
        $entrepreneurs = Entrepreneur::all();
        return view('templates.create', compact('templates', 'entrepreneurs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TemplateRequest $request)
    {
        Template::create($request->validated());
        return redirect()->route('templates.index')->with('success', 'Plantilla creada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $templates = Template::find($id);
        $entrepreneurs = Entrepreneur::all();
        return view('templates.show', compact('templates', 'entrepreneurs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $templates = Template::find($id);
        $entrepreneurs = Entrepreneur::all();
        return view('templates.edit', compact('templates', 'entrepreneurs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TemplateRequest $request, int $id)
    {
        $templates = Template::find($id);
        $templates->update($request->validated());
        return redirect()->route('templates.index')->with('updated', 'Plantilla actualizada con éxito.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $templates = Template::find($id);
        $templates->delete();
        return redirect()->route('templates.index')->with('deleted', 'Plantilla eliminada con éxito.');
    }
}
