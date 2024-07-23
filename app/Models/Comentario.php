<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = 'comentarios';
    protected $primaryKey = 'id_comentario';
    public $timestamps = false;

    protected $fillable = ['id_experiencia', 'id_usuario', 'contenido'];

    public function experiencia()
    {
        return $this->belongsTo(Experiencia::class, 'id_experiencia');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}