<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use App\Http\Requests\LoginRequest;

use App\Models\Register;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logins = Login::with('register')->paginate(5);
        return view('logins.index', compact('logins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $logins = new Login();
        $registers = Register::all();
        return view('logins.create', compact('logins', 'registers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LoginRequest $request)
    {
        Login::create($request->validated());
        return redirect()->route('logins.index')->with('success', 'Login creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $logins = Login::find($id);
        $registers = Register::all();
        return view('logins.show', compact('logins', 'registers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $logins = Login::find($id);
        $registers = Register::all();
        return view('logins.edit', compact('logins', 'registers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LoginRequest $request, int $id)
    {
        $logins = Login::find($id);
        $logins->update($request->validated());
        return redirect()->route('logins.index')->with('updated', 'Login actualizado con éxito.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $logins = Login::find($id);
        $logins->delete();
        return redirect()->route('logins.index')->with('deleted', 'Login eliminado con éxito.');
    }
}
