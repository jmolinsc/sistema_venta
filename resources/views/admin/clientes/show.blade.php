@extends('adminlte::page')



@section('content_header')
    <h1><b>Clientes/Detalle Cliente</b></h1>
    <hr>
@stop

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos registrados</h3>

                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nombre del Cliente</label>
                                <p>{{ $cliente->nombre_cliente }}</p>
                              
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nit/Codigo</label>
                                <p>{{ $cliente->nit_codigo }}</p>
                              
                            </div>
                        </div>

                    </div>
                     <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Telefono</label>
                                <p>{{ $cliente->telefono }}</p>
                              
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Email</label>
                                <p>{{ $cliente->email }}</p>
                              
                            </div>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                               <a href="{{url('/admin/clientes')}}" class="btn btn-secondary zoomP">Volver</a>
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
