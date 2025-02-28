@extends('layouts.admin')
@section('content')
<div class="container">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Roles</h3>
        </div>

    </div>
</div>

     <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">Agregar Rol</a>
    <div class="col-12 col-md-6 mb-3">

        <form class="">

            <div class="input-group" >
        <input type="text" class="form-control"   name="buscarpor" value="{{$buscarpor}}"   type="search" placeholder="Buscar" aria-label="Search" aria-describedby="button-addon2">
        <div class="input-group-append">
          <button class="btn btn-success"  id="button-addon2" type="submit">Buscar</button>
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

        <th>Nombre</th>
        <th width="280px">Acciones</th>
    </tr>

    @foreach ($roles as $key => $role)
    <tr>

        <td>{{ $role->name }}</td>
        <td class="text-center">
            <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Visualizar</a>
            @can('role-edit')
                <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Editar</a>
            @endcan
            @can('role-delete')
            <form method="POST" action="{{ route('roles.destroy', $role->id) }}" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                  Eliminar
                </button>
            </form>
            @endcan
        </td>
    </tr>
    @endforeach
</table>
</div>
{!! $roles->render() !!}

@endsection
