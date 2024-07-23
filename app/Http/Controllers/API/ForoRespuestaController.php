<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ForoRespuesta;
use Illuminate\Http\Request;

class ForoRespuestaController extends Controller
{
    public function index()
    {
        try {
            $respuestas = ForoRespuesta::with('foroTema', 'usuario')->get();
            return response()->json($respuestas);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener las respuestas del foro'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_foro_tema' => 'required|exists:foro_temas,id_foro_tema',
                'id_usuario' => 'required|exists:usuarios,id_usuario',
                'contenido' => 'required|string',
            ]);

            $respuesta = ForoRespuesta::create($request->all());
            return response()->json($respuesta, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear la respuesta del foro'], 500);
        }
    }

    public function show($id)
    {
        try {
            $respuesta = ForoRespuesta::with('foroTema', 'usuario')->findOrFail($id);
            return response()->json($respuesta);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Respuesta del foro no encontrada'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'id_foro_tema' => 'required|exists:foro_temas,id_foro_tema',
                'id_usuario' => 'required|exists:usuarios,id_usuario',
                'contenido' => 'required|string',
            ]);

            $respuesta = ForoRespuesta::findOrFail($id);
            $respuesta->update($request->all());
            return response()->json($respuesta);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar la respuesta del foro'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $respuesta = ForoRespuesta::findOrFail($id);
            $respuesta->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar la respuesta del foro'], 500);
        }
    }
}