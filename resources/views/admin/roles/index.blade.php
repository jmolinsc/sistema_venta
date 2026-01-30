@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><b>Listado de roles</b></h1>
    <hr>
@stop

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Roles</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Crear
                            Rol</a>
                    </div>
                </div>

                <div class="card-body">


                    <table id="tbRoles" class="table table-striped table-bordered table-hover table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" style="text-align:center")>Numero</th>
                                <th scope="col">Rol</th>
                                <th scope="col" style="text-align: center">Acciones</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <th scope="row" style="text-align:center">{{ $loop->iteration }}</th>
                                    <td>{{ $role->name }}</td>
                                    <td style="text-align: center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ url('/admin/roles', $role->id) }}" class="btn btn-info btn-sm"><i
                                                    class="fas fa-eye"></i></a>
                                            <a href="{{ url('/admin/roles/' . $role->id . '/edit') }}"
                                                class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                            <form action="{{ url('/admin/roles/' . $role->id) }}" method="POST"
                                                style="display:inline;" onclick="preguntar{{ $role->id }}(event)"
                                                id="miFormulario{{ $role->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 0px 4px 4px 0px "><i
                                                        class="fas fa-trash-alt"></i></button>
                                            </form>
                                            <script>
                                                function preguntar{{ $role->id }}(event) {
                                                    event.preventDefault(); // Evita que el formulario se envíe automáticamente

                                                    Swal.fire({
                                                        title: "¿Estás seguro de eliminar este rol?",
                                                        showDenyButton: false,
                                                        showCancelButton: true,
                                                        confirmButtonText: "Eliminar",
                                                        denyButtonText: `Cancelar`,
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                           var formulario = document.getElementById("miFormulario{{ $role->id }}");
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
                <div class="card-footer">
                    The footer of the card
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
            $('#tbRoles').DataTable({
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
