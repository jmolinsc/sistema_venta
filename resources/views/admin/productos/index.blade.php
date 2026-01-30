@extends('adminlte::page')



@section('content_header')
    <h1><b>Productos/Listado de productos</b></h1>
    <hr>
@stop

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Productos Registrados</h3>
                    <div class="card-tools">
                        <a href="{{ url('admin/productos/create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Crear
                            Producto</a>
                    </div>
                </div>

                <div class="card-body">


                    <table id="tbProductos" class="table table-striped table-bordered table-hover table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" style="text-align:center")>Codigo </th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Nombre</th>

                                <th scope="col">Descripcion</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Precio Compra</th>
                                <th scope="col">Precio Venta</th>
                                <th scope="col">Imagen</th>
                                <th scope="col" style="text-align: center">Acciones</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                                <tr>
                                    <th scope="row" style="text-align:center;vertical-align: middle;">
                                        {{ $loop->iteration }}</th>
                                    <td style="vertical-align: middle;">{{ $producto->categoria->nombre }}</td>
                                    <td style="vertical-align: middle;">{{ $producto->nombre }}</td>

                                    <td style="vertical-align: middle;">{{ $producto->descripcion }}</td>
                                    <td style="text-align: center;vertical-align: middle;"><span
                                            class="badge badge-success">{{ $producto->stock }}</span></td>
                                    <td style="text-align: center;vertical-align: middle;">{{ $producto->precio_compra }}
                                    </td>
                                    <td style="text-align: center;vertical-align: middle;">{{ $producto->precio_venta }}
                                    </td>
                                    <td style="text-align: center;vertical-align: middle;">
                                        @if ($producto->imagen)
                                            <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen del producto"
                                                style="max-width: 100px; max-height: 100px;">
                                        @else
                                            No hay imagen
                                        @endif
                                    <td style="text-align: center ;vertical-align: middle;">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ url('/admin/productos', $producto->id) }}"
                                                class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            <a href="{{ url('/admin/productos/' . $producto->id . '/edit') }}"
                                                class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                            <form action="{{ url('/admin/productos/' . $producto->id) }}" method="POST"
                                                style="display:inline;" onclick="preguntar{{ $producto->id }}(event)"
                                                id="miFormulario{{ $producto->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    style="border-radius: 0px 4px 4px 0px "><i
                                                        class="fas fa-trash-alt"></i></button>
                                            </form>
                                            <script>
                                                function preguntar{{ $producto->id }}(event) {
                                                    event.preventDefault(); // Evita que el formulario se envíe automáticamente

                                                    Swal.fire({
                                                        title: "¿Estás seguro de eliminar este producto?",
                                                        showDenyButton: false,
                                                        showCancelButton: true,
                                                        confirmButtonText: "Eliminar",
                                                        denyButtonText: `Cancelar`,
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            var formulario = document.getElementById("miFormulario{{ $producto->id }}");
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
            $('#tbProductos').DataTable({
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
