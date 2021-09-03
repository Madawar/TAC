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
    public $flight;

    public function mount($service, $key, $flight)
    {
        $this->service = null;
        $this->serviceList = ServiceList::orderBy('description')->get();

        if ($service->id) {
            $this->service = $service;
            $this->getUom();
        } else {
            $this->service = new FlightService();
            $this->service->service_list_id = '';
            $this->service->qty = null;
            $this->service->start_time = null;
            $this->service->end_time = null;
            $this->service->remarks = null;
            $this->service->flight_id = $flight->id;
        }
        $this->key = $key;
        $this->flight = $flight;
    }

    protected $rules = [
        'service.service_list_id' => '',
        'service.service' => '',
        'service.flight_id' => '',
        'service.qty' => 'required_if:uom,QTY|numeric',
        'service.end_time' => 'required_if:uom,TIME-INTERVAL|date_format:H:i|lte:service.start_time',
        'service.start_time' => 'required_if:uom,TIME-INTERVAL|date_format:H:i',
        'uom' => 'present',


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
        return view('livewire.services.flight-services-item')->with(compact('services'));;
    }

    public function getUom()
    {
        $this->serviceUom = $this->serviceList->where('id', $this->service->service_list_id)->first()->uom;
        $this->service->service = $this->serviceList->where('id', $this->service->service_list_id)->first()->description;
        // $this->service->uom = $this->serviceUom;
    }

    public function updateDate($field,$date)
    {
        if ($this->service->id) {
            $this->service->$field = $date;
            $this->service->save();
        }
    }

    public function save()
    {
        //
        //
        if ($this->service->id) {
            dd($this->service);
            $this->service->save();
        } else {
            $this->service = FlightService::create($this->service->toArray());
        }
        $this->emit('addedService');
    }
}
