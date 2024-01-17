<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elemento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'imagen', 'fecha_publicacion', 'comentario'
    ];

    public $timestamps = false;

    public function coleccions()
    {
        return $this->hasMany(Coleccion::class);
    }
}
