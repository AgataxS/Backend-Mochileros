<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Destino;
use Illuminate\Http\Request;

class DestinoController extends Controller
{
    public function index()
    {
        try {
            $destinos = Destino::with('pais')->get();
            return response()->json($destinos);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los destinos'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_pais' => 'required|exists:paises,id_pais',
                'nombre' => 'required|string|max:100',
                'descripcion' => 'nullable|string',
            ]);

            $destino = Destino::create($request->all());
            return response()->json($destino, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear el destino'], 500);
        }
    }

    public function show($id)
    {
        try {
            $destino = Destino::with('pais')->findOrFail($id);
            return response()->json($destino);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Destino no encontrado'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'id_pais' => 'required|exists:paises,id_pais',
                'nombre' => 'required|string|max:100',
                'descripcion' => 'nullable|string',
            ]);

            $destino = Destino::findOrFail($id);
            $destino->update($request->all());
            return response()->json($destino);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el destino'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $destino = Destino::findOrFail($id);
            $destino->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el destino'], 500);
        }
    }
}