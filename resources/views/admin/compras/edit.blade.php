@extends('adminlte::page')



@section('content_header')
    <h1><b>Compras/Modificar datos de la Compra</b></h1>
    <hr>
@stop
@php
    $total_cantidad = 0;
    $precio_total = 0;
@endphp
@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Ingrese los datos</h3>

                </div>

                <div class="card-body">
                    <form action="{{ url('admin/compras/' . $compra->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="cantidad">Cantidad</label><b>*</b>
                                            <input type="number" name="cantidad" id="cantidad" class="form-control"
                                                value="1" placeholder="Ingrese la cantidad" required>

                                            @error('cantidad')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="codigo">Codigo</label><b>*</b>
                                            <div class="input-group">
                                                <div class="input-group-prepend">

                                                    <span class="input-group-text">
                                                        <i class="fas fa-barcode"> </i>
                                                    </span>

                                                </div>
                                                <input type="text" class="form-control" placeholder="Codigo del producto"
                                                    aria-label="Codigo del producto" id="codigo" name="codigo"
                                                    aria-describedby="basic-addon2">
                                            </div>
                                            @error('codigo')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div style="margin-top: 24px;"></div>
                                            <button type="button" class="btn btn-primary zoomP" data-toggle="modal"
                                                data-target="#staticBackdrop">
                                                <i class="fa fa-search"></i>
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="staticBackdrop" data-backdrop="static"
                                                data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Listado de
                                                                productos
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table id="tbProductos"
                                                                class="table table-striped table-bordered table-hover table-sm table-responsive">
                                                                <thead class="thead-light">
                                                                    <tr>
                                                                        <th scope="col" style="text-align:center")>Codigo
                                                                        </th>
                                                                        <th scope="col" style="text-align: center">
                                                                            Accion</th>

                                                                        <th scope="col">Categoria</th>
                                                                        <th scope="col">Nombre</th>

                                                                        <th scope="col">Descripcion</th>
                                                                        <th scope="col">Stock</th>
                                                                        <th scope="col">Precio Compra</th>
                                                                        <th scope="col">Precio Venta</th>
                                                                        <th scope="col">Imagen</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($productos as $producto)
                                                                        <tr>
                                                                            <th scope="row"
                                                                                style="text-align:center;vertical-align: middle;">
                                                                                {{ $loop->iteration }}</th>
                                                                            <td
                                                                                style="text-align: center;vertical-align: middle;">
                                                                                <button type="button"
                                                                                    class="btn btn-info btn-sm seleccionar-btn"
                                                                                    data-id="{{ $producto->codigo }}">Seleccionar</button>
                                                                            </td>
                                                                            <td style="vertical-align: middle;">
                                                                                {{ $producto->categoria->nombre }}</td>
                                                                            <td style="vertical-align: middle;">
                                                                                {{ $producto->nombre }}</td>

                                                                            <td style="vertical-align: middle;">
                                                                                {{ $producto->descripcion }}</td>
                                                                            <td
                                                                                style="text-align: center;vertical-align: middle;">
                                                                                <span
                                                                                    class="badge badge-success">{{ $producto->stock }}</span>
                                                                            </td>
                                                                            <td
                                                                                style="text-align: center;vertical-align: middle;">
                                                                                {{ $producto->precio_compra }}
                                                                            </td>
                                                                            <td
                                                                                style="text-align: center;vertical-align: middle;">
                                                                                {{ $producto->precio_venta }}
                                                                            </td>
                                                                            <td
                                                                                style="text-align: center;vertical-align: middle;">
                                                                                @if ($producto->imagen)
                                                                                    <img src="{{ asset('storage/' . $producto->imagen) }}"
                                                                                        alt="Imagen del producto"
                                                                                        style="max-width: 100px; max-height: 100px;">
                                                                                @else
                                                                                    No hay imagen
                                                                                @endif


                                                                        </tr>
                                                                    @endforeach


                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cerrar</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="{{ url('/admin/productos/create') }}" class="btn btn-success zoomP">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-sm table-stripped table-borderded table-hover">
                                            <thead style="backgroud-color: #cccccc">
                                                <tr>
                                                    <th>Numero</th>
                                                    <th>Codigo</th>
                                                    <th>Cantidad</th>
                                                    <th>Nombre</th>
                                                    <th>Costo</th>
                                                    <th>Total</th>
                                                    <th>Accion</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($compra->detalle as $detalle)
                                                    @php
                                                        $total_cantidad += $detalle->cantidad;
                                                        $precio_total +=
                                                            $detalle->cantidad *
                                                            $detalle->producto->precio_compra;
                                                    @endphp
                                                    <tr>
                                                        <th scope="row"
                                                            style="text-align:center;vertical-align: middle;">
                                                            {{ $loop->iteration }}</th>
                                                        <td style="vertical-align: middle;text-align: center">
                                                            {{ $detalle->producto->codigo }}</td>
                                                        <td style="vertical-align: middle;text-align: center">
                                                            {{ $detalle->cantidad }}</td>
                                                        <td style="vertical-align: middle;text-align: center">
                                                            {{ $detalle->producto->nombre }}</td>
                                                        <td style="vertical-align: middle;text-align: center">
                                                            {{ $detalle->precio }}
                                                        </td>
                                                        <td style="vertical-align: middle;text-align: center">
                                                            {{ $costo = $detalle->cantidad * $detalle->precio }}
                                                        </td>

                                                        <td style="vertical-align: middle;">
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm delete-btn zoomP"
                                                                data-id="{{ $detalle->id }}"
                                                                style="border-radius: 0px 4px 4px 0px "><i
                                                                    class="fas fa-trash-alt"></i></button>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="2" style="text-align: right"><b>Total Cantidad</b>
                                                    </td>
                                                    <td style="text-align: center">
                                                        {{ $total_cantidad }}
                                                    </td>
                                                    <td colspan="2" style="text-align: right"><b>Total Compra</b></td>
                                                    <td style="text-align: center">
                                                        {{ $precio_total }}
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div style="margin-top: 24px;"></div>
                                            <button type="button" class="btn btn-primary zoomP" data-toggle="modal"
                                                data-target="#staticBackdrop_prov"><i class="fa fa-search"></i>Buscar
                                                proveedor</button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="staticBackdrop_prov" data-backdrop="static"
                                                data-keyboard="false" tabindex="-1"
                                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">
                                                                Listado de proveedores
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table id="tbProveedores"
                                                                class="table table-striped table-bordered table-hover table-sm table-responsive">
                                                                <thead class="thead-light">
                                                                    <tr>
                                                                        <th scope="col" style="text-align:center">
                                                                            Codigo
                                                                        <th>
                                                                        <th scope="col" style="text-align: center">
                                                                            Accion
                                                                        </th>
                                                                        <th scope="col">Empresa</th>
                                                                        <th scope="col">Nombre</th>
                                                                        <th scope="col">Telefono</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($proveedores as $proveedor)
                                                                        <tr>
                                                                            <th scope="row"
                                                                                style="text-align:center;vertical-align: middle;">
                                                                                {{ $loop->iteration }}</th>
                                                                            <td
                                                                                style="text-align: center;vertical-align: middle;">
                                                                                <button type="button"
                                                                                    class="btn btn-info btn-sm seleccionar-btn-proveedor"
                                                                                    data-id="{{ $proveedor->id }}"
                                                                                    data-empresa="{{ $proveedor->empresa }}">Seleccionar</button>
                                                                            </td>
                                                                            <td style="vertical-align: middle;">
                                                                                {{ $proveedor->empresa }}</td>
                                                                            <td style="vertical-align: middle;">
                                                                                {{ $proveedor->nombre }}</td>
                                                                            <td style="vertical-align: middle;">
                                                                                {{ $proveedor->telefono }}</td>
                                                                        </tr>
                                                                    @endforeach


                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cerrar</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="empresa_proveedor">Empresa Proveedor</label><b>*</b>
                                            <input type="text" name="empresa_proveedor" id="empresa_proveedor"
                                                class="form-control" value="{{ $detalle->proveedor->empresa }}" placeholder="Nombre proveedor"
                                                disabled>
                                            <input type="hidden" name="proveedor_id" id="proveedor_id" value="{{ $detalle->proveedor->id }}">

                                            @error('empresa_proveedor')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="fecha">Fecha</label><b>*</b>
                                            <input type="date" name="fecha" id="fecha" class="form-control"
                                                value="{{ $compra->fecha }}" placeholder="Ingrese la fecha">

                                            @error('fecha')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>


                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="fecha">Fecha</label><b>*</b>
                                            <input type="text" name="comprobante" id="comprobante"
                                                class="form-control" value="{{ $compra->comprobante }}"
                                                placeholder="Ingrese la fecha">

                                            @error('comprobante')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>


                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <label for="precio_total">Total Compra</label><b>*</b>
                                            <input type="text" name="precio_total" id="precio_total"
                                                class="form-control"
                                                style="text-align: center; background-color: #e9e710; font-weight: bold; color: #000;"
                                                value="{{ $precio_total }}" placeholder="Total de la compra" readonly>

                                            @error('precio_total')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>


                                    </div>


                                </div>
                            </div>



                        </div>


                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ url('admin/categorias') }}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-primary col-md-2 zoomP"><i
                                            class="fas fa-save"></i>
                                        Modificar Compra</button>
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
    <script>
        $('.seleccionar-btn').click(function() {
            var codigo = $(this).data('id');
            $('#codigo').val(codigo);
            $('#staticBackdrop').on('hidden.bs.modal', function() {
                $('#codigo').focus();
            });
            $('#staticBackdrop').modal('hide');

        });
        $('.seleccionar-btn-proveedor').click(function() {
            var idproveedor = $(this).data('id');
            var empresa = $(this).data('empresa');
            $('#empresa_proveedor').val(empresa);
            $('#proveedor_id').val(idproveedor);

            $('#staticBackdrop_prov').modal('hide');

        });

        $('.delete-btn').on('click', function() {
            var id = $(this).data('id');
            if (id) {
                $.ajax({
                    url: '{{ url('/admin/compras/create/tmp') }}/' + id,
                    type: 'POST',
                    data: {

                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE',

                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "Se eliminó el producto correctamente",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            location.reload();
                        } else {
                            Swal.fire({
                                position: "top-end",
                                icon: "error",
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            });

                        }
                        //  console.log(response.mensaje);
                        //  console.log(response.data);
                        // Aquí puedes manejar la respuesta del servidor
                    },
                    error: function(xhr, status, error) {
                        console.error('Error en la solicitud AJAX:', error);
                    }
                });

            }
        })
        $('#codigo').focus();
        $('#formCompra').on('keypress', function(e) {
            // Código a ejecutar cuando el DOM esté listo

            if (e.keyCode === 13) {
                e.preventDefault(); // Evita que se envíe el formulario si está dentro de uno
            }
        })

        $('#codigo').on('keyup', function(e) {
            e.preventDefault(); // Evita que se envíe el formulario si está dentro de uno
            if (e.which === 13) {

                var codigo = $(this).val();
                var cantidad = $('#cantidad').val();
                if (codigo.length > 0) {
                    $.ajax({
                        url: '{{ route('admin.compras.tmp_compras') }}',
                        method: 'POST',
                        data: {
                            codigo: codigo,
                            _token: '{{ csrf_token() }}',
                            cantidad: cantidad
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "Se registro el producto correctamente",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                location.reload();
                            } else {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "error",
                                    title: response.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });

                            }
                            //  console.log(response.mensaje);
                            //  console.log(response.data);
                            // Aquí puedes manejar la respuesta del servidor
                        },
                        error: function(xhr, status, error) {
                            console.error('Error en la solicitud AJAX:', error);
                        }
                    });
                }
            }

        });
    </script>
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
