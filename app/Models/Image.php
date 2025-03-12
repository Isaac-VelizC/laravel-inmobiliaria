<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table = 'images';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'type', 'path', 'propiedad'
    ];

    public function propiedad() {
        return $this->belongsTo(Propiedade::class, 'propiedad', 'id');
    }    

    public function hotspots() {
        return $this->hasMany(Hotspot::class, 'sceneId');
    }
}
