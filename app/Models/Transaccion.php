<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    protected $fillable = [
        'date', 'price', 'propiedad', 'comprador', 'vendedor'
    ];

    public function propiedad() {
        return $this->belongsTo(Propiedade::class, 'propiedad');
    }

    public function comprador()
    {
        return $this->belongsTo(User::class, 'comprador');
    }
    
    public function vendedor()
    {
        return $this->belongsTo(Agente::class, 'vendedor');
    }
}
