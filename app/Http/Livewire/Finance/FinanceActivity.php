<?php

namespace App\Http\Livewire\Finance;

use App\Models\Flight;
use Livewire\Component;

class FinanceActivity extends Component
{
    public $flight = null;
    public $flight_id;
    protected $rules = [
        'flight_id' => '',


    ];
    public function render()
    {
        $flights = Flight::limit(10)->get()->pluck('flight_number','id');

        return view('livewire.finance.finance-activity') ->with(compact('flights'));
    }

    public function loadFlight(){
        $this->flight = null;
        $this->flight = Flight::with('carrier','services')->find($this->flight_id);
        $this->emit('rerender',$this->flight);
    }
}
