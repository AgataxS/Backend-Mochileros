<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ForoTema;
use Illuminate\Http\Request;

class ForoTemaController extends Controller
{
    public function index()
    {
        try {
            $temas = ForoTema::with('usuario')->get();
            return response()->json($temas);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los temas del foro'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_usuario' => 'required|exists:usuarios,id_usuario',
                'titulo' => 'required|string|max:200',
                'estado' => 'required|in:abierto,cerrado',
            ]);

            $tema = ForoTema::create($request->all());
            return response()->json($tema, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear el tema del foro'], 500);
        }
    }

    public function show($id)
    {
        try {
            $tema = ForoTema::with('usuario', 'respuestas')->findOrFail($id);
            return response()->json($tema);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Tema del foro no encontrado'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'id_usuario' => 'required|exists:usuarios,id_usuario',
                'titulo' => 'required|string|max:200',
                'estado' => 'required|in:abierto,cerrado',
            ]);

            $tema = ForoTema::findOrFail($id);
            $tema->update($request->all());
            return response()->json($tema);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el tema del foro'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $tema = ForoTema::findOrFail($id);
            $tema->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el tema del foro'], 500);
        }
    }
}