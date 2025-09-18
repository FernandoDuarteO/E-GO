<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Http\Requests\CourseRequest;

use App\Models\Entrepreneur;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('entrepreneur')->paginate(5);
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = new Course();
        $entrepreneurs = Entrepreneur::all();
        return view('courses.create', compact('courses', 'entrepreneurs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseRequest $request)
    {
        Course::create($request->validated());
        return redirect()->route('courses.index')->with('success', 'Curso creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $courses = Course::find($id);
        $entrepreneurs = Entrepreneur::all();
        return view('courses.show', compact('courses', 'entrepreneurs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $courses = Course::find($id);
        $entrepreneurs = Entrepreneur::all();
        return view('courses.edit', compact('courses', 'entrepreneurs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseRequest $request, int $id)
    {
        $courses = Course::find($id);
        $courses->update($request->validated());
        return redirect()->route('courses.index')->with('updated', 'Curso actualizado con éxito.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $courses = Course::find($id);
        $courses->delete();
        return redirect()->route('courses.index')->with('deleted', 'Curso eliminado con éxito.');
    }
}
