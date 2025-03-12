<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propiedade extends Model
{
    use HasFactory;

    protected $table = 'propiedades';
    protected $fillable = [
        'name',
        'address',
        'city',
        'country',
        'zip_code',
        'tipo_propiedad',
        'tipo_traspaso',
        'num_rooms',
        'num_bedrooms',
        'num_bathrooms',
        'num_hall',
        'num_kitchens',
        'num_garages',
        'constructed_area',
        'ground_surface',
        'description',
        'price',
        'coin',
        'bank_financing',
        'date',
        'end_date',
        'latitude',
        'longitude',
        'status',
        'state_advertising',
        'propietario',
        'id_user'
    ];

    public function solicitudes() {
        return $this->hasMany(SolicitudServicio::class, 'id_propiedad');
    }
    
    public function tipoPropiedad() {
        return $this->belongsTo(TipoPropiedad::class, 'tipo_propiedad');
    }
    
    public function tipoTraspaso() {
        return $this->belongsTo(TipoTraspaso::class, 'tipo_traspaso');
    }

    public function propiet() {
        return $this->belongsTo(Propietario::class, 'propietario');
    }

    public function user() {
        return $this->belongsTo(Agente::class, 'id_user');
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();
        // Customize array as needed
        return $array;
    }
    public static function publicitadas()
    {
        return self::where('state_advertising', 'publicitado')->take(4)->get();
    }
    
    public function imagenes() {
        return $this->hasMany(Image::class, 'propiedad');
    }

    public function visitas() {
        return $this->belongsTo(Visita::class, 'propiedad_id');
    }

    public function hotspots() {
        return $this->hasMany(Hotspot::class, 'propiedad_id');
    }
    
}
