<?php

namespace App\Http\Livewire\Carrier;

use App\Models\CarrierServices as ModelsCarrierServices;
use App\Models\ServiceList;
use Livewire\Component;
use Illuminate\Support\Facades\Config;

class CarrierServices extends Component
{
    public $service_id = null;
    public $carrier_id = null;
    public $aircraft_type = null;
    public $flight_type = null;
    public $service_type = null;
    public $handling_service = null;
    public $free_hrs = null;
    public $charge = null;
    public $uom = null;
    public $modalShow = null;
    public $delete_item = null;

    protected $rules = [
        'carrier_id' => 'required',
        'service_id' => '',
        'aircraft_type' => 'required',
        'flight_type' => 'required',
        'service_type' => 'required',
        'handling_service' => '',
        'free_hrs' => '',
        'charge' => 'required',
    ];
    public function mount($carrier_id)
    {
        $this->carrier_id = $carrier_id;
    }
    public function render()
    {
        $services =  ServiceList::all()->pluck('description', 'id');
        $aircrafts = Config::get('tac.aircraft_types');
        $aircrafts = array_combine($aircrafts, $aircrafts);
        $service_list = ModelsCarrierServices::with('service', 'carrier')->where('carrier_id', $this->carrier_id)->get();
        //   dd($service_list);
        return view('livewire.carrier.carrier-services')->with(compact('services', 'aircrafts', 'service_list'));
    }

    public function getUom()
    {
        $service = ServiceList::find($this->service_id);
        $this->uom = $service->uom;
    }
    public function save()
    {
        $this->validate();
        if($this->aircraft_type == '*ALL*'){
            $aircrafts = Config::get('tac.aircraft_types');
            array_shift($aircrafts);
            foreach($aircrafts as $aircraft){
                ModelsCarrierServices::create(array(
                    'carrier_id' => $this->carrier_id,
                    'service_id' => $this->service_id,
                    'aircraft_type' => $aircraft,
                    'flight_type' => $this->flight_type,
                    'charge' => $this->charge,
                    'free_hrs' => $this->free_hrs,
                    'service_type' => $this->charge,
                    'service_type' => $this->service_type,
                    'handling_service' => $this->handling_service,
                    'free_hrs' => $this->free_hrs,
                ));
            }
        }else{
            ModelsCarrierServices::create(array(
                'carrier_id' => $this->carrier_id,
                'service_id' => $this->service_id,
                'aircraft_type' => $this->aircraft_type,
                'flight_type' => $this->flight_type,
                'charge' => $this->charge,
                'free_hrs' => $this->free_hrs,
                'service_type' => $this->charge,
                'service_type' => $this->service_type,
                'handling_service' => $this->handling_service,
                'free_hrs' => $this->free_hrs,
            ));
        }

        $this->service_id = null;
        $this->aircraft_type = null;
        $this->flight_type = null;
        $this->charge = null;
        $this->service_type = null;
        $this->handling_service = null;
        $this->free_hrs = null;
    }
    public function deleteQuestion($id)
    {
        $this->modalShow = true;
        $this->delete_item = $id;
    }
    public function delete()
    {
        ModelsCarrierServices::destroy($this->delete_item);
        $this->modalShow = false;
        $this->delete_item = null;
    }
}
