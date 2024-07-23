<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function index()
    {
        try {
            $comentarios = Comentario::with('experiencia', 'usuario')->get();
            return response()->json($comentarios);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los comentarios'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_experiencia' => 'required|exists:experiencias,id_experiencia',
                'id_usuario' => 'required|exists:usuarios,id_usuario',
                'contenido' => 'required|string',
            ]);

            $comentario = Comentario::create($request->all());
            return response()->json($comentario, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear el comentario'], 500);
        }
    }

    public function show($id)
    {
        try {
            $comentario = Comentario::with('experiencia', 'usuario')->findOrFail($id);
            return response()->json($comentario);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Comentario no encontrado'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'id_experiencia' => 'required|exists:experiencias,id_experiencia',
                'id_usuario' => 'required|exists:usuarios,id_usuario',
                'contenido' => 'required|string',
            ]);

            $comentario = Comentario::findOrFail($id);
            $comentario->update($request->all());
            return response()->json($comentario);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el comentario'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $comentario = Comentario::findOrFail($id);
            $comentario->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el comentario'], 500);
        }
    }
}