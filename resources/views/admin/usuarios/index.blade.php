@extends('adminlte::page')



@section('content_header')
    <h1><b>Listado de usuarios</b></h1>
    <hr>
@stop

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Usuarios Registrados</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Crear
                            Usuario</a>
                    </div>
                </div>

                <div class="card-body">


                    <table id="tbUsuarios" class="table table-striped table-bordered table-hover table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" style="text-align:center")>Numero</th>
                                 <th scope="col">Rol</th>
                                <th scope="col">Nombre usuario</th>
                                 <th scope="col">Email</th>
                                <th scope="col" style="text-align: center">Acciones</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                                <tr>
                                    <th scope="row" style="text-align:center">{{ $loop->iteration }}</th>
                                    <td>{{ $usuario->roles->pluck('name')->join(', ') }}</td>
                                    <td>{{ $usuario->name }}</td>   
                                    <td>{{ $usuario->email }}</td>
                                    <td style="text-align: center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ url('/admin/users', $usuario->id) }}" class="btn btn-info btn-sm"><i
                                                    class="fas fa-eye"></i></a>
                                            <a href="{{ url('/admin/users/' . $usuario->id . '/edit') }}"
                                                class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                            <form action="{{ url('/admin/users/' . $usuario->id) }}" method="POST"
                                                style="display:inline;" onclick="preguntar{{ $usuario->id }}(event)"
                                                id="miFormulario{{ $usuario->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 0px 4px 4px 0px "><i
                                                        class="fas fa-trash-alt"></i></button>
                                            </form>
                                            <script>
                                                function preguntar{{ $usuario->id }}(event) {
                                                    event.preventDefault(); // Evita que el formulario se envíe automáticamente

                                                    Swal.fire({
                                                        title: "¿Estás seguro de eliminar este usuario?",
                                                        showDenyButton: false,
                                                        showCancelButton: true,
                                                        confirmButtonText: "Eliminar",
                                                        denyButtonText: `Cancelar`,
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                           var formulario = document.getElementById("miFormulario{{ $usuario->id }}");
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
@sto   

@section('js')
  <script>
        $(document).ready(function() {
            $('#tbUsuarios').DataTable({
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
