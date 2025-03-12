<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CitaGroup extends Model
{
    use HasFactory;
    protected $table = 'cita_groups';
    protected $fillable = [
        'name', 'date', 'time', 'cantidad', 'status', 'detail', 'propiedad', 'agente'
    ];

    public function guia() {
        return $this->belongsTo(Agente::class, 'agente');
    }

    public function hacienda() {
        return $this->belongsTo(Propiedade::class, 'propiedad');
    }
    public function userCitas() {
        return $this->hasMany(UserCitaGroup::class, 'group');
    }
    
    public static function controlHora($fecha, $hora)
    {
        return self::where('date', $fecha)
                   ->where('time', $hora)
                   ->exists(); // Retorna true si ya existe una cita
    }
}
