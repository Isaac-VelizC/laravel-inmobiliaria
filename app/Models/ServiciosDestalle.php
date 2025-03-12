<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiciosDestalle extends Model
{
    protected $fillable = [
        'name',
        'price',
        //'id_servicio',
    ];

    /*public function servicio() {
        return $this->belongsTo(Servicio::class, 'id_servicio');
    }*/
}
