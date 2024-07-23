<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experiencia extends Model
{
    protected $table = 'experiencias';
    protected $primaryKey = 'id_experiencia';
    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'id_destino',
        'titulo',
        'descripcion',
        'fecha_inicio_viaje',
        'fecha_fin_viaje',
        'estado',
        'votos_positivos',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function destino()
    {
        return $this->belongsTo(Destino::class, 'id_destino');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'id_experiencia');
    }

    public function valoraciones()
    {
        return $this->hasMany(Valoracion::class, 'id_experiencia');
    }
}