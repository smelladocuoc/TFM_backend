<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coleccion_Elemento extends Model
{
    use HasFactory;

    protected $fillable = [
        'coleccion_id', 'elemento_id'
    ];

    public $timestamps = false;

    public function coleccion()
    {
        return $this->belongsToMany(Coleccion::class);
    }

    public function elemento()
    {
        return $this->belongsToMany(Elemento::class);
    }
}
