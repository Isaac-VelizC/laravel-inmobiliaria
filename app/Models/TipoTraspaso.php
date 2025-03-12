<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoTraspaso extends Model
{
    public $timestamps = false;
    protected $table = 'tipo_traspasos';
    protected $fillable = ['name', 'detail'];
    
    public static function getTodo()
    {
        return self::orderBy('name', 'asc')->get();
    }
    
    public function propiedades() {
        return $this->hasMany(Propiedade::class, 'tipo_traspaso');
    }
}
