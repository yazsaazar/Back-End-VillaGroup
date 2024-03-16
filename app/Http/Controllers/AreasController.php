<?php

namespace App\Http\Controllers;

use App\Models\Areas;
use Illuminate\Http\Request;

class AreasController extends Controller
{
    public function index()
    {
        $areas = Areas::with('departamento')->get();
        return response()->json($areas);
    }

    public function show($id)
    {
        $area = Areas::with('departamento')->findOrFail($id);
        return response()->json($area);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'id_departamento' => 'required|exists:departamentos,id',
        ]);

        $area = Areas::create($request->all());
        return response()->json($area, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string',
            'id_departamento' => 'required|exists:departamentos,id',
        ]);

        $area = Areas::findOrFail($id);
        $area->update($request->all());
        return response()->json($area);
    }

    public function destroy($id)
    {
        $area = Areas::findOrFail($id);
        $area->delete();
        return response()->json(null, 204);
    }
}
