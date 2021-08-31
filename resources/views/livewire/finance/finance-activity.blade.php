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

        <div class="___class_+?25___">
            <div class="flex justify-center ">
                <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-red-500 mt-2" wire:loading></div>

            </div>

        </div>
    </div>
    <div class="card text-center shadow-sm">

        <h2 class="card-title">Flight Charge Details</h2>
        @if ($flight != null)
            @livewire('services.flight-services',['flight'=>$flight])

            <div class="overflow-x-auto">
                <table class="table w-full table-zebra">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Service</th>
                            <th>Quantity</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($flight->services as $key => $service)
                            <tr>
                                <th>{{ $loop->index + 1 }}</th>
                                <th class="text-red-900">{{ $service->service }}</th>
                                <td>{{ $service->qty }}</td>
                                <td>{{ $service->start_time }}</td>
                                <td>{{ $service->end_time }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>




        @else
            <div class="text-center">Please Choose A Flight</div>
        @endif

    </div>



    <div class="card text-center shadow-2xl mt-10">
        <div class="card-body">
            <h2 class="card-title">Airline Representative Signature</h2>

            <div class="mb-4">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text block text-xs font-semibold text-gray-600 uppercase">Airline
                            Representative Name : </span>
                    </label>
                    <input type="text" wire:model="signature_name" class="input input-bordered">
                </div>

            </div>
            @if ($image)
                <img src="{{ $image }}" class="object-contain w-32" />
            @endif
            <canvas id="canvas" class="canvas bg-yellow-400 shadow-sm w-full">

            </canvas>
            @if ($flight != null)
                <div class="flex flex-row pt-3">

                    <div class="flex-auto">
                        <button wire:click="$emit('clear')" class="btn btn-primary"> Clear </button>
                    </div>
                    <div class="flex-auto">
                        <button wire:click="$emit('save')" class="btn btn-primary"> Save </button>
                    </div>

                </div>
            @endif
        </div>
    </div>


</div>

<script>
    document.addEventListener('livewire:load', function() {
        var canvas = document.querySelector("canvas");

        var signaturePad = new SignaturePad(canvas);

        @this.on('clear', () => {
            signaturePad.clear();
        });
        @this.on('save', () => {

            const data = signaturePad.toDataURL();
            Livewire.emit('signature_saved', data)
        });

    })
</script>
