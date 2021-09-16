<?php

namespace App\Http\Livewire;

use App\Models\Carrier;
use App\Models\Flight;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Excel;
use App\Exports\Flights\FlightsExporter;
class FlightList extends Component
{
    use WithPagination;
    public $filter = null;
    public $search = null;
    public $pagination = null;
    public $sortBy = null;
    public $carrier = null;
    public $flight_type = null;
    public $date = null;

    protected $rules = [
        'filter' => '',
        'search' => '',
        'pagination' => '',
        'sortBy' => '',
        'date' => '',
    ];

    public function render()
    {
        $flights = $this->query();
        if ($flights) {
            $flights = $flights->paginate($this->pagination);;
        } else {
            $flights = $flights->paginate(10);
        }
        $carriers = Carrier::all()->pluck('carrier_name', 'id');
        return view('livewire.flight-list')->with(compact('flights', 'carriers'));
    }

    public function query()
    {
        $query = Flight::query();
        $query = $query->with('carrier','services');
        if ($this->filter) {
        }
        if ($this->sortBy) {
            $query->orderBy($this->sortBy);
        } else {
            $query->orderBy('created_at', 'DESC');
        }
        if ($this->search) {
            $query->search($this->search, []);
        }
        if ($this->carrier) {
            $query->where('carrier_id', $this->carrier);
        }
        if ($this->flight_type) {
            $query->where('flight_type', $this->flight_type);
        }

        if ($this->date) {
            if (Str::contains($this->date, 'to')) {
                $endDate = Str::after($this->date, 'to');
                $startDate = Str::before($this->date, 'to');
                $query->where('flight_date', '>=', $startDate)->where('flight_date', '<=', $endDate);
            } else {
                $query->where('flight_date', $this->date);
            }
        }


        return $query;
    }
    public function download()
    {
        $records = $this->query()->get();
        $file = Str::random(4).'.xlsx';
        $file = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $file);
        // Remove any runs of periods (thanks falstro!)
        $file = mb_ereg_replace("([\.]{2,})", '', $file);
        return Excel::download(new FlightsExporter($records), $file);
    }

    public function deleteFlight($id)
    {
        Flight::destroy($id);
    }
}
