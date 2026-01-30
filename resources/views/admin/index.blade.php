@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><b>Bienvenido {{ $empresa->nombre_empresa }}</b></h1>
    <hr>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box zoomP">
                <a href="{{ url('admin/roles') }}" class="info-box-icon bg-info"><i class="fas fa-user-check"></i></a>


                <div class="info-box-content">
                    <span class="info-box-text">Roles registrados</span>
                    <span class="info-box-number">{{ $totalRoles }} roles</span>
                </div>
                <!-- /.info-box-content -->
            </div>

            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box zoomP">
                <a href="{{ url('admin/users') }}" class="info-box-icon bg-primary"><i class="fas fa-users"></i></a>


                <div class="info-box-content">
                    <span class="info-box-text">Usuarios registrados</span>
                    <span class="info-box-number">{{ $totalusuarios }} usuarios</span>
                </div>
                <!-- /.info-box-content -->
            </div>

            <!-- /.info-box -->
        </div>
         <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box zoomP">
                <a href="{{ url('admin/categorias') }}" class="info-box-icon bg-success"><i class="fas fa-tags"></i></a>


                <div class="info-box-content">
                    <span class="info-box-text">Categorias registradas</span>
                    <span class="info-box-number">{{ $totalcategorias }} categorias</span>
                </div>
                <!-- /.info-box-content -->
            </div>

            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box zoomP">
                <a href="{{ url('admin/productos') }}" class="info-box-icon bg-warning"><i class="fas fa-list"></i></a>


                <div class="info-box-content">
                    <span class="info-box-text">Productos registrados</span>
                    <span class="info-box-number">{{ $totalproductos }} productos</span>
                </div>
                <!-- /.info-box-content -->
            </div>

            <!-- /.info-box -->
        </div>
         <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box zoomP">
                <a href="{{ url('admin/proveedores') }}" class="info-box-icon bg-danger"><i class="fas fa-list"></i></a>


                <div class="info-box-content">
                    <span class="info-box-text">Proveedores registrados</span>
                    <span class="info-box-number">{{ $totalproveedores }} proveedores</span>
                </div>
                <!-- /.info-box-content -->
            </div>

            <!-- /.info-box -->
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
   
@stop

@section('js')

    @if (($mensaje = Session::get('mensaje')) && ($icono = Session::get('icono')))
        <script>
            Swal.fire({
                position: "top-end",
                icon: "{{ $icono }}",
                title: "{{ $mensaje }}",
                showConfirmButton: false,
                timer: 4000
            });
        </script>
    @endif

@stop
