@extends('adminlte::page')



@section('content_header')
    <h1><b>Proveedores/Datos del Proveedor</b></h1>
    <hr>
@stop

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Ingrese los datos</h3>

                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="empresa">Empresa</label><b>*</b>
                                <p>{{ $proveedor->empresa }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="direccion">Direccion</label><b>*</b>
                                <p>{{ $proveedor->direccion }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="telefono">Telefono</label><b>*</b>
                                <p>{{ $proveedor->telefono }}</p>

                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Email</label><b>*</b>
                                <p>{{ $proveedor->email }}</p>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nombre">Nombre</label><b>*</b>
                                <p>{{ $proveedor->nombre }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="celular">Celular</label><b>*</b>
                                <p>{{ $proveedor->celular }}</p>
                            </div>
                        </div>
                    </div>



                    <hr>
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group">
                                <a href="{{ url('admin/proveedores') }}" class="btn btn-secondary zoomP">Volver</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')


@stop
