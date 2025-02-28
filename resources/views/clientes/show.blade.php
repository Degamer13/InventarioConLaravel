@extends(Auth::user()->hasRole('ventas') ? 'layouts.app' : 'layouts.admin')
@section('content')
    <div class="container">  

    <h3>Detalle del Cliente</h3>

    
          <p class="card-text"><strong>Nombre:</strong> {{ $cliente->nombre }}</p>
          <p class="card-text"><strong>Cédula:</strong> {{ $cliente->cedula }}</p>
          <p class="card-text"><strong>Email:</strong> {{ $cliente->email }}</p>
          <p class="card-text"><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>

    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Regresar</a>
</div>
@endsection
