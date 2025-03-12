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

    public function encuesta() {
        return $this->belongsTo(Encuesta::class, 'encuesta_id');
    }

    public static function preguntasPorEncuesta($encuestaId)
    {
        return self::where('encuesta_id', $encuestaId)->get();
    }
}
