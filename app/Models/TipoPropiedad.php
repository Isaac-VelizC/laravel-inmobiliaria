<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoPropiedad extends Model
{
    public $timestamps = false;
    protected $table = 'tipo_propiedad';
    protected $fillable = ['name', 'detail'];

    public function propiedades() {
        return $this->hasMany(Propiedade::class, 'tipo_propiedad');
    }
}
