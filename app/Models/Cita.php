<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;
    protected $table = 'citas';
    protected $fillable = [
        'date', 'time', 'status', 'detail', 'propiedad', 'usuario'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'usuario');
    }

    public function propiedad() {
        return $this->belongsTo(Propiedade::class, 'propiedad');
    }
    
}
