<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitudServicio extends Model
{
    protected $table = 'solicitud_servicios';
    
    protected $fillable = [
        'detail',
        'date',
        'date_end',
        'status',
        'description',
        'id_user',
        'tipo_servicio',
        'id_propiedad'
    ];
    
    public function usuario() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function tipoServicio() {
        return $this->belongsTo(ServiciosTipo::class, 'tipo_servicio');
    }

    public function propiedad() {
        return $this->belongsTo(Propiedade::class, 'id_propiedad');
    }
}
