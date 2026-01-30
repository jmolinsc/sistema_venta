@extends('adminlte::page')



@section('content_header')
    <h1><b>Compras/Listado de compras</b></h1>
    <hr>
@stop

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Compras Registradas</h3>
                    <div class="card-tools">
                        <a href="{{ url('admin/compras/create') }}" class="btn btn-primary zoomP"><i class="fas fa-plus"></i>
                            Crear
                            Compra</a>
                    </div>
                </div>

                <div class="card-body">


                    <table id="tbProveedores" class="table table-striped table-bordered table-hover table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" style="text-align:center")>Nro. </th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Comprobante</th>
                                <th scope="col">Precio Total</th>
                                <th scope="col">Productos</th>
                                <th scope="col" style="text-align: center">Acciones</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($compras as $compra)
                                <tr>
                                    <th scope="row" style="text-align:center;vertical-align: middle;">
                                        {{ $loop->iteration }}</th>
                                    <td style="vertical-align: middle;">{{ $compra->fecha }}</td>
                                    <td style="vertical-align: middle;">{{ $compra->comprobante }}</td>
                                    <td style="vertical-align: middle;">{{ $compra->precio_total }}</td>
                                                
                                    <td style="vertical-align: middle;">
                                        @foreach ($compra->detalle as $detalle)
                                            <li>{{ $detalle->producto->nombre . ' - ' . $detalle->cantidad . 'und' }}</li>
                                        @endforeach


                                    </td>
                                    <td style="text-align: center ;vertical-align: middle;">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ url('/admin/compras', $compra->id) }}"
                                                class="btn btn-info btn-sm zoomP"><i class="fas fa-eye"></i></a>
                                            <a href="{{ url('/admin/compras/' . $compra->id . '/edit') }}"
                                                class="btn btn-success btn-sm zoomP"><i class="fas fa-edit"></i></a>
                                            <form action="{{ url('/admin/compras/' . $compra->id) }}" method="POST"
                                                style="display:inline;" onclick="preguntar{{ $compra->id }}(event)"
                                                id="miFormulario{{ $compra->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm zoomP"
                                                    style="border-radius: 0px 4px 4px 0px "><i
                                                        class="fas fa-trash-alt"></i></button>
                                            </form>
                                            <script>
                                                function preguntar{{ $compra->id }}(event) {
                                                    event.preventDefault(); // Evita que el formulario se envíe automáticamente

                                                    Swal.fire({
                                                        title: "¿Estás seguro de eliminar este proveedor?",
                                                        showDenyButton: false,
                                                        showCancelButton: true,
                                                        confirmButtonText: "Eliminar",
                                                        denyButtonText: `Cancelar`,
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            var formulario = document.getElementById("miFormulario{{ $compra->id }}");
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
            $('#tbProveedores').DataTable({
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
