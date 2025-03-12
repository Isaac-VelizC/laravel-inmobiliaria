<?php

namespace App\Helpers;

use App\Models\CitaGroup;
use DateTime;

class Helper
{
    public static function generateTimes($anio, $mes, $dia)
    {
        $times = [];
        $startTimes = ['08:00', '14:00'];
        $endTimes = ['11:30', '18:00'];

        // Formatear la fecha correctamente
        $fecha_original = sprintf('%04d-%02d-%02d', $anio, $mes, $dia);
        $date = DateTime::createFromFormat('Y-m-d', $fecha_original);
        if (!$date) {
            return []; // Si la fecha es inválida, retornar vacío
        }

        $sFecha = $date->format('Y-m-d');

        foreach ($startTimes as $index => $startTime) {
            $start = new DateTime($startTime);
            $end = new DateTime($endTimes[$index]);

            while ($start <= $end) {
                $sHora = $start->format('H:i');

                // Validar si ya hay una cita
                $control = CitaGroup::controlHora($sFecha, $sHora);

                // Verificar si es una hora pasada
                $horaActual = new DateTime();
                $horaCita = new DateTime($sHora);
                $control2 = true;

                if ($anio == date('Y') && $mes == date('m') && $dia == date('d')) {
                    if ($horaCita <= $horaActual) {
                        $control2 = false;
                    }
                }

                // Solo agregar si no hay cita y la hora es válida
                if (empty($control) && $control2) {
                    $times[] = $sHora;
                }

                // Avanzar 45 minutos
                $start->modify('+45 minutes');
            }
        }

        return $times;
    }
}
