@extends('adminlte::page')



@section('content_header')
    <h1><b>Categorias/ Editar Categoria</b></h1>
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
                    <form action="{{ url('admin/categorias/' . $categoria->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombre">Nombre de la Categoria</label>
                                    <input type="text" name="nombre" id="nombre" class="form-control"
                                        value="{{ $categoria->nombre }}" placeholder="Ingrese el nombre de la categoria">

                                    @error('nombre')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="descripcion">Descripcion</label>
                                    <input type="text" name="descripcion" id="descripcion" class="form-control"
                                        value="{{ $categoria->descripcion }}" placeholder="Ingrese la descripcion de la categoria">

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
                                    <a href="{{ route('admin.categorias.index') }}" class="btn btn-danger col-md-2"><i
                                        class="fas fa-arrow-left"></i>
                                    Regresar</a>
                                    <button type="submit" class="btn btn-success col-md-2"><i class="fas fa-save"></i>
                                        Actualizar</button>
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
