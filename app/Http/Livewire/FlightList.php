<?php

namespace App\Http\Livewire;

use App\Models\Flight;
use Livewire\Component;
use Livewire\WithPagination;

class FlightList extends Component
{
    use WithPagination;
    public $filter = null;
    public $search = null;
    public $pagination = null;
    public $sortBy = null;
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
        $query = Flight::query();
        $query = $query->with('carrier');
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
        if ($this->date) {
            $query->where('flight_date','>=',$this->date)->where('flight_date','<=',$this->date);
        }

        if ($this->pagination) {
            $flights = $query->paginate($this->pagination);;
        } else {
            $flights = $query->paginate(10);
        }
        return view('livewire.flight-list')->with(compact('flights'));
    }
}
