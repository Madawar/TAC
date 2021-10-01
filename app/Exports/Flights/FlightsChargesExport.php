<?php

namespace App\Exports\Flights;

use App\Models\CarrierServices;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FlightsChargesExport  implements FromView, WithStyles, WithTitle, ShouldAutoSize
{
    public $collection;
    public function __construct($collection)
    {
        $this->collection = $collection;
    }

    public function view(): View
    {
        $this->collection->map(function ($item, $key) {
            $turnaround = CarrierServices::where('handling_service', $item->turnaround_type)
                ->where('flight_type', $item->flight_type)
                ->where('aircraft_type', $item->aircraft_type)
                ->where('carrier_id', $item->carrier_id)->first();
            if (isset($turnaround)) {
                $item->turnaround_charge = $turnaround->charge;
            }
            foreach ($item->services as $service) {
                $service_charge = CarrierServices::where('service_id', $service->service_list_id)
                    ->where('flight_type', $item->flight_type)
                    ->where('aircraft_type', $item->aircraft_type)
                    ->where('carrier_id', $item->carrier_id)->first();
                if (isset($service_charge)) {
                    $service->service_charge = $service_charge->charge;
                    if ($service->start_time != null and $service->end_time) {
                        $start_time =  Carbon::parse($service->start_time);
                        $end_time = Carbon::parse($service->end_time);
                        $total_duration = $end_time->floatDiffInRealHours($start_time);
                        $service->qty = ceil($total_duration) - $service_charge->free_hrs;
                    }
                }

            }

            return $item;
        });
        return view('reports.flight_charges_report', [
            'flights' => $this->collection
        ]);
    }
    /**
     * @return string
     */
    public function title(): string
    {
        return 'Flights Charges';
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}
