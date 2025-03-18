<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;
    protected $table = 'respuestas';
    protected $fillable = ['question'];

    public function respuestasSelect()
    {
        return $this->hasMany(RespuestasSeleccionada::class, 'respuesta_id');
    }

    public function preguntas()
    {
        return $this->belongsToMany(Pregunta::class, 'respuestas_seleccionadas');
    }
}
