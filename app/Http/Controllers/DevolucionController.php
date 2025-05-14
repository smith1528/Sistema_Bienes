<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Devolucion;
use App\Models\Prestamo;
use Illuminate\Http\Request;

class DevolucionController extends Controller
{
    // Método para crear una devolución
    public function store(Request $request, $prestamo_id)
    {
        // Validación
        $request->validate([
            'estado' => 'required|in:completa,parcial,dañado',
            'fecha_devolucion' => 'required|date',
        ]);

        // Verificar si el préstamo existe
        $prestamo = Prestamo::findOrFail($prestamo_id);

        // Crear la devolución
        $devolucion = Devolucion::create([
            'prestamo_id' => $prestamo->id,
            'fecha_devolucion' => $request->fecha_devolucion,
            'estado' => $request->estado,
        ]);

        // Actualizar el estado del préstamo a 'devuelto'
        $prestamo->update(['estado' => 'devuelto']);

        return redirect()->route('prestamos.index')->with('success', 'Devolución registrada correctamente.');
    }
}

