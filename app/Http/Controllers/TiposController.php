<?php

namespace App\Http\Controllers;

use App\Models\Tipos;
use Illuminate\Http\Request;

class TiposController extends Controller
{
    public function index()
    {
        $tipos = Tipos::all();
        return response()->json($tipos);
    }

    public function show($id)
    {
        $tipo = Tipos::findOrFail($id);
        return response()->json($tipo);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
        ]);

        $tipo = Tipos::create($request->all());
        return response()->json($tipo, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string',
        ]);

        $tipo = Tipos::findOrFail($id);
        $tipo->update($request->all());
        return response()->json($tipo);
    }

    public function destroy($id)
    {
        $tipo = Tipos::findOrFail($id);
        $tipo->delete();
        return response()->json(null, 204);
    }
}
