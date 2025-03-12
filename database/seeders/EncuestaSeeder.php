<?php

namespace Database\Seeders;

use App\Models\Encuesta;
use App\Models\Pregunta;
use App\Models\ServiciosTipo;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EncuestaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear la encuesta
        $encuesta = Encuesta::create([
            'name' => 'Encuesta de Satisfacción por la Visita al Inmueble',
            'enabled_until' => Carbon::now()->addMonths(1),
        ]);

        // Crear las preguntas para la encuesta
        Pregunta::create([
            'question' => 'Muy malo',
            'encuesta_id' => $encuesta->id,
        ]);

        Pregunta::create([
            'question' => 'Malo',
            'encuesta_id' => $encuesta->id,
        ]);

        Pregunta::create([
            'question' => 'Regular',
            'encuesta_id' => $encuesta->id,
        ]);

        Pregunta::create([
            'question' => 'Bueno',
            'encuesta_id' => $encuesta->id,
        ]);

        Pregunta::create([
            'question' => 'Excelente',
            'encuesta_id' => $encuesta->id,
        ]);

        ServiciosTipo::create([
            'name' => 'Mantenimiento',
            'detail' => 'Servicios de mantenimiento preventivo y correctivo para asegurar el buen estado de las instalaciones.'
        ]);
        
        ServiciosTipo::create([
            'name' => 'Decoración',
            'detail' => 'Servicios de decoración de interiores y exteriores, incluyendo diseño y selección de elementos decorativos.'
        ]);
        
        ServiciosTipo::create([
            'name' => 'Ampliación de ambientes',
            'detail' => 'Servicios para la ampliación de espacios existentes, adaptando la estructura para mejorar la funcionalidad.'
        ]);
        
        ServiciosTipo::create([
            'name' => 'Demolición',
            'detail' => 'Servicios de demolición controlada de estructuras, garantizando la seguridad y cumplimiento de normativas.'
        ]);
        
    }
}
