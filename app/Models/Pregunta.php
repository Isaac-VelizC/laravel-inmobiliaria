<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $table = 'preguntas';

    protected $fillable = [
        'question',
        'encuesta_id',
    ];

    // En App\Models\Pregunta
    public function respuestas()
    {
        return $this->belongsToMany(
            Respuesta::class,
            'respuestas_seleccionadas', // Tabla pivote
            'pregunta_id', // FK en la tabla pivote que apunta a Pregunta
            'respuesta_id' // FK en la tabla pivote que apunta a Respuesta
        );
    }

    public function encuesta()
    {
        return $this->belongsTo(Encuesta::class, 'encuesta_id');
    }

    public static function preguntasPorEncuesta($encuestaId)
    {
        return self::where('encuesta_id', $encuestaId)->get();
    }
}
