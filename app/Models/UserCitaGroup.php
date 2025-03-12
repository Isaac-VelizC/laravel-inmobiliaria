<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCitaGroup extends Model
{
    use HasFactory;
    protected $table = 'user_cita_groups';
    protected $fillable = [
        'group', 'propiedad', 'usuario'
    ];

    public function usuario() {
        return $this->belongsTo(User::class, 'usuario');
    }

    public function propiedad() {
        return $this->belongsTo(Propiedade::class, 'propiedad');
    }

    public function group() {
        return $this->belongsTo(CitaGroup::class, 'group');
    }
}
