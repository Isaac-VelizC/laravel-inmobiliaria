<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propietario extends Model
{
    use HasFactory;
    protected $table = 'propietarios';
    protected $fillable = [
        'name',
        'surnames',
        'ci',
        'phone',
        'address',
        'email',
        'status'
    ];

    public function propiedades()
    {
        return $this->hasMany(Propiedade::class, 'propietario');
    }
}
