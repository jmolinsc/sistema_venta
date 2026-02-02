@extends('adminlte::page')



@section('content_header')
    <h1><b>Clientes/Modificar Cliente</b></h1>
    <hr>
@stop

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Ingrese los datos</h3>

                </div>

                <div class="card-body">
                    <form action="{{ url('admin/clientes/' . $cliente->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre_cliente">Nombre del Cliente</label>
                                    <input type="text" name="nombre_cliente" id="nombre_cliente" class="form-control"
                                        value="{{ $cliente->nombre_cliente }}" placeholder="Ingrese el nombre del cliente">

                                    @error('nombre_cliente')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nit_codigo">Nit</label>
                                    <input type="text" name="nit_codigo" id="nit_codigo" class="form-control"
                                        value="{{ $cliente->nit_codigo }}" placeholder="Ingrese el nit del cliente">

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
                                        value="{{ $cliente->telefono }}" placeholder="Ingrese el telefono del cliente">

                                    @error('telefono')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" class="form-control"
                                        value="{{ $cliente->email }}" placeholder="Ingrese el email del cliente">

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
                                    <button type="submit" class="btn btn-success col-md-2"><i class="fas fa-save"></i>
                                        Modificar cliente</button>
                                </div>
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
