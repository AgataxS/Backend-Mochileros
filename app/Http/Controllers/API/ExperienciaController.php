<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Experiencia;
use Illuminate\Http\Request;

class ExperienciaController extends Controller
{
    public function index()
    {
        try {
            $experiencias = Experiencia::with('usuario', 'destino')->get();
            return response()->json($experiencias);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener las experiencias'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_usuario' => 'required|exists:usuarios,id_usuario',
                'id_destino' => 'required|exists:destinos,id_destino',
                'titulo' => 'required|string|max:200',
                'descripcion' => 'nullable|string',
                'fecha_inicio_viaje' => 'nullable|date',
                'fecha_fin_viaje' => 'nullable|date',
                'estado' => 'required|in:borrador,publicado,archivado',
            ]);

            $experiencia = Experiencia::create($request->all());
            return response()->json($experiencia, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear la experiencia'], 500);
        }
    }

    public function show($id)
    {
        try {
            $experiencia = Experiencia::with('usuario', 'destino', 'comentarios', 'valoraciones')->findOrFail($id);
            return response()->json($experiencia);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Experiencia no encontrada'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'id_usuario' => 'required|exists:usuarios,id_usuario',
                'id_destino' => 'required|exists:destinos,id_destino',
                'titulo' => 'required|string|max:200',
                'descripcion' => 'nullable|string',
                'fecha_inicio_viaje' => 'nullable|date',
                'fecha_fin_viaje' => 'nullable|date',
                'estado' => 'required|in:borrador,publicado,archivado',
            ]);

            $experiencia = Experiencia::findOrFail($id);
            $experiencia->update($request->all());
            return response()->json($experiencia);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar la experiencia'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $experiencia = Experiencia::findOrFail($id);
            $experiencia->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar la experiencia'], 500);
        }
    }
}