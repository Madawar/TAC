<?php

namespace App\Exports\Flights;

use App\Exports\Flights\FlightsExport;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class FlightsExporter implements WithMultipleSheets
{
    use Exportable;
    public function __construct($collection)
    {
        $this->collection = $collection;
    }
    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];


        $sheets[] = new FlightsExport($this->collection);
        $sheets[] = new FlightsChargesExport($this->collection);


        return $sheets;
    }
}
