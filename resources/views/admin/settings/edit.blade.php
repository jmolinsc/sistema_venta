@extends('adminlte::page')
@php
    $authType = $authType ?? 'login';
    $dashboardUrl = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home');

    if (config('adminlte.use_route_url', false)) {
        $dashboardUrl = $dashboardUrl ? route($dashboardUrl) : '';
    } else {
        $dashboardUrl = $dashboardUrl ? url($dashboardUrl) : '';
    }

    $bodyClasses = "{$authType}-page";

    if (!empty(config('adminlte.layout_dark_mode', null))) {
        $bodyClasses .= ' dark-mode';
    }
@endphp


@section('content_header')
    <h1>Configuración/Editar</h1>
    <hr>
@stop
    
@section('content')
    {{-- Card Box --}}
        <div class="card {{ config('adminlte.classes_auth_card', 'card-outline card-primary') }}">

            {{-- Card Header --}}
            @hasSection('auth_header')
                <div class="card-header {{ config('adminlte.classes_auth_header', '') }}">
                    <h3 class="card-title float-none text-center">
                        {{-- @yield('auth_header') --}}
                       Datos Registrados
                    </h3>
                </div>
            @endif

            {{-- Card Body --}}
            <div class="card {{ config('adminlte.classes_auth_card', 'card-outline card-primary') }}">
                {{--  @yield('auth_body') --}}
                <form action="{{ url('/admin/settings', $empresa->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form">

                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="label" for="logo">Logo</label>

                                    <input type="file" name="logo" id="logo" class="form-control"
                                        accept=".jpg, .jpeg, .png">
                                    @error('logo')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <br>
                                    <output id="list">

                                        <img src="{{ asset('storage/' . $empresa->logo) }}" width="80%"
                                            alt="Logo Empresa">
                                    </output>
                                    <script>
                                        document.getElementById('logo').addEventListener('change', archivo, false);

                                        function archivo(evt) {
                                            var files = evt.target.files; // FileList object

                                            // Obtenemos la imagen del campo "file".
                                            for (var i = 0, f; f = files[i]; i++) {
                                                //Solo admitimos imágenes.
                                                if (!f.type.match('image.*')) {
                                                    continue;
                                                }

                                                var reader = new FileReader();

                                                reader.onload = (function(theFile) {
                                                    return function(e) {
                                                        // Insertamos la imagen
                                                        document.getElementById('list').innerHTML = ['<img class="thumb" width="70%" src="', e
                                                            .target.result,
                                                            '" title="', escape(theFile.name), '"/>'
                                                        ].join('');
                                                    };
                                                })(f);

                                                reader.readAsDataURL(f);
                                            }
                                        }
                                    </script>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="label" for="pais">Pais</label>
                                            <select name="pais" id="pais" class="form-control" value="{{ $empresa->pais }}" required>
                                                @foreach ($paises as $pais)
                                                    <option {{$empresa->pais == $pais->id ? 'selected' : ''}} value="{{ $pais->id }}">{{ $pais->name }}</option>
                                                @endforeach

                                            </select>
                                            @error('pais')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="label" for="nombre_empresa">Nombre Empresa</label>
                                            <input type="text" name="nombre_empresa" id="nombre_empresa"
                                                class="form-control" placeholder="Nombre Empresa" value="{{ $empresa->nombre_empresa }}" required>
                                            @error('nombre_empresa')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="label" for="tipo_empresa">Tipo Empresa</label>
                                            <input type="text" name="tipo_empresa" id="tipo_empresa" class="form-control"
                                                placeholder="Tipo Empresa" value="{{ $empresa->tipo_empresa }}" required>
                                            @error('tipo_empresa')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="label" for="nit">Nit</label>
                                            <input type="text" name="nit" id="nit" class="form-control"
                                                placeholder="Nit" value="{{ $empresa->nit }}" required>
                                            @error('nit')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="label" for="telefono">Telefono</label>
                                            <input type="text" name="telefono" id="telefono" class="form-control"
                                                placeholder="Telefono" value="{{ $empresa->telefono }}" required>
                                            @error('telefono')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="label" for="correo">Correo</label>
                                            <input type="email" name="correo" id="correo" class="form-control"
                                                placeholder="Correo" value="{{ $empresa->correo }}" required>
                                            @error('correo')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="label" for="cantidad_impuesto">Cantidad Impuesto</label>
                                            <input type="number" name="cantidad_impuesto" id="cantidad_impuesto"
                                                class="form-control" placeholder="Cantidad Impuesto" value="{{ $empresa->cantidad_impuesto }}" required>
                                            @error('cantidad_impuesto')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="label" for="nombre_impuesto">Nombre Impuesto</label>
                                            <input type="text" name="nombre_impuesto" id="nombre_impuesto"
                                                class="form-control" placeholder="Nombre Impuesto" value="{{ $empresa->nombre_impuesto }}" required>
                                            @error('nombre_impuesto')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="label" for="moneda">Moneda</label>
                                            <div class="select">
                                                <select name="moneda" id="moneda" class="form-control" value="{{ $empresa->moneda }}" required>
                                                    @foreach ($monedas as $moneda)
                                                        <option {{$empresa->moneda == $moneda->id ? 'selected' : ''}} value="{{ $moneda->id }}">{{ $moneda->symbol }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('moneda')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="label" for="direccion">Direccion</label>
                                            <input type="address" name="direccion" id="direccion" class="form-control"
                                                placeholder="Direccion" value="{{ $empresa->direccion }}" required>
                                            @error('direccion')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="label" for="ciudad">Ciudad</label>
                                            <div class="select">
                                                <select name="ciudad" id="ciudad" class="form-control" value="{{ $empresa->ciudad }}" required>
                                                      @foreach ($ciudades as $ciudad)
                                                        <option {{$empresa->ciudad == $ciudad->id ? 'selected' : ''}} value="{{ $ciudad->id }}">{{ $ciudad->name }}
                                                        </option>
                                                    @endforeach
                                                 
                                                </select>
                                                   @error('ciudad')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="label" for="departamento">Departamento</label>
                                            <div class="select">
                                                <select  name="departamento" id="departamento" class="form-control"
                                                    value="{{ $empresa->departamento }}" required>
                                                     @foreach ($departamentos as $departamento)
                                                        <option {{$empresa->departamento == $departamento->id ? 'selected' : ''}} value="{{ $departamento->id }}">{{ $departamento->name }}
                                                        </option>
                                                    @endforeach
                                                  
                                                </select>
                                                @error('departamento')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="label" for="codigo_postal">Codigo Postal</label>
                                            <div class="select">
                                                <select name="codigo_postal" id="codigo_postal" class="form-control"
                                                    value="{{ $empresa->codigo_postal }}" required>
                                                    @foreach ($paises as $pais)
                                                        <option  {{$empresa->codigo_postal == $pais->phone_code ? 'selected' : ''}} value="{{ $pais->phone_code }}">{{ $pais->phone_code }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('codigo_postal') 
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>


                                </div>
                            </div>

                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-md-4 offset-4">
                                <button type="submit" class="btn btn-success btn-block">Actualizar Empresa</button>
                            </div>
                        </div>
                    </div>
                </form>


                {{-- Card Footer --}}
                @hasSection('auth_footer')
                    <div class="card-footer {{ config('adminlte.classes_auth_footer', '') }}">
                        @yield('auth_footer')
                    </div>
                @endif

            </div>

        </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
      <script>
            $('#pais').on('change', function() {
                var paisSeleccionado = $(this).val();
                if (paisSeleccionado) {
                    // Aquí puedes hacer una llamada AJAX para obtener los estados del país seleccionado
                    // y actualizar el select de estados en consecuencia.
                    $.ajax({
                        url: "{{ url('/create-company/pais') }}/" + paisSeleccionado,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {

                            var estadoSelect = $('#departamento');
                            estadoSelect.empty();
                            $.each(data, function(key, value) {
                                estadoSelect.append('<option value="' + value.id + '">' + value
                                    .name + '</option>');
                            });
                        }
                    });
                }

            });
        </script>
        <script>
            $(document).on('change', '#departamento', function() {
                var departamentoSeleccionado = $(this).val();
                if (departamentoSeleccionado) {
                    // Aquí puedes hacer una llamada AJAX para obtener las ciudades del estado seleccionado
                    // y actualizar el select de ciudades en consecuencia.

                    $.ajax({
                        url: "{{ url('/create-company/estado') }}/" + departamentoSeleccionado,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {

                            var ciudadSelect = $('#ciudad');
                            ciudadSelect.empty();
                            $.each(data, function(key, value) {
                                ciudadSelect.append('<option value="' + value.name + '">' + value
                                    .name + '</option>');
                            });
                        }
                    });
                }

            });
        </script>
@stop