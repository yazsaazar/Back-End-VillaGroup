<?php

namespace App\Http\Controllers;

use App\Models\Resguardos;
use Illuminate\Http\Request;

class ResguardosController extends Controller
{
    public function index()
    {
        $resguardos = Resguardos::with('colaborador', 'resort', 'area', 'equipo')->get();
        return response()->json($resguardos);
    }

    public function show($id)
    {
        $resguardo = Resguardos::with('colaborador', 'resort', 'area', 'equipo')->findOrFail($id);
        return response()->json($resguardo);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_colaborador' => 'required|exists:colaboradores,id',
            'fecha' => 'nullable|date',
            'id_resort' => 'required|exists:resorts,id',
            'id_area' => 'required|exists:areas,id',
            'puesto' => 'nullable|string',
            'id_equipo' => 'required|exists:equipos,id',
            'doc_firma' => 'nullable|string',
        ]);

        $resguardo = Resguardos::create($request->all());
        return response()->json($resguardo, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_colaborador' => 'required|exists:colaboradores,id',
            'fecha' => 'nullable|date',
            'id_resort' => 'required|exists:resorts,id',
            'id_area' => 'required|exists:areas,id',
            'puesto' => 'nullable|string',
            'id_equipo' => 'required|exists:equipos,id',
            'doc_firma' => 'nullable|string',
        ]);

        $resguardo = Resguardos::findOrFail($id);
        $resguardo->update($request->all());
        return response()->json($resguardo);
    }

    public function destroy($id)
    {
        $resguardo = Resguardos::findOrFail($id);
        $resguardo->delete();
        return response()->json(null, 204);
    }
}
