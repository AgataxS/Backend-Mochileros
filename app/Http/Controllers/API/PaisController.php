<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pais;
use Illuminate\Http\Request;

class PaisController extends Controller
{
    public function index()
    {
        try {
            $paises = Pais::all();
            return response()->json($paises);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los países'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre_pais' => 'required|string|max:100',
            ]);

            $pais = Pais::create($request->all());
            return response()->json($pais, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear el país'], 500);
        }
    }

    public function show($id)
    {
        try {
            $pais = Pais::findOrFail($id);
            return response()->json($pais);
        } catch (\Exception $e) {
            return response()->json(['error' => 'País no encontrado'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nombre_pais' => 'required|string|max:100',
            ]);

            $pais = Pais::findOrFail($id);
            $pais->update($request->all());
            return response()->json($pais);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el país'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $pais = Pais::findOrFail($id);
            $pais->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el país'], 500);
        }
    }
}