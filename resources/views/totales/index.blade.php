@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Total de Ventas</h1>

    <!-- Formulario de Filtro por Fecha -->
    <form method="GET" action="{{ route('totales.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <label for="fecha_inicio">Fecha Inicio:</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" 
                       class="form-control" value="{{ old('fecha_inicio', $fechaInicio) }}" required>
            </div>
            <div class="col-md-4">
                <label for="fecha_fin">Fecha Fin:</label>
                <input type="date" id="fecha_fin" name="fecha_fin" 
                       class="form-control" value="{{ old('fecha_fin', $fechaFin) }}" required>
            </div>
            
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
            </div>
        </div>
    </form>

    <!-- Resultados de la Consulta -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-info text-white">
                    Total Ventas en Dólares
                </div>
                <div class="card-body">
                    <h3>$ {{ number_format($totalDolares, 2) }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    Total Ventas en Bolívares
                </div>
                <div class="card-body">
                    <h3>Bs. {{ number_format($totalBolivares, 2) }}</h3>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('ventas.index') }}" class="btn btn-secondary mt-3">Volver a la lista de ventas</a>
</div>
@endsection
