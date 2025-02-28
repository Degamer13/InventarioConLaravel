<!-- resources/views/categorias/index.blade.php -->
@extends('layouts.admin')
@section('content')

    <h3>Categorías</h3>
    
    @can('categoria-create')
        <a href="{{ route('categorias.create') }}" class="btn btn-primary mb-3">Agregar Categoría</a>
    @endcan

    <div class="col-12 col-md-6 mb-3">
        <form>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="buscarpor" value="{{ $buscarpor }}" placeholder="Buscar categoría..." aria-label="Search" aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-success" id="button-addon2" type="submit">Buscar</button>
                </div>
            </div>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th width="280px">Acciones</th>
            </tr>
            <tbody>
                @foreach ($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->id }}</td>
                        <td>{{ $categoria->nombre }}</td>
                        <td class="text-center">
                            @can('categoria-edit')
                                <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-primary">Editar</a>
                            @endcan

                            @can('categoria-delete')
                                <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" >Eliminar</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {!! $categorias->render() !!}

@endsection
