<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Proveedor;
use Spatie\Permission\Models\Role;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function index()
    {
        $totalRoles = Role::count();
        $totalusuarios = User::count();
        $totalcategorias = Categoria::count();
        $totalproductos = Producto::count();
        $empresa_id = Auth::check() ? Auth::user()->empresa_id : redirect()->route('login')->send();
        $empresa = Empresa::where('id', $empresa_id)->first();
        $totalproveedores = Proveedor::count();
        return view('admin.index', compact('empresa', 'totalRoles',
         'totalusuarios', 'totalcategorias', 'totalproductos','totalproveedores'));
    }
}
