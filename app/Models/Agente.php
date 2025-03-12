<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agente extends Model
{
    protected $table = 'agentes';

    protected $fillable = [
        'status', 'oficina', 'id_user'
    ];

    public function oficina()
    {
        return $this->belongsTo(Oficina::class, 'oficina');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function groups() {
        return $this->hasMany(CitaGroup::class, 'agente');
    }
}
