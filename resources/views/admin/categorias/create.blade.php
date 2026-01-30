@extends('adminlte::page')



@section('content_header')
    <h1><b>Categorias/ Registro de una nueva categoria</b></h1>
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
                    <form action="{{ url('admin/categorias/store') }}" method="POST">
                        @csrf
                        <div class="row">
                         
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombre">Nombre de la Categoria</label>
                                    <input type="text" name="nombre" id="nombre" class="form-control"
                                        value="{{ old('nombre') }}" placeholder="Ingrese el nombre de la categoria">
                                    @error('nombre')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="descripcion">Descripcion</label>
                                    <input type="text" name="descripcion" id="descripcion" class="form-control"
                                        value="{{ old('descripcion') }}" placeholder="Ingrese la descripcion de la categoria">
                                    @error('descripcion')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                       
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ url('admin/categorias') }}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-primary col-md-2"><i class="fas fa-save"></i>
                                        Crear Categoria</button>
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
