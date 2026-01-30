<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.empresas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()

    {
        //
        $paises = DB::table('countries')->get();
        $estados = DB::table('states')->get();
        $ciudades = DB::table('cities')->get();
        $monedas = DB::table('currencies')->get();

        return view('admin.empresas.create', compact('paises', 'estados', 'ciudades', 'monedas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nombre_empresa' => 'required|string|max:255',
            'correo' => 'required|email|unique:empresas,correo',
            'cantidad_impuesto' => 'required|integer',
            'nombre_impuesto' => 'required|string|max:255',
            'moneda' => 'required|string|max:10',
            'direccion' => 'required|string|max:500',
            'ciudad' => 'required|string|max:255',
            'departamento' => 'required|string|max:255',
            'codigo_postal' => 'required|string|max:20',
            'pais' => 'required|string|max:255',
            'tipo_empresa' => 'required|string|max:255',
            'nit' => 'required|string|max:100|unique:empresas,nit',
            'telefono' => 'required|string|max:20',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:5120', // Logo es opcional
        ]);

        $empresa = new Empresa();
        $empresa->nombre_empresa = $request->input('nombre_empresa');
        $empresa->correo = $request->input('correo');
        $empresa->cantidad_impuesto = $request->input('cantidad_impuesto');
        $empresa->nombre_impuesto = $request->input('nombre_impuesto');
        $empresa->moneda = $request->input('moneda');
        $empresa->direccion = $request->input('direccion');
        $empresa->ciudad = $request->input('ciudad');
        $empresa->departamento = $request->input('departamento');
        $empresa->codigo_postal = $request->input('codigo_postal');
        $empresa->pais = $request->input('pais');
        $empresa->tipo_empresa = $request->input('tipo_empresa');
        $empresa->nit = $request->input('nit');
        $empresa->telefono = $request->input('telefono');
        // Manejo del logo (si se proporciona)
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $logoPath = $file->store('logos', 'public'); // Almacenar en el disco 'public'
            $empresa->logo = $logoPath;
        }
        $empresa->save();

        $usuario = new User();
        $usuario->name = "Admin";
        $usuario->email = $request->input('correo');
        $usuario->password = Hash::make($request['nit']); // Cambiar a una contraseña segura o generar aleatoriamente
        $usuario->empresa_id = $empresa->id;
        $usuario->save();
        $usuario->assignRole('Administrador');
        Auth::login($usuario);

        return redirect()->route('admin.index')->with('success', 'Empresa creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        //
        $paises = DB::table('countries')->get();
        $estados = DB::table('states')->get();
        $ciudades = DB::table('cities')->get();
        $monedas = DB::table('currencies')->get();
        $empresa = Empresa::where('id', Auth::user()->empresa_id)->first();
        $departamentos = DB::table('states')->where('country_id', $empresa->pais)->get();
        $ciudades = DB::table('cities')->where('state_id', $empresa->departamento)->get();

        return view('admin.settings.edit', compact('paises', 'estados', 'ciudades', 'monedas', 'empresa', 'departamentos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'nombre_empresa' => 'required|string|max:255',
            'correo' => 'required|email|unique:empresas,correo,' . $id,
            'cantidad_impuesto' => 'required|integer',
            'nombre_impuesto' => 'required|string|max:255',
            'moneda' => 'required|string|max:10',
            'direccion' => 'required|string|max:500',
            'ciudad' => 'required|string|max:255',
            'departamento' => 'required|string|max:255',
            'codigo_postal' => 'required|string|max:20',
            'pais' => 'required|string|max:255',
            'tipo_empresa' => 'required|string|max:255',
            'nit' => 'required|string|max:100|unique:empresas,nit,' . $id,
            'telefono' => 'required|string|max:20',
        ]);

        $empresa = Empresa::findOrFail($id);
        $empresa->nombre_empresa = $request->input('nombre_empresa');
        $empresa->correo = $request->input('correo');
        $empresa->cantidad_impuesto = $request->input('cantidad_impuesto');
        $empresa->nombre_impuesto = $request->input('nombre_impuesto');
        $empresa->moneda = $request->input('moneda');
        $empresa->direccion = $request->input('direccion');
        $empresa->ciudad = $request->input('ciudad');
        $empresa->departamento = $request->input('departamento');
        $empresa->codigo_postal = $request->input('codigo_postal');
        $empresa->pais = $request->input('pais');
        $empresa->tipo_empresa = $request->input('tipo_empresa');
        $empresa->nit = $request->input('nit');
        $empresa->telefono = $request->input('telefono');
        // Manejo del logo (si se proporciona)
        if ($request->hasFile('logo')) {
            Storage::delete('public/' . $empresa->logo); // Eliminar el logo anterior
            $file = $request->file('logo');
            $logoPath = $file->store('logos', 'public'); // Almacenar en el disco 'public'
            $empresa->logo = $logoPath;
        }
        $empresa->save();

        $usuario = User::findOrFail(Auth::user()->id);
        $usuario->name = "Admin";
        $usuario->email = $request->input('correo');
        $usuario->password = Hash::make($request['nit']); // Cambiar a una contraseña segura o generar aleatoriamente
        $usuario->empresa_id = $empresa->id;
        $usuario->save();


        return redirect()->route('admin.index')
            ->with('mensaje', 'Se actualizaron los datos exitosamente.')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        //
    }

    public function buscar_estado($pais)
    {
        try {
            $estados = DB::table('states')->where('country_id', $pais)->get();
            return response()->json($estados);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los estados'], 500);
        }
    }
    public function buscar_ciudad($id_estado)
    {
        try {
            $ciudades = DB::table('cities')->where('state_id', $id_estado)->get();
            return response()->json($ciudades);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener las ciudades'], 500);
        }
    }
}
