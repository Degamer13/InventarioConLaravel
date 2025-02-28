@extends(Auth::user()->hasRole('ventas') ? 'layouts.app' : 'layouts.admin')

@section('content')
    <div class="container">  
    <h3>Crear Precio</h3>

    <!-- Mostrar mensajes de éxito o errores de validación -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulario para crear un nuevo precio -->
    <form action="{{ route('precios.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="dolar" class="form-label">Dólar</label>
            <input type="number" name="dolar" class="form-control" step="0.01" 
                   value="{{ old('dolar') }}" placeholder="Ingrese el valor del dólar" required>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" name="precio" class="form-control" step="0.01" 
                   value="{{ old('precio') }}" placeholder="Ingrese el precio" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('precios.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
