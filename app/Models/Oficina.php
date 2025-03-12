<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oficina extends Model
{
    public $timestamps = false;
    protected $table = 'oficinas';
    protected $fillable = [
        'name',
        'address',
        'city',
        'status',
        'country',
        'number'
    ];

    public function agente()
    {
        return $this->belongsTo(Agente::class, 'oficina');
    }
}
