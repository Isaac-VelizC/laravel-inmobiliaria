<?php

namespace Database\Seeders;

use App\Models\Encuesta;
use App\Models\Pregunta;
use App\Models\Respuesta;
use App\Models\RespuestasSeleccionada;
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
        $preguntas = [
            '¿Qué tan satisfecho está con el estado de conservación del inmueble?',
            '¿Considera que la información proporcionada por el agente fue clara y útil?',
            '¿Cómo calificaría la atención recibida por parte del agente inmobiliario?',
            '¿Qué tan probable es que nos recomiende a amigos o familiares?',
        ];

        $respuestas = [
            'Muy malo',
            'Malo',
            'Regular',
            'Bueno',
            'Excelente',
        ];

        // Crear las respuestas asociadas a la pregunta
        foreach ($respuestas as $respuesta) {
            Respuesta::create([
                'question' => $respuesta,
            ]);
        }

        $respuestasList = Respuesta::all();

        foreach ($preguntas as $pregunta) {
            $preguntaCreada = Pregunta::create([
                'question' => $pregunta,
                'encuesta_id' => $encuesta->id,
            ]);
            foreach ($respuestasList as $value) {
                RespuestasSeleccionada::create([
                    'pregunta_id' => $preguntaCreada->id,
                    'respuesta_id' => $value->id
                ]);
            }
        }

        /*ServiciosTipo::create([
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
        ]);*/
    }
}
