@extends('layouts.admin')

@section('content')

    <h1>Detalles del Proveedor</h1>
     <p class="card-text"><strong>Nombre:</strong> {{ $proveedor->nombre }}</p>
     <p class="card-text"><strong>Cédula / Rif:</strong> {{ $proveedor->cedula }}</p>
    <p class="card-text"><strong>Email:</strong> {{ $proveedor->email }}</p>
     <p class="card-text"><strong>Teléfono:</strong> {{ $proveedor->telefono }}</p>
    <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">Regresar</a>

@endsection
