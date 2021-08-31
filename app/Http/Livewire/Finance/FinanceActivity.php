<?php

namespace App\Http\Livewire\Finance;

use App\Models\Flight;
use Livewire\Component;
use Image;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use PDF;
use Illuminate\Support\Facades\Storage;

class FinanceActivity extends Component
{
    public $flight = null;
    public $flight_id;
    public $preview = 0;
    public $signature_name;
    public $image = null;
    protected $rules = [
        'flight_id' => '',
        'signature_name' => ''
    ];

    protected $listeners = ['signature_saved' => 'signatureSaved', 'addedService' => 'updateService'];
    public function render()
    {
        // dd($this->flight);
        $flights = Flight::limit(10)->orderBy('created_at', 'DESC')->get()->pluck('flight_number', 'id');

        $flights = collect(['' => 'Choose something…'] + $flights->all());

        return view('livewire.finance.finance-activity')->with(compact('flights'));
    }

    public function resetFlight()
    {
        $this->flight = null;
        $this->flight_id = null;
        // dd('here0');
    }
    public function updateService()
    {

    }
    public function loadFlight()
    {
        $this->flight = null;
        $this->flight = Flight::with('carrier', 'services')->find($this->flight_id);
        if($this->flight->signature != null){
            $this->image = Storage::url('signatures/' . $this->flight->signature);
        }

        $this->emit('rerender', $this->flight);
    }





    public function signatureSaved($data)
    {
        $data_uri = $data;
        $encoded_image = explode(",", $data_uri)[1];
        $decoded_image = base64_decode($encoded_image);
        $filename = Str::random(40) . '.png';
        $pdf_name = $this->flight->pdf;
        Image::make($decoded_image)->save(storage_path('app/public/signatures/' . $filename));
        $this->flight->update(array('signature' => $filename, 'signature_name' => $this->signature_name));
        $flight = Flight::with('carrier', 'services')->find($this->flight->id);
        return redirect()->route('flight.show', ['flight' => $flight->id]);
    }
}
