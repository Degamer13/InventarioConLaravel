@extends(Auth::user()->hasRole('ventas') ? 'layouts.app' : 'layouts.admin')

@section('content')
    <div class="container">


    <h3>Editar Precio</h3>

    <form action="{{ route('precios.update', $precio->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="dolar" class="form-label">Dólar</label>
            <input type="number" name="dolar" class="form-control" step="0.01"
                   value="{{ old('dolar', $precio->dolar ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" name="precio" class="form-control" step="0.01"
                   value="{{ old('precio', $precio->precio ?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('precios.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
