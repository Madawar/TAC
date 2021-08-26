<div>
    <div class="border border-gray-300 m-1 shadow-inner mb-2">
        <div
            class="border-b border-gray-300 shadow-xl p-2 leading-loose text-center uppercase font-semibold  bg-gray-500 text-white">
            Please Choose a Flight



        </div>
        <div class="divide-y divide-gray-300 p-2">
            @if ($flight == null)
                <x-forms.select label="Choose a flight to work on" placeholder="Choose a flight" name="flight_id"
                    :options="$flights" wire:change="loadFlight" wire:model="flight_id" />
            @else
                <div class="grid grid-cols-1 md:grid-cols-3">
                    <div class="flex-none">
                        <div class="font-bold text-md inline-block leading-loose">Flight Number : </div>
                        <div class="font-bold text-md text-red-800 inline-block leading-relaxed">
                            {{ $flight->carrier->carrier_name }} {{ $flight->flight_no }} </div>
                    </div>
                    <div class="flex-none">
                        <div class="font-bold text-md inline-block leading-loose">Routing : </div>
                        <div class="font-bold text-md text-red-800 inline-block leading-relaxed">
                            {{ $flight->origin }} - {{ $flight->destination }} </div>
                    </div>
                    <div class="flex-none">
                        <div class="font-bold text-md inline-block leading-loose">Turnaround Type : </div>
                        <div class="font-bold text-md text-red-800 inline-block leading-relaxed">
                            {{ $flight->turnaround_type }} </div>
                    </div>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 ">
                    <div class="flex-auto">
                        <div class="font-bold text-md inline-block leading-loose">Flight Date : </div>
                        <div class="font-bold text-md text-red-800 inline-block leading-relaxed">
                            {{ $flight->flight_date }} </div>
                    </div>
                    <div class="flex-auto">
                        <div class="font-bold text-md inline-block leading-loose">Flight Serial: </div>
                        <div class="font-bold text-md text-red-800 inline-block leading-relaxed">
                            {{ $flight->serial }} </div>
                    </div>

                    <div class="flex-auto">
                        <div class="font-bold text-md inline-block leading-loose">Flight Type : </div>
                        <div class="font-bold text-md text-red-800 inline-block leading-relaxed">
                            @if ($flight->flight_type == 'F')
                                Freighter
                            @elseif($flight->flight_type == 'P')
                                Passenger
                            @endif

                        </div>
                    </div>

                </div>


                <div class="flex flex-col justify-center items-center p-4">
                    <button wire:click="resetFlight" class="btn btn-primary "> Choose another Flight</button>
                </div>

            @endif
        </div>

        <div class="">
            <div class="flex justify-center ">
                <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-red-500 mt-2" wire:loading></div>

            </div>

        </div>
    </div>
    {{ $flight }}
    @if ($flight != null)
        @livewire('services.flight-services',['flight'=>$flight])
    @else
        <div class="text-center">Please Choose A Flight</div>
    @endif


</div>
