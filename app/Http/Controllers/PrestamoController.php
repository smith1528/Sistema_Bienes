<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Prestamo;
use App\Models\Bien;
use Illuminate\Http\Request;

class PrestamoController extends Controller
{
    public function create($bien_id)
    {
        $bien = Bien::findOrFail($bien_id);
        return view('prestamos.create', compact('bien'));
    }

    public function store(Request $request, $bien_id)
    {
        $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'fecha_prestamo' => 'required|date',
        ]);

        // Crear el préstamo
        $prestamo = Prestamo::create([
            'bien_id' => $bien_id,
            'usuario_id' => $request->usuario_id,
            'fecha_prestamo' => $request->fecha_prestamo,
            'estado' => 'prestado',
        ]);

        // Actualizar el estado del bien
        $bien = Bien::findOrFail($bien_id);
        $bien->update(['estado' => 'Asignado']);

        return redirect()->route('prestamos.index')->with('success', 'Préstamo realizado correctamente.');
    }
}
