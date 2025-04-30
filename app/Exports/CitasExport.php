<?php

namespace App\Exports;

use App\Models\CitaGroup;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CitasExport implements FromCollection, WithHeadings
{
    protected $filters;

    public function __construct($filters) {
        $this->filters = $filters;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = CitaGroup::with(['hacienda', 'guia.usuario']);

        if (!empty($this->filters['report_month'])) {
            $month = $this->filters['report_month'];
            $query->whereYear('date', Carbon::parse($month)->year)
                  ->whereMonth('date', Carbon::parse($month)->month);
        }
        if (!empty($this->filters['date_from'])) {
            $query->where('date', '>=', $this->filters['date_from']);
        }
        if (!empty($this->filters['date_to'])) {
            $query->where('date', '<=', $this->filters['date_to']);
        }
        if (!empty($this->filters['propiedad'])) {
            $query->where('propiedad', $this->filters['propiedad']);
        }
        if (!empty($this->filters['agente_report'])) {
            $query->where('agente', $this->filters['agente_report']);
        }
        if (!empty($this->filters['status'])) {
            $query->where('status', $this->filters['status']);
        }

        $citas = $query->get();

        // Formatea los datos para el Excel
        return $citas->map(function ($cita) {
            return [
                'Nombre'      => $cita->name,
                'Fecha'       => $cita->date,
                'Hora'        => $cita->time,
                'Propiedad'   => $cita->hacienda->name ?? '',
                'Agente'      => $cita->guia->usuario->name ?? '',
                'Visitantes'  => $cita->cantidad,
                'Estado'      => ucfirst($cita->status),
                'Detalle'     => $cita->detail,
            ];
        });
    }

    public function headings(): array
    {
        return ['Nombre', 'Fecha', 'Hora', 'Propiedad', 'Agente', 'Visitantes', 'Estado', 'Detalle'];
    }
}
