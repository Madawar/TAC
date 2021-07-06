<?php

namespace App\Http\Livewire\Services;

use App\Models\FlightService;
use App\Models\ServiceList;
use Livewire\Component;

class FlightServices extends Component
{
    public $serviceItems = null;

    protected $listeners = ['remove_item' => 'removeItem'];

    public function removeItem($key)
    {
        unset($this->serviceItems[$key]);
    }
    public function mount()
    {
        $this->addService();
    }

    public function render()
    {


        return view('livewire.services.flight-services');
    }

    public function addService()
    {
        $item = new FlightService;

        $item->service_list_id = null;
        $item->qty = null;
        $item->start_time = null;
        $item->end_time = null;
        $item->remarks = null;

        $this->serviceItems[] = $item->toArray();
    }
}
