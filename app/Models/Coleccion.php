<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coleccion extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_coleccion', 'tipo_coleccion', 'imagen_coleccion'
    ];

    public $timestamps = false;

    public function elementos()
    {
        return $this->hasMany(Elemento::class);
    }
}
