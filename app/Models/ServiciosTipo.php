<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiciosTipo extends Model
{
    protected $fillable = ['name', 'detail', 'price'];

    public static function getAllOrdenPorDescripcion()
    {
        return self::orderBy('name', 'asc')->get();
    }

    public function servicios() {
        return $this->hasMany(Servicio::class, 'tipo_servicio');
    }
}
