<?php

namespace App\Http\Controllers;

use App\Models\Equipos;
use Illuminate\Http\Request;

class EquiposController extends Controller
{
    public function index()
    {
        $equipos = Equipos::with('resort', 'tipo')->get();
        return response()->json($equipos);
    }

    public function show($id)
    {
        $equipo = Equipos::with('resort', 'tipo')->findOrFail($id);
        return response()->json($equipo);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_resort' => 'required|exists:resorts,id',
            'fecha_compra' => 'nullable|date',
            'marca' => 'nullable|string',
            'modelo' => 'nullable|string',
            'numero_serie' => 'required|string',
            'id_tipo' => 'required|exists:tipos,id',
            'especificaciones' => 'nullable|string',
            'garantia' => 'nullable|string',
            'etiqueta' => 'nullable|string',
            'nota' => 'nullable|string',
        ]);

        $equipo = Equipos::create($request->all());
        return response()->json($equipo, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_resort' => 'required|exists:resorts,id',
            'fecha_compra' => 'nullable|date',
            'marca' => 'nullable|string',
            'modelo' => 'nullable|string',
            'numero_serie' => 'required|string',
            'id_tipo' => 'required|exists:tipos,id',
            'especificaciones' => 'nullable|string',
            'garantia' => 'nullable|string',
            'etiqueta' => 'nullable|string',
            'nota' => 'nullable|string',
        ]);

        $equipo = Equipos::findOrFail($id);
        $equipo->update($request->all());
        return response()->json($equipo);
    }

    public function destroy($id)
    {
        $equipo = Equipos::findOrFail($id);
        $equipo->delete();
        return response()->json(null, 204);
    }
}
