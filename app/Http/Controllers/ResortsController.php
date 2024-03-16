<?php

namespace App\Http\Controllers;

use App\Models\Resorts;
use Illuminate\Http\Request;

class ResortsController extends Controller
{
    public function index()
    {
        $resorts = Resorts::all();
        return response()->json($resorts);
    }

    public function show($id)
    {
        $resort = Resorts::findOrFail($id);
        return response()->json($resort);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'imagen' => 'nullable|string',
        ]);

        $resort = Resorts::create($request->all());
        return response()->json($resort, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string',
            'imagen' => 'nullable|string', 
        ]);

        $resort = Resorts::findOrFail($id);
        $resort->update($request->all());
        return response()->json($resort);
    }

    public function destroy($id)
    {
        $resort = Resorts::findOrFail($id);
        $resort->delete();
        return response()->json(null, 204);
    }
}

