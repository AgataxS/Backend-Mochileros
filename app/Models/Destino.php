<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destino extends Model
{
    protected $table = 'destinos';
    protected $primaryKey = 'id_destino';
    public $timestamps = false;

    protected $fillable = ['id_pais', 'nombre', 'descripcion'];

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'id_pais');
    }

    public function experiencias()
    {
        return $this->hasMany(Experiencia::class, 'id_destino');
    }
}