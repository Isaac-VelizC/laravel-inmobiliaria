<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespuestasSeleccionada extends Model
{
    use HasFactory;
    protected $table = 'respuestas_seleccionadas';
    protected $fillable = ['pregunta_id', 'respuesta_id'];

    public function preguntaSelect() {
        return $this->belongsTo(Pregunta::class, 'pregunta_id');
    }

    public function respuestaSelect() {
        return $this->belongsTo(Respuesta::class, 'respuesta_id');
    }
}
