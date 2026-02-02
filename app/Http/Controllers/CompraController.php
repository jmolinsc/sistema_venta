<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Empresa;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\TmpCompra;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $compras = Compra::with('detalle')->get();

        return view('admin.compras.index', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $productos = Producto::where('empresa_id', Auth::user()->empresa_id)->get();
        $proveedores = Proveedor::where('empresa_id', Auth::user()->empresa_id)->get();
        $tmp_compras = TmpCompra::where('session_id', session()->getId())->get();

        return view('admin.compras.create', compact('productos', 'proveedores', 'tmp_compras'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'fecha' => 'required|date',
            'comprobante' => 'required|string|max:100',
            'precio_total' => 'required|numeric|min:0',

        ]);
        // Lógica para almacenar la compra
        $compra = new Compra();
        $compra->fecha = $request->fecha;
        $compra->comprobante = $request->comprobante;
        $compra->precio_total = $request->precio_total;
        $compra->empresa_id = Auth::user()->empresa_id;
        $compra->proveedor_id = $request->proveedor_id;
        $compra->save();

        $tmp_compras = TmpCompra::where('session_id', session()->getId())->get();
        foreach ($tmp_compras as $tmp) {
            $producto = Producto::where('id', $tmp->producto_id)->first();
            $detalle = new DetalleCompra();
            $detalle->compra_id = $compra->id;
            $detalle->producto_id = $tmp->producto_id;
            $detalle->cantidad = $tmp->cantidad;
            $detalle->save();

            $producto->stock += $tmp->cantidad;
            $producto->save();
        }

        TmpCompra::where('session_id', session()->getId())->delete();
        return redirect()->route('admin.compras.index')
            ->with('mensaje', 'Compra registrada exitosamente.')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //

        $compra = Compra::with('detalle', 'proveedor')->findOrFail($id);
        return view('admin.compras.show', compact('compra'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $compra = Compra::with('detalle', 'proveedor')->findOrFail($id);
        $proveedores = Proveedor::all();
        $productos = Producto::all();
        return view('admin.compras.edit', compact('compra', 'proveedores', 'productos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        //
        $request->validate([
            'fecha' => 'required|date',
            'comprobante' => 'required|string|max:100',
            'precio_total' => 'required|numeric|min:0',

        ]);
        // Lógica para almacenar la compra
        $compra = Compra::findOrFail($id);
        $compra->fecha = $request->fecha;
        $compra->comprobante = $request->comprobante;
        $compra->precio_total = $request->precio_total;
        $compra->empresa_id = Auth::user()->empresa_id;
        $compra->proveedor_id = $request->proveedor_id;
        $compra->save();

        return redirect()->route('admin.compras.index')
            ->with('mensaje', 'Compra actualizada exitosamente.')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        //
        $compra = Compra::findOrFail($id);
        
        foreach ($compra->detalle as $detalle) {
            $producto = Producto::where('id', $detalle->producto_id)->first();
            $producto->stock -= $detalle->cantidad;
            $producto->save();
        }

        $compra->destroy($id);

        return redirect()->route('admin.compras.index')
            ->with('mensaje', 'Compra eliminada exitosamente.')
            ->with('icono', 'success');
    }
}
