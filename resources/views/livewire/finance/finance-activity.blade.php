<div>
    <div class="border border-gray-300 m-1 shadow-inner mb-2">
        <div
            class="border-b border-gray-300 shadow-xl p-2 leading-loose text-center uppercase font-semibold  bg-gray-500 text-white">
            Please Choose a Flight



        </div>
        <div class="divide-y divide-gray-300 p-2">
            <x-forms.select label="Choose a flight to work on" placeholder="Choose a flight" name="flight_id"
                :options="$flights" wire:change="loadFlight" wire:model="flight_id" />
        </div>

        <div class="">
            <div class="flex justify-center ">
                <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-red-500 mt-2" wire:loading></div>

            </div>

        </div>
    </div>

    @if ($flight != null)

        @livewire('services.flight-services',['flight'=>$flight])
    @endif


</div>
