<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
    use HasFactory;
    protected $table = 'resultados';
    protected $fillable = [
        'user_id',
        'cita_id',
        'encuesta_id',
        'pregunta_id',
        'respuesta_id'
    ];

    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class, 'pregunta_id');
    }

    public function respuestaSelect()
    {
        return $this->belongsTo(Respuesta::class, 'respuesta_id');
    }

    public function encuesta()
    {
        return $this->belongsTo(Encuesta::class, 'encuesta_id');
    }

    public function usuario() {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function cita() {
        return $this->belongsTo(Cita::class, 'cita_id');
    }

    public static function obtenerRespuestasPorCita(int $citaId)
    {
        return static::where('cita_id', $citaId)
            ->with('pregunta.encuesta')
            ->get();
    }
}
