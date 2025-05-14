@extends('layouts.app')

@section('title', 'Detalles del Préstamo')

@section('content')
    <div class="max-w-2xl mx-auto mt-6">
        <h2 class="text-2xl font-semibold mb-6">Detalles del Préstamo: {{ $prestamo->bien->nombre }}</h2>

        <p><strong>Bien:</strong> {{ $prestamo->bien->nombre }}</p>
        <p><strong>Usuario:</strong> {{ $prestamo->usuario->name }}</p>
        <p><strong>Fecha de Préstamo:</strong> {{ $prestamo->fecha_prestamo }}</p>
        <p><strong>Estado:</strong> {{ $prestamo->estado }}</p>

        <!-- Formulario para registrar la devolución -->
        @if($prestamo->estado === 'prestado')
        <form method="POST" action="{{ route('devoluciones.store', $prestamo->id) }}">
            @csrf

            <div>
                <label for="estado" class="block font-bold">Estado de la Devolución:</label>
                <select name="estado" id="estado" class="w-full border rounded px-3 py-2" required>
                    <option value="completa">Completa</option>
                    <option value="parcial">Parcial</option>
                    <option value="dañado">Dañado</option>
                </select>
            </div>

            <div>
                <label for="fecha_devolucion" class="block font-bold">Fecha de Devolución:</label>
                <input type="date" name="fecha_devolucion" id="fecha_devolucion" class="w-full border rounded px-3 py-2" required>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700">
                Registrar Devolución
            </button>
        </form>
        @endif
    </div>
@endsection
