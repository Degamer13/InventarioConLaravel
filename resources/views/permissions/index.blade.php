@extends('layouts.admin')

@section('content')
<div class="container mt-1">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Permisos</h3>

            </div>
        </div>
    </div>


 <a href="{{ route('permissions.create') }}" class="btn btn-primary mb-3">Agregar Permiso</a>
    <div class="col-12 col-md-6 mb-3">
        <form method="GET" action="{{ route('permissions.index') }}">
            <div class="input-group">
                <input type="text" class="form-control" name="buscarpor" value="{{ $buscarpor }}" placeholder="Buscar permisos" aria-label="Search" aria-describedby="button-addon2">
                <button class="btn btn-success"  id="button-addon2" type="submit">Buscar</button>
            </div>
        </form>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered">

                <tr>
                    <th>Nombre</th>
                    <th class="text-center" width="280px">Acciones</th>
                </tr>

            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td class="text-center">
                            <a class="btn btn-info " href="{{ route('permissions.show', $permission->id) }}">Visualizar</a>
                            @can('permission-edit')
                                <a class="btn btn-primary" href="{{ route('permissions.edit', $permission->id) }}">Editar</a>
                            @endcan
                            @can('permission-delete')
                                <form method="POST" action="{{ route('permissions.destroy', $permission->id) }}" style="display:inline" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
            
        </table>

    <!-- Paginación -->

        {!! $permissions->links() !!}

    </div>

</div>
@endsection
