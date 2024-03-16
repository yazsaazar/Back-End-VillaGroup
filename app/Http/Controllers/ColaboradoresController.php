<?php

namespace App\Http\Controllers;

use App\Models\Colaboradores;
use Illuminate\Http\Request;

class ColaboradoresController extends Controller
{
    public function index()
    {
        $colaboradores = Colaboradores::with('area:id,nombre', 'resort:id,nombre')->get();
        return response()->json($colaboradores);
    }

    public function show($id)
    {
        $colaborador = Colaboradores::with('area:id,nombre', 'resort:id,nombre')->findOrFail($id);
        return response()->json($colaborador);
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_colaborador' => 'required|string',
            'nombre' => 'required|string',
            'apellidos' => 'required|string',
            'puesto' => 'required|string',
            'id_area' => 'required|exists:areas,id',
            'id_resort' => 'required|exists:resorts,id',
            'nota' => 'nullable|string',
            'estado' => 'required|in:habilitado,deshabilitado', // Ahora validamos que el estado sea 'habilitado' o 'deshabilitado'
        ]);

        // Establecemos el estado predeterminado en 'habilitado' si no se proporciona
        $estado = $request->input('estado', 'habilitado');

        $colaboradorData = $request->except('estado'); // Excluimos el campo 'estado' de los datos del colaborador
        $colaboradorData['estado'] = $estado; // Asignamos el estado determinado

        $colaborador = Colaboradores::create($colaboradorData);
        return response()->json($colaborador, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'numero_colaborador' => 'required|string',
            'nombre' => 'required|string',
            'apellidos' => 'required|string',
            'puesto' => 'required|string',
            'id_area' => 'required|exists:areas,id',
            'id_resort' => 'required|exists:resorts,id',
            'nota' => 'nullable|string',
            'estado' => 'required|in:habilitado,deshabilitado',
        ]);

        $colaborador = Colaboradores::findOrFail($id);
        $colaborador->update($request->all());
        return response()->json($colaborador);
    }

    public function destroy($id)
    {
        $colaborador = Colaboradores::findOrFail($id);
        $colaborador->delete();
        return response()->json(null, 204);
    }
}
