<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Valoracion extends Model
{
    protected $table = 'valoraciones';
    protected $primaryKey = 'id_valoracion';
    public $timestamps = false;

    protected $fillable = ['id_experiencia', 'id_usuario', 'puntuacion', 'comentario_breve'];

    public function experiencia()
    {
        return $this->belongsTo(Experiencia::class, 'id_experiencia');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}