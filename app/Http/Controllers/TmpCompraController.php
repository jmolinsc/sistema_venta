<?php

namespace App\Http\Controllers;

use App\Models\TmpCompra;
use App\Models\Producto;
use Illuminate\Http\Request;

class TmpCompraController extends Controller
{

    public function tmp_compras(Request $request)
    {
        //
        $producto = Producto::where('codigo', $request->input('codigo'))->first();

        if ($producto) {
            $tmpCompra = TmpCompra::where('producto_id', $producto->id)
                ->where('session_id', session()->getId())
                ->first();
            if ($tmpCompra) {
                // Si ya existe, actualizar la cantidad
                $tmpCompra->cantidad += $request->input('cantidad');
                $tmpCompra->save();
                return response()->json(['success' => true, 'message' => 'Producto agregado correctamente', 'data' => $request->all()], 200);
            } else {
                // Si no existe, crear un nuevo registro
                $tmpCompra = new TmpCompra();
                $tmpCompra->producto_id = $producto->id;
                $tmpCompra->cantidad = $request->input('cantidad');
                $tmpCompra->session_id = session()->getId();
                $tmpCompra->save();
                return response()->json(['success' => true, 'message' => 'Producto agregado correctamente', 'data' => $request->all()], 200);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Producto no encontrado'], 200);
        }
    }


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
    }

    /**
     * Display the specified resource.
     */
    public function show(TmpCompra $tmpCompra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TmpCompra $tmpCompra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TmpCompra $tmpCompra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        TmpCompra::destroy($id);
        return response()->json(['success' => true, 'message' => 'Producto eliminado correctamente'], 200);
    }
}
