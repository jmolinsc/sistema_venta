@extends('adminlte::page')



@section('content_header')
    <h1><b>Categorias/Listado de categorias</b></h1>
    <hr>
@stop

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Categorias Registradas</h3>
                    <div class="card-tools">
                        <a href="{{ url('admin/categorias/create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Crear
                            Categoria</a>
                    </div>
                </div>

                <div class="card-body">


                    <table id="tbCategorias" class="table table-striped table-bordered table-hover table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" style="text-align:center")>Numero</th>
                                 <th scope="col">Nombre</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col" style="text-align: center">Acciones</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categorias as $categoria)
                                <tr>
                                    <th scope="row" style="text-align:center">{{ $loop->iteration }}</th>
                                    <td>{{ $categoria->nombre }}</td>
                                    <td>{{ $categoria->descripcion }}</td>
                                    <td style="text-align: center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ url('/admin/categorias', $categoria->id) }}" class="btn btn-info btn-sm"><i
                                                    class="fas fa-eye"></i></a>
                                            <a href="{{ url('/admin/categorias/' . $categoria->id . '/edit') }}"
                                                class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                            <form action="{{ url('/admin/categorias/' . $categoria->id) }}" method="POST"
                                                style="display:inline;" onclick="preguntar{{ $categoria->id }}(event)"
                                                id="miFormulario{{ $categoria->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 0px 4px 4px 0px "><i
                                                        class="fas fa-trash-alt"></i></button>
                                            </form>
                                            <script>
                                                function preguntar{{ $categoria->id }}(event) {
                                                    event.preventDefault(); // Evita que el formulario se envíe automáticamente

                                                    Swal.fire({
                                                        title: "¿Estás seguro de eliminar esta categoría? Si eliminas esta categoría, se eliminarán todos los productos asociados a ella.",
                                                        showDenyButton: false,
                                                        showCancelButton: true,
                                                        confirmButtonText: "Eliminar",
                                                        denyButtonText: `Cancelar`,
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                           var formulario = document.getElementById("miFormulario{{ $categoria->id }}");
                                                            formulario.submit(); // Envía el formulario manualmente
                                                        }
                                                    });
                                                }
                                            </script>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>
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
  <script>
        $(document).ready(function() {
            $('#tbCategorias').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                pageLength: 5,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
                }
            });
        });
    </script>

@stop
