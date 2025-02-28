@extends('layouts.admin')

@section('content')
<div class="container">
<div class="row">
    <div class="col-lg-9">
        <div class="pull-left">
            <h3>Usuarios</h3>
        </div>

    </div>
</div>

     <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Agregar Usuario</a>
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
        <th>Correo Electronico</th>
        <th>Roles</th>

        <th width="280px">Acciones</th>
    </tr>
@foreach ($data as $key => $user)
    <tr>

        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
            @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                    <span class="badge rounded-pill bg-dark">{{ $v }}</span>
                @endforeach
            @endif
        </td>

        <td class="text-center">
            <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Visuarizar</a>
          @can('user-edit')


            <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Editar</a>
            @endcan
            @can('user-delete')


            <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                   Eliminar
                </button>
            </form>  @endcan
        </td>
    </tr>
@endforeach
</table>
</div>


{!! $data->render() !!}

@endsection
