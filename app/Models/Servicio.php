<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $table = 'servicios';

    protected $fillable = [
        'detail',
        'worker',
        'description',
        'date_start',
        'date_end',
        'price',
        'status',
        'id_solicitud',
        'id_user',
        'tipo_servicio',
        'id_propiedad'
    ];

    public static $rules = [
        'tipo_servicio' => 'required|integer|exists:servicios_tipos,id',
        'detail' => 'required|array',
        'worker' => 'required|string|max:100',
        'description' => 'nullable|string',
        'date_start' => 'required|date|after_or_equal:today',
        'date_end' => 'required|date|after:date_start',
        'id_user' => 'required|integer|exists:users,id',
        "id_propiedad" => 'required|integer|exists:propiedades,id',
        "price" => "required|numeric|min:1",
        "status" => "required|string|max:100"
    ];

    public static $rulesupdate = [
        'tipo_servicio' => 'required|integer|exists:servicios_tipos,id',
        'detail' => 'required|array',
        'worker' => 'required|string|max:100',
        'description' => 'nullable|string',
        'date_start' => 'required|date|after_or_equal:today',
        'date_end' => 'required|date|after:date_start',
        'id_user' => 'required|integer|exists:users,id',
        "price" => "required|numeric|min:1",
        "status" => "required|string|max:100"
    ];

    public function usuario() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function detalle() {
        return $this->belongsTo(ServiciosDestalle::class, 'id_servicio');
    }

    public function tipoServicio() {
        return $this->belongsTo(ServiciosTipo::class, 'tipo_servicio');
    }

    public function imagenes() {
        return $this->hasMany(ImagenServicio::class, 'id_servicio');
    }

    public function propiedad() {
        return $this->belongsTo(Propiedade::class, 'id_propiedad');
    }
}
