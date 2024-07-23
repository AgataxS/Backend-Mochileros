<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table = 'paises';
    protected $primaryKey = 'id_pais';
    public $timestamps = false;

    protected $fillable = ['nombre_pais'];

    public function destinos()
    {
        return $this->hasMany(Destino::class, 'id_pais');
    }
}