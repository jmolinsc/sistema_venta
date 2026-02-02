<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $clientes = Cliente::all();
        return view('admin.clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('admin.clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nombre_cliente' => 'required|string|max:255',
            'nit_codigo' => 'required|string|max:50',
            'email' => 'required|string|email|max:255',
            'telefono' => 'required|string|max:20',
        ]);
        $cliente = new Cliente();
        $cliente->nombre_cliente = $request->input('nombre_cliente');
        $cliente->nit_codigo = $request->input('nit_codigo');
        $cliente->email = $request->input('email');
        $cliente->telefono = $request->input('telefono');
        $cliente->save();
        return redirect()->route('admin.clientes.index')
            ->with('mensaje', 'Cliente creado exitosamente.')
            ->with('tipo', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
        $cliente = Cliente::findOrFail($id);
        return view('admin.clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        //
        $cliente = Cliente::findOrFail($id);
        return view('admin.clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'nombre_cliente' => 'required|string|max:255',
            'nit_codigo' => 'required|string|max:50',
            'email' => 'required|string|email|max:255',
            'telefono' => 'required|string|max:20',
        ]);
        $cliente = Cliente::findOrFail($id);
        $cliente->nombre_cliente = $request->input('nombre_cliente');
        $cliente->nit_codigo = $request->input('nit_codigo');
        $cliente->email = $request->input('email');
        $cliente->telefono = $request->input('telefono');
        $cliente->save();
        return redirect()->route('admin.clientes.index')
            ->with('mensaje', 'Cliente modificado exitosamente.')
            ->with('tipo', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Cliente::destroy($id);
        return redirect()->route('admin.clientes.index')
            ->with('mensaje', 'Cliente eliminado exitosamente.')
            ->with('tipo', 'success');
    }
}
