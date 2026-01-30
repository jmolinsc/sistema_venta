<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $productos = Producto::with('categoria')->get();
        return view('admin.productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categorias = Categoria::all();
        return view('admin.productos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'codigo' => 'required|string|max:255|unique:productos,codigo',
            'nombre' => 'required|string|max:255',
            'stock' => 'required|integer',
            'stock_minimo' => 'required|integer',
            'stock_maximo' => 'required|integer',
            'precio_compra' => 'required|numeric',
            'precio_venta' => 'required|numeric',
            'fecha_ingreso' => 'required|date',
            'categoria_id' => 'required|exists:categorias,id',
            'descripcion' => 'nullable|string',
        ]);
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->codigo = $request->codigo;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->stock = $request->stock;
        $producto->stock_minimo = $request->stock_minimo;
        $producto->fecha_ingreso = $request->fecha_ingreso;
        $producto->categoria_id = $request->categoria_id;
        $producto->descripcion = $request->descripcion;
        $producto->empresa_id = Auth::user()->empresa_id;
        // Manejo del imagen (si se proporciona)
        if ($request->hasFile('imagen')) {
            Storage::delete('public/' . $producto->imagen); // Eliminar el imagen anterior
            $file = $request->file('imagen');
            $imagenPath = $file->store('productos', 'public'); // Almacenar en el disco 'public'
            $producto->imagen = $imagenPath;
        }
        $producto->save();
        return redirect()->route('admin.productos.index')->with('mensaje', 'Producto creado exitosamente.')->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $producto = Producto::find($id);
        return view('admin.productos.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $producto = Producto::find($id);
        $categorias = Categoria::all();
        return view('admin.productos.edit', compact('producto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'codigo' => 'required|string|max:255|unique:productos,codigo,' . $id,
            'nombre' => 'required|string|max:255',
            'stock' => 'required|integer',
            'stock_minimo' => 'required|integer',
            'stock_maximo' => 'required|integer',
            'precio_compra' => 'required|numeric',
            'precio_venta' => 'required|numeric',
            'fecha_ingreso' => 'nullable|date',
            'categoria_id' => 'required|exists:categorias,id',
            'descripcion' => 'nullable|string',
        ]);
        $producto = Producto::find($id);
        $producto->nombre = $request->nombre;
        $producto->codigo = $request->codigo;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->stock = $request->stock;
        $producto->stock_minimo = $request->stock_minimo;
        $producto->stock_maximo = $request->stock_maximo;
        $producto->fecha_ingreso = $request->fecha_ingreso;
        $producto->categoria_id = $request->categoria_id;
        $producto->descripcion = $request->descripcion;
        $producto->empresa_id = Auth::user()->empresa_id;
        // Manejo del imagen (si se proporciona)
        if ($request->hasFile('imagen')) {
            Storage::delete('public/' . $producto->imagen); // Eliminar el imagen anterior  
            $file = $request->file('imagen');
            $imagenPath = $file->store('productos', 'public'); // Almacenar en el disco 'public'
            $producto->imagen = $imagenPath;
        }
        $producto->save();
        return redirect()->route('admin.productos.index')->with('mensaje', 'Producto actualizado exitosamente.')->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $producto = Producto::find($id);
        // Eliminar el imagen asociado si existe
        if ($producto->imagen) {
            Storage::delete('public/' . $producto->imagen);
        }
        Producto::destroy($id);

        return redirect()->route('admin.productos.index')->with('mensaje', 'Producto eliminado exitosamente.')->with('icono', 'success');
    }
}
