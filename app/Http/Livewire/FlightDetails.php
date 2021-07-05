<?php

namespace App\Http\Livewire;

use App\Models\Flight;
use Livewire\Component;

class FlightDetails extends Component
{
    public $flight = null;

    protected $listeners = ['flightpicked' => 'incrementPostCount'];

    public function incrementPostCount($flight)
    {
        $this->flight =  Flight::find($flight);
    }

    public function render()
    {
        $flight = $this->flight;
        return view('livewire.flight-details')->with(compact('flight'));
    }
}
