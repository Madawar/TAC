<?php

namespace App\Http\Livewire\Services;

use App\Models\FlightService;
use Livewire\Component;
use App\Models\ServiceList;

class FlightServicesItem extends Component
{
    public $serviceList = [];
    public $serviceChosen;
    public $serviceUom;
    public $service;
    public $uom;
    public $key;

    public function mount($service,$key)
    {
        $this->service = new FlightService();
        $this->key = $key;
    }

    protected $rules = [
        'service.service_list_id' => '',
        'service.qty' => 'required_if:uom,QTY|numeric',
        'service.end_time' => 'required_if:uom,TIME-INTERVAL|date_format:H:i|lte:service.start_time',
        'service.start_time' => 'required_if:uom,TIME-INTERVAL|date_format:H:i',
        'uom' => 'present',
        'service.uom' => 'present'

    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function removeItem($key)
    {
        $this->emit('remove_item', $key);
    }

    public function render()
    {
        $services = ServiceList::orderBy('description')->get();
        $this->serviceList = $services;
        return view('livewire.services.flight-services-item')->with(compact('services'));;
    }

    public function getUom()
    {
        $this->serviceUom =   $this->serviceList->where('id', $this->service->service_list_id)->first()->uom;
    }
}
