<?php

namespace App\Http\Controllers;

use App\Models\detalleCompra;
use App\Models\Producto;
use Illuminate\Http\Request;

class DetalleCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $producto = Producto::where('codigo', $request->input('codigo'))->first();

        if ($producto) {
            $detalleCompra = DetalleCompra::where('producto_id', $producto->id)
                ->where('compra_id', $request->input('compra_id'))
                ->first();
            if ($detalleCompra) {
                // Si ya existe, actualizar la cantidad
                $detalleCompra->cantidad += $request->input('cantidad');
                $detalleCompra->save();
                return response()->json(['success' => true, 'message' => 'Producto agregado correctamente', 'data' => $request->all()], 200);
            } else {
                // Si no existe, crear un nuevo registro
                $detalleCompra = new DetalleCompra();
                $detalleCompra->producto_id = $producto->id;
               
                $detalleCompra->cantidad = $request->input('cantidad');
                $detalleCompra->compra_id = $request->input('compra_id');
               
                $detalleCompra->save();
                return response()->json(['success' => true, 'message' => 'Producto agregado correctamente', 'data' => $request->all()], 200);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Producto no encontrado'], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(detalleCompra $detalleCompra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(detalleCompra $detalleCompra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, detalleCompra $detalleCompra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DetalleCompra::destroy($id);
        return response()->json(['success' => true]);
    }
}
