<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    public function index()
    {
        try {
            $roles = Rol::all();
            return response()->json($roles);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los roles'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre_rol' => 'required|string|max:50',
            ]);

            $rol = Rol::create($request->all());
            return response()->json($rol, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear el rol'], 500);
        }
    }

    public function show($id)
    {
        try {
            $rol = Rol::findOrFail($id);
            return response()->json($rol);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Rol no encontrado'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nombre_rol' => 'required|string|max:50',
            ]);

            $rol = Rol::findOrFail($id);
            $rol->update($request->all());
            return response()->json($rol);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el rol'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $rol = Rol::findOrFail($id);
            $rol->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el rol'], 500);
        }
    }
}