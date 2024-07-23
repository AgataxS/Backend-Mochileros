<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;

    protected $fillable = [
        'id_rol',
        'nombre',
        'apellido',
        'email',
        'contraseña',
        'fecha_nacimiento',
        'genero',
        'biografia',
        'foto_perfil',
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }

    public function experiencias()
    {
        return $this->hasMany(Experiencia::class, 'id_usuario');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'id_usuario');
    }

    public function foroTemas()
    {
        return $this->hasMany(ForoTema::class, 'id_usuario');
    }

    public function foroRespuestas()
    {
        return $this->hasMany(ForoRespuesta::class, 'id_usuario');
    }

    public function valoraciones()
    {
        return $this->hasMany(Valoracion::class, 'id_usuario');
    }
}