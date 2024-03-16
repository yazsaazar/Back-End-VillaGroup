<?php

namespace App\Http\Controllers;

use App\Models\Departamentos;
use Illuminate\Http\Request;

class DepartamentosController extends Controller
{
    public function index()
    {
        $departamentos = Departamentos::all();
        return response()->json($departamentos);
    }

    public function show($id)
    {
        $departamento = Departamentos::findOrFail($id);
        return response()->json($departamento);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
        ]);

        $departamento = Departamentos::create($request->all());
        return response()->json($departamento, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string',
        ]);

        $departamento = Departamentos::findOrFail($id);
        $departamento->update($request->all());
        return response()->json($departamento);
    }

    public function destroy($id)
    {
        $departamento = Departamentos::findOrFail($id);
        $departamento->delete();
        return response()->json(null, 204);
    }
}
