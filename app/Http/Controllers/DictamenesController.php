<?php

namespace App\Http\Controllers;

use App\Models\Dictamenes;
use Illuminate\Http\Request;

class DictamenesController extends Controller
{
    public function index()
    {
        $dictamenes = Dictamenes::with('tipo', 'equipo')->get();
        return response()->json($dictamenes);
    }

    public function show($id)
    {
        $dictamen = Dictamenes::with('tipo', 'equipo')->findOrFail($id);
        return response()->json($dictamen);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_tipo' => 'required|exists:tipos,id',
            'id_equipo' => 'required|exists:equipos,id',
            'numero_inventario' => 'nullable|string',
            'ubicacion' => 'nullable|string',
            'adquisicion' => 'nullable|string',
            'calificacion' => 'required|in:A,B,C',
            'motivo' => 'required|string',
            'img_etiqueta' => 'nullable|string',
            'img_equipo' => 'nullable|string',
            'doc_firma' => 'nullable|string',
        ]);

        $dictamen = Dictamenes::create($request->all());
        return response()->json($dictamen, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_tipo' => 'required|exists:tipos,id',
            'id_equipo' => 'required|exists:equipos,id',
            'numero_inventario' => 'nullable|string',
            'ubicacion' => 'nullable|string',
            'adquisicion' => 'nullable|string',
            'calificacion' => 'required|in:A,B,C',
            'motivo' => 'required|string',
            'img_etiqueta' => 'nullable|string',
            'img_equipo' => 'nullable|string',
            'doc_firma' => 'nullable|string',
        ]);

        $dictamen = Dictamenes::findOrFail($id);
        $dictamen->update($request->all());
        return response()->json($dictamen);
    }

    public function destroy($id)
    {
        $dictamen = Dictamenes::findOrFail($id);
        $dictamen->delete();
        return response()->json(null, 204);
    }
}
