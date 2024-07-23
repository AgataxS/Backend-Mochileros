<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        try {
            $usuarios = Usuario::with('rol')->get();
            return response()->json($usuarios);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los usuarios'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_rol' => 'required|exists:roles,id_rol',
                'nombre' => 'required|string|max:100',
                'apellido' => 'nullable|string|max:100',
                'email' => 'required|email|unique:usuarios,email',
                'contraseña' => 'required|string|min:8',
                'fecha_nacimiento' => 'nullable|date',
                'genero' => 'nullable|string|max:20',
                'biografia' => 'nullable|string',
                'foto_perfil' => 'nullable|string|max:200',
            ]);

            $usuario = Usuario::create([
                'id_rol' => $request->id_rol,
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'email' => $request->email,
                'contraseña' => Hash::make($request->contraseña),
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'genero' => $request->genero,
                'biografia' => $request->biografia,
                'foto_perfil' => $request->foto_perfil,
            ]);

            return response()->json($usuario, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear el usuario'], 500);
        }
    }

    public function show($id)
    {
        try {
            $usuario = Usuario::with('rol')->findOrFail($id);
            return response()->json($usuario);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'id_rol' => 'required|exists:roles,id_rol',
                'nombre' => 'required|string|max:100',
                'apellido' => 'nullable|string|max:100',
                'email' => 'required|email|unique:usuarios,email,'.$id.',id_usuario',
                'contraseña' => 'nullable|string|min:8',
                'fecha_nacimiento' => 'nullable|date',
                'genero' => 'nullable|string|max:20',
                'biografia' => 'nullable|string',
                'foto_perfil' => 'nullable|string|max:200',
            ]);

            $usuario = Usuario::findOrFail($id);
            $usuario->update([
                'id_rol' => $request->id_rol,
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'email' => $request->email,
                'contraseña' => $request->contraseña ? Hash::make($request->contraseña) : $usuario->contraseña,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'genero' => $request->genero,
                'biografia' => $request->biografia,
                'foto_perfil' => $request->foto_perfil,
            ]);

            return response()->json($usuario);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el usuario'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $usuario = Usuario::findOrFail($id);
            $usuario->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el usuario'], 500);
        }
    }
}