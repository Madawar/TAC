<?php

namespace App\Http\Livewire\Services;

use App\Models\Flight;
use App\Models\FlightService;
use App\Models\ServiceList;
use Livewire\Component;

class FlightServices extends Component
{
    public $serviceItems = null;
    public $flight = null;
    public $carrier = null;

    protected $listeners = ['remove_item' => 'removeItem', 'rerender' => 'reloadFlight'];

    public function removeItem($key)
    {
        unset($this->serviceItems[$key]);
    }
    public function reloadFlight($flight)
    {

        if ($flight['id'] != $this->flight->id) {

            $flight =  Flight::with('carrier', 'services')->find($flight['id']);
            $this->mount($flight);
        }
    }
    public function mount($flight)
    {
        $this->serviceItems = null;

        $this->flight = null;
        $this->carrier = null;
        $this->flight = $flight;
        $this->carrier = $flight->carrier->carrier_code;
        if ($this->flight->services()->exists()) {
            $this->serviceItems = $this->flight->services;
        } else {
            // $this->addService();
        }
    }

    public function render()
    {
        return view('livewire.services.flight-services');
    }

    public function addService()
    {
        $item =  FlightService::make()->setConnection(env('DB_CONNECTION'));
        $item->service_list_id = null;
        $item->qty = null;
        $item->start_time = null;
        $item->end_time = null;
        $item->remarks = null;

        $this->serviceItems[] = $item;
    }
}
