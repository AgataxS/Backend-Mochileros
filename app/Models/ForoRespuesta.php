<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForoRespuesta extends Model
{
    protected $table = 'foro_respuestas';
    protected $primaryKey = 'id_foro_respuesta';
    public $timestamps = false;

    protected $fillable = ['id_foro_tema', 'id_usuario', 'contenido'];

    public function foroTema()
    {
        return $this->belongsTo(ForoTema::class, 'id_foro_tema');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}