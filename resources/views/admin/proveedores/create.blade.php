@extends('adminlte::page')



@section('content_header')
    <h1><b>Proveedores/Nuevo Proveedor</b></h1>
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
                    <form action="{{ url('admin/proveedores/store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="empresa">Empresa</label><b>*</b>
                                    <input type="text" name="empresa" id="empresa" class="form-control"
                                        value="{{ old('empresa') }}" placeholder="Ingrese el nombre de la empresa" required>

                                    @error('empresa')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="direccion">Direccion</label><b>*</b>
                                    <input type="text" name="direccion" id="direccion" class="form-control"
                                        value="{{ old('direccion') }}" placeholder="Ingrese la direccion del proveedor"
                                        required>

                                    @error('direccion')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="telefono">Telefono</label><b>*</b>
                                    <input type="text" name="telefono" id="telefono" class="form-control"
                                        value="{{ old('telefono') }}" placeholder="Ingrese el telefono del proveedor"
                                        required>

                                    @error('telefono')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email</label><b>*</b>
                                    <input type="text" name="email" id="email" class="form-control"
                                        value="{{ old('email') }}" placeholder="Ingrese el email del proveedor" required>

                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label><b>*</b>
                                    <input type="text" name="nombre" id="nombre" class="form-control"
                                        value="{{ old('nombre') }}" placeholder="Ingrese el nombre del contacto" required>

                                    @error('nombre')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="celular">Celular</label><b>*</b>
                                    <input type="text" name="celular" id="celular" class="form-control"
                                        value="{{ old('celular') }}" placeholder="Ingrese el celular del proveedor"
                                        required>

                                    @error('celular')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary col-md-2"><i class="fas fa-save"></i>
                                        Crear Proveedor</button>
                                </div>
                            </div>
                        </div>

                    </form>

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
