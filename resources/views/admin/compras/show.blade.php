@extends('adminlte::page')



@section('content_header')
    <h1><b>Compras/Detalle de la Compra</b></h1>
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
                    <h3 class="card-title">Datos registrados</h3>

                </div>

                <div class="card-body">
                  

                        <div class="row">
                            <div class="col-md-8">
                                
                                <div class="row">
                                     <table class="table table-sm table-stripped table-borderded table-hover">
                                            <thead style="backgroud-color: #cccccc">
                                                <tr>
                                                    <th>Numero</th>
                                                    <th>Codigo</th>
                                                    <th>Cantidad</th>
                                                    <th>Nombre</th>
                                                    <th>Costo</th>
                                                    <th>Total</th>
                                                   
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
                                                            {{ $detalle->producto->precio_compra }}
                                                        </td>
                                                        <td style="vertical-align: middle;text-align: center">
                                                            {{ $costo = $detalle->cantidad * $detalle->producto->precio_compra }}
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
                            <div class="col-md-4">
                                <div class="row">
                                  
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="empresa_proveedor">Empresa Proveedor</label><b>*</b>
                                            <input type="text" name="empresa_proveedor" id="empresa_proveedor"
                                                class="form-control" value="{{ $compra->proveedor->empresa }}" placeholder="Nombre proveedor"
                                                disabled>
                                           

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
                                                value="{{ $compra->fecha }}" placeholder="Ingrese la fecha" disabled>

                                            @error('fecha')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>


                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="fecha">Fecha</label>
                                            <input type="text" name="comprobante" id="comprobante" disabled
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
                                            <label for="precio_total">Total Compra</label>
                                            <input type="text" name="precio_total" id="precio_total"
                                                class="form-control"
                                                style="text-align: center; background-color: #e9e710; font-weight: bold; color: #000;font-size: 30px;"
                                                value="{{  $precio_total }}" placeholder="Total de la compra" readonly>

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
                                    <a href="{{ url('admin/compras') }}" class="btn btn-secondary zoomP">Volver</a>
                                  
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
