<?php

namespace App\Http\Livewire\Carrier;

use Livewire\Component;

class CarrierServiceItem extends Component
{
    public $item = null;
    public function mount($item)
    {
        $this->item = $item;
    }

    public function render()
    {
        return view('livewire.carrier.carrier-service-item');
    }
}
