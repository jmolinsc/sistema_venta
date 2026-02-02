@extends('adminlte::page')



@section('content_header')
    <h1><b>Clientes/Nuevo Cliente</b></h1>
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
                    <form action="{{ route('admin.clientes.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre_cliente">Nombre del Cliente</label>
                                    <input type="text" name="nombre_cliente" id="nombre_cliente" class="form-control"
                                        value="{{ old('nombre_cliente') }}" placeholder="Ingrese el nombre del cliente">

                                    @error('nombre_cliente')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nit_codigo">Nit/Codigo</label>
                                    <input type="text" name="nit_codigo" id="nit_codigo" class="form-control"
                                        value="{{ old('nit_codigo') }}" placeholder="Ingrese el nit del cliente">

                                    @error('nit_codigo')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefono">Telefono</label>
                                    <input type="text" name="telefono" id="telefono" class="form-control"
                                        value="{{ old('telefono') }}" placeholder="Ingrese el telefono del cliente">

                                    @error('telefono')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" class="form-control"
                                        value="{{ old('email') }}" placeholder="Ingrese el email del cliente">

                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary col-md-2 zoomP"><i class="fas fa-save"></i>
                                        Crear Cliente</button>
                                </div>
                            </div>
                        </div>




                    </form>
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
