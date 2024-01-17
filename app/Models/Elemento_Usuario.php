<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elemento_Usuario extends Model
{
    use HasFactory;

    protected $fillable = [
        'elemento_id', 'usuario_id'
    ];

    public $timestamps = false;

    public function elemento()
    {
        return $this->belongsToMany(Elemento::class);
    }

    public function usuario()
    {
        return $this->belongsToMany(Usuario::class);
    }
}
