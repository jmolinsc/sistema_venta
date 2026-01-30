@extends('adminlte::page')



@section('content_header')
    <h1><b>Categoria/ Categoria Registrada</b></h1>
    <hr>
@stop

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Datos Registrados</h3>

                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="role">Nombre de la categoria</label>
                                <p> {{ $categoria->nombre }}</p>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="descripcion">Descripcion</label>
                                <p>{{ $categoria->descripcion }}</p>
                           
                            </div>

                        </div>
                         <div class="col-md-3">
                            <div class="form-group">
                                <label for="created_at">Fecha Hora Registro</label>
                                <p>{{ $categoria->created_at }}</p>
                              
                            </div>
                        </div>
                        
                    </div>
                   

                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{ url('admin/categorias') }}" class="btn btn-secondary">Volver</a>

                            </div>
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
