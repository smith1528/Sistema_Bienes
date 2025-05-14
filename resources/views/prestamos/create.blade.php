@extends('layouts.app')

@section('title', 'Registrar Préstamo')

@section('content')
    <div class="max-w-2xl mx-auto mt-6">
        <h2 class="text-2xl font-semibold mb-4">Registrar Préstamo para: {{ $bien->nombre }}</h2>

        <!-- Mensajes de error de validación -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <strong>¡Ups!</strong> Hay algunos errores:
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario de Registro de Préstamo -->
        <form action="{{ route('prestamos.store', $bien->id) }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="usuario_id" class="block font-bold">Usuario:</label>
                <input type="number" name="usuario_id" id="usuario_id" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label for="fecha_prestamo" class="block font-bold">Fecha de Préstamo:</label>
                <input type="date" name="fecha_prestamo" id="fecha_prestamo" class="w-full border rounded px-3 py-2" required>
            </div>

            <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700">
                Realizar Préstamo
            </button>
        </form>
    </div>
@endsection
