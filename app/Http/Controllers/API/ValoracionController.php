<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Valoracion;
use Illuminate\Http\Request;

class ValoracionController extends Controller
{
    public function index()
    {
        try {
            $valoraciones = Valoracion::with('experiencia', 'usuario')->get();
            return response()->json($valoraciones);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener las valoraciones'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_experiencia' => 'required|exists:experiencias,id_experiencia',
                'id_usuario' => 'required|exists:usuarios,id_usuario',
                'puntuacion' => 'required|integer|min:1|max:5',
                'comentario_breve' => 'nullable|string|max:200',
            ]);

            $valoracion = Valoracion::create($request->all());
            return response()->json($valoracion, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear la valoración'], 500);
        }
    }

    public function show($id)
    {
        try {
            $valoracion = Valoracion::with('experiencia', 'usuario')->findOrFail($id);
            return response()->json($valoracion);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Valoración no encontrada'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'id_experiencia' => 'required|exists:experiencias,id_experiencia',
                'id_usuario' => 'required|exists:usuarios,id_usuario',
                'puntuacion' => 'required|integer|min:1|max:5',
                'comentario_breve' => 'nullable|string|max:200',
            ]);

            $valoracion = Valoracion::findOrFail($id);
            $valoracion->update($request->all());
            return response()->json($valoracion);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar la valoración'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $valoracion = Valoracion::findOrFail($id);
            $valoracion->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar la valoración'], 500);
        }
    }
}