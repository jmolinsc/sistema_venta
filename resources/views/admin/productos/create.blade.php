@extends('adminlte::page')



@section('content_header')
    <h1><b>Productos/ Registro de un nuevo producto</b></h1>
    <hr>
@stop

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Ingrese los datos</h3>

                </div>


                <div class="card-body">
                    <form action="{{ url('admin/productos/store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="categoria_id">Categoria</label><b>*</b>
                                            <select name="categoria_id" id="categoria_id" class="form-control">
                                                <option value="">Seleccione una categoria</option>
                                                @foreach ($categorias as $categoria)
                                                    <option value="{{ $categoria->id }}"
                                                        {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                                        {{ $categoria->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('categoria_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="codigo">Codigo</label><b>*</b>
                                            <input type="text" name="codigo" id="codigo" class="form-control"
                                                value="{{ old('codigo') }}" placeholder="Ingrese el codigo del producto"
                                                required>
                                            @error('codigo')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label><b>*</b>
                                            <input type="text" name="nombre" id="nombre" class="form-control"
                                                value="{{ old('nombre') }}" placeholder="Ingrese el nombre del producto"
                                                required>
                                            @error('nombre')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="stock">Stock</label><b>*</b>
                                            <input type="number" name="stock" id="stock" class="form-control"
                                                value="{{ old('stock') }}" placeholder="Ingrese el stock del producto"
                                                required>
                                            @error('stock')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="stock_minimo">Stock minimo</label><b>*</b>
                                            <input type="number" name="stock_minimo" id="stock_minimo" class="form-control"
                                                value="{{ old('stock_minimo') }}"
                                                placeholder="Ingrese el stock minimo del producto" required>
                                            @error('stock_minimo')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="stock_maximo">Stock maximo</label><b>*</b>
                                            <input type="number" name="stock_maximo" id="stock_maximo" class="form-control"
                                                value="{{ old('stock_maximo') }}"
                                                placeholder="Ingrese el stock maximo del producto" required>
                                            @error('stock_maximo')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="precio_venta">Precio de venta</label><b>*</b>
                                            <input type="text" step="0.01" name="precio_venta" id="precio_venta"
                                                class="form-control" value="{{ old('precio_venta') }}"
                                                placeholder="Ingrese el precio de venta del producto" required>
                                            @error('precio_venta')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="precio_compra">Precio de compra</label><b>*</b>
                                            <input type="text" step="0.01" name="precio_compra" id="precio_compra"
                                                class="form-control" value="{{ old('precio_compra') }}"
                                                placeholder="Ingrese el precio de compra del producto" required>
                                            @error('precio_compra')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fecha_ingreso">Fecha ingreso</label>
                                            <input type="date" name="fecha_ingreso" id="fecha_ingreso"
                                                class="form-control" value="{{ old('fecha_ingreso') }}"
                                                placeholder="Ingrese la fecha de ingreso del producto">
                                            @error('fecha_ingreso')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="descripcion">Descripcion</label>
                                            <textarea name="descripcion" id="descripcion" class="form-control" rows="2"
                                                placeholder="Ingrese una descripcion del producto">{{ old('descripcion') }}</textarea>
                                            @error('descripcion')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="label" for="imagen">Imagen</label>

                                    <input type="file" name="imagen" id="imagen" class="form-control"
                                        accept=".jpg, .jpeg, .png" required>
                                    @error('imagen')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <br>
                                    <output id="list"></output>
                                    <script>
                                        document.getElementById('imagen').addEventListener('change', archivo, false);

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
                        </div>


                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ url('admin/categorias') }}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-primary col-md-2"><i class="fas fa-save"></i>
                                        Crear Categoria</button>
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
