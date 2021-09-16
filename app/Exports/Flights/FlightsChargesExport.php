<?php

namespace App\Exports\Flights;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class FlightsChargesExport  implements FromView,WithStyles, WithTitle,ShouldAutoSize
{
    public $collection;
    public function __construct($collection)
    {
        $this->collection = $collection;
    }

    public function view(): View
    {
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
