<div class="p-2">
    <div class="p-2 bg-gray-200 m-2 mb-3 border border-gray-300 border-opacity-90 filter md:drop-shadow-sm bg-gray-50 ">
        <div class="flex flex-col md:flex-row p-2 md:space-x-1 md:space-y-0 space-y-1 w-full">

            <div class="flex-auto">
                <x-forms.select label="" :options="[1=>'Incidental Service',0=>'Handling Service']"
                    placeholder="Service Type" wire:model="service_type" name="service_type" />
            </div>



        </div>
        <div class="flex flex-col md:flex-row p-2 md:space-x-1 md:space-y-0 space-y-1 w-full">

            @if ($service_type)
                <div class="flex-auto">
                    <x-forms.select label="" :options="$services" wire:change='getUom' placeholder="Choose Service"
                        wire:model="service_id" name="service_id" />
                </div>
            @else
                <div class="flex-auto">
                    <x-forms.input label="" placeholder="Handling Service Name e.g Freighter Turnaround"
                        wire:model="handling_service" name="" />
                </div>
            @endif

            <div class="flex-auto">
                <x-forms.select label="" :options="$aircrafts" placeholder="Aircraft Type" wire:model="aircraft_type"
                    name="aircraft_type" />
            </div>


        </div>
        @if ($uom == 'TIME-INTERVAL')
            <div class="flex flex-col md:flex-row p-2 md:space-x-1 md:space-y-0 space-y-1 w-full">
                <div class="flex-auto">
                    <x-forms.input label="" placeholder="Free Hours?" wire:model="free_hrs" name="free_hrs" />
                </div>
            </div>
        @endif
        <div class="flex flex-col md:flex-row p-2 md:space-x-1 md:space-y-0 space-y-1 w-full">
            <div class="flex-auto">
                <x-forms.select label="" :options="['F'=>'Freighter','P'=>'Passenger','C'=>'Charter']"
                    placeholder="Flight Type" wire:model="flight_type" name="flight_type" />
            </div>
            <div class="flex-auto">
                <x-forms.input label="" placeholder="Flight Charge" wire:model="charge" name="charge" />
            </div>
        </div>
        <button class=" btn btn-square btn-block md:btn-circle" wire:click='save' wire:target=" save"
            wire:loading.class="loading">
            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-6 h-6 stroke-current" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" wire:loading.remove wire:target=" save">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
            </svg>
            Save
        </button>
    </div>
    <table class="table table-compact table-zebra w-full">
        <thead>

            <tr>
                <th>Carrier</th>
                <th>Service</th>
                <th>Aircraft Type</th>
                <th>Flight Type</th>
                <th>Charge</th>
                <th>Free Hrs</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($service_list as $service_item)
                <tr>
                    <td>{{ $service_item->carrier->carrier_name }}</td>
                    @if ($service_item->service_type == 1)
                        <td>{{ $service_item->service->description }}</td>
                    @else
                        <td>{{ $service_item->handling_service }}</td>
                    @endif
                    <td>{{ $service_item->aircraft_type }}</td>
                    <td>{{ $service_item->flight_type }}</td>
                    <td>{{ $service_item->charge }}</td>
                    <td>{{ $service_item->free_hrs }}</td>
                    <td>
                        <button class="btn  btn-square btn-xs btn-error"
                        wire:click="deleteQuestion({{ $service_item->id }})" wire:target="deleteQuestion"
                        wire:loading.class="loading">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" wire:loading.remove
                            wire:target="deleteQuestion">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </button>

                    </td>

                </tr>

            @endforeach

        </tbody>
        <tfoot>
            <tr>
                <th>Carrier</th>
                <th>Service</th>
                <th>Aircraft Type</th>
                <th>Flight Type</th>
                <th>Charge</th>
                <th>Free Hrs</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>

    @if($modalShow )
    <div class="modal modal-open">
    @else
    <div class="modal ">
    @endif

        <div class="modal-box">
          <p> Are you Sure you want to delete this Item</p>
          <div class="modal-action">
            <label for="my-modal-2" wire:click='delete' class="btn btn-error">Yes</label>
            <label for="my-modal-2" class="btn">Close</label>
          </div>
        </div>
      </div>

</div>
