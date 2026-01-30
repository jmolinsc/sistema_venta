@extends('adminlte::master')

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

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body'){{ $bodyClasses }}@stop

@section('body')
    <div class="container mt-5">

        <center>
            <img src="{{ asset(config('adminlte.logo_img')) }}" alt="{{ config('adminlte.logo_img_alt') }}" height="100">

        </center>

        {{-- Card Box --}}
        <div class="card {{ config('adminlte.classes_auth_card', 'card-outline card-primary') }}">

            {{-- Card Header --}}
            @hasSection('auth_header')
                <div class="card-header {{ config('adminlte.classes_auth_header', '') }}">
                    <h3 class="card-title float-none text-center">
                        {{-- @yield('auth_header') --}}
                        Registro de Empresa
                    </h3>
                </div>
            @endif

            {{-- Card Body --}}
            <div class="card-body {{ $authType }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
                {{--  @yield('auth_body') --}}
                <form action="{{ route('admin.empresas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form">

                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="label" for="logo">Logo</label>

                                    <input type="file" name="logo" id="logo" class="form-control"
                                        accept=".jpg, .jpeg, .png" required>
                                    @error('logo')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <br>
                                    <output id="list"></output>
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
                                            <select name="pais" id="pais" class="form-control" value="{{ old('pais') }}" required>
                                                @foreach ($paises as $pais)
                                                    <option value="{{ $pais->id }}">{{ $pais->name }}</option>
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
                                                class="form-control" placeholder="Nombre Empresa" value="{{ old('nombre_empresa') }}" required>
                                            @error('nombre_empresa')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="label" for="tipo_empresa">Tipo Empresa</label>
                                            <input type="text" name="tipo_empresa" id="tipo_empresa" class="form-control"
                                                placeholder="Tipo Empresa" value="{{ old('tipo_empresa') }}" required>
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
                                                placeholder="Nit" value="{{ old('nit') }}" required>
                                            @error('nit')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="label" for="telefono">Telefono</label>
                                            <input type="text" name="telefono" id="telefono" class="form-control"
                                                placeholder="Telefono" value="{{ old('telefono') }}" required>
                                            @error('telefono')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="label" for="correo">Correo</label>
                                            <input type="email" name="correo" id="correo" class="form-control"
                                                placeholder="Correo" value="{{ old('correo') }}" required>
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
                                                class="form-control" placeholder="Cantidad Impuesto" value="{{ old('cantidad_impuesto') }}" required>
                                            @error('cantidad_impuesto')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="label" for="nombre_impuesto">Nombre Impuesto</label>
                                            <input type="text" name="nombre_impuesto" id="nombre_impuesto"
                                                class="form-control" placeholder="Nombre Impuesto" value="{{ old('nombre_impuesto') }}" required>
                                            @error('nombre_impuesto')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="label" for="moneda">Moneda</label>
                                            <div class="select">
                                                <select name="moneda" id="moneda" class="form-control" value="{{ old('moneda') }}" required>
                                                    @foreach ($monedas as $moneda)
                                                        <option value="{{ $moneda->id }}">{{ $moneda->symbol }}
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
                                                placeholder="Direccion" value="{{ old('direccion') }}" required>
                                            @error('direccion')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="label" for="ciudad">Ciudad</label>
                                            <div class="select">
                                                <select name="ciudad" id="ciudad" class="form-control" value="{{ old('ciudad') }}" required>
                                                    @error('ciudad')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="label" for="departamento">Departamento</label>
                                            <div class="select">
                                                <select name="departamento" id="departamento" class="form-control"
                                                    value="{{ old('departamento') }}" required>
                                                    @error('departamento')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
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
                                                    value="{{ old('codigo_postal') }}" required>
                                                    @foreach ($paises as $pais)
                                                        <option value="{{ $pais->phone_code }}">{{ $pais->phone_code }}
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
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Registrar Empresa</button>
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

    @section('adminlte_js')
        @stack('js')
        @yield('js')
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
