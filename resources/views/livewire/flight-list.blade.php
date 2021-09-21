<div>
    <div class="bg-gray-50 border-gray-300 shadow-sm mb-1 border overflow-x-auto">
        <div class="flex flex-col md:flex-row p-2 md:space-x-1 md:space-y-0 space-y-1 w-full">
            <div class="flex-auto">
                <x-forms.input label="" placeholder="Search Anything" wire:model="search" name="search" />

            </div>
            <div class="flex-auto">
                <div class="form-control">
                    <input type="text" wire:ignore placeholder="Date" wire:model="date"
                        class="input input-bordered date">
                </div>

            </div>
            <div class="flex-auto">
                <x-forms.select label="" :options="$carriers" placeholder="Filter By Carriers" wire:model="carrier"
                    name="carrier" />

            </div>
            <div class="flex-auto">
                <x-forms.select label="" :options="['F'=>'Freighter','P'=>'Passenger']"
                    placeholder="Filter By Flight Type" wire:model="flight_type" name="flight_type" />

            </div>
            <div class="flex-auto">


                    <button class=" btn btn-square btn-block md:btn-circle" wire:click='download'>
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-6 h-6 stroke-current" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>

                    </button>

            </div>


        </div>
    </div>

    <div class="overflow-x-auto">


        <table class="table table-compact table-zebra w-full">
            <thead>

                <tr>
                    <th></th>
                    <th>Carrier</th>
                    <th>Flight Date</th>
                    <th>Turnaround Type</th>
                    <th>Aircraft Type</th>
                    <th>Origin</th>
                    <th>Destination</th>
                    <th>Done By</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>

                @foreach ($flights as $flight)
                    @if ($flight->trashed())
                        <tr class=" text-red-500">
                        @else
                        <tr>
                    @endif
                    <th>
                        <div class="flex flex-row ">
                            <label class="pr-1">
                                <input type="radio" class="radio" name="opt"
                                    wire:click="$emit('flightpicked',{{ $flight->id }})">
                                <span class="radio-mark"></span>
                            </label>
                            <div class="mt-0">
                                <a href="{{ route('finance.edit', ['finance' => $flight->id]) }}">
                                    {{ $flight->serial }}
                                </a>
                            </div>

                        </div>

                    </th>
                    <td>
                        <div class="flex flex-row">
                            <div class="pt-1 rounded-btn w-6 h-6">
                                @if ($flight->carrier->logo)
                                    <img src="{{ asset('storage/images/thumbnail/' . $flight->carrier->logo) }}">
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                                    </svg>
                                @endif
                            </div>
                            <div class="pl-1 pt-1">
                                {{ $flight->carrier->carrier_code }} {{ $flight->flight_no }}
                            </div>
                        </div>
                    </td>

                    <td>
                        {{ Carbon\Carbon::parse($flight->flight_date)->format('j-M-y') }}
                    </td>
                    <td>{{ $flight->turnaround_type }}</td>
                    <td>{{ $flight->aircraft_type }}</td>
                    <td>{{ $flight->origin }}</td>
                    <td>{{ $flight->destination }} </td>
                    <td>
                        @if (isset($flight->owner->name))
                            {{ $flight->owner->name }}
                        @else
                            <b>-</b>
                        @endif

                    </td>


                    <td>

                        @if (isset($flight->owner->id))
                            @if ($flight->owner->id == Auth::user()->id and $flight->signature != null)
                                <!--
                                    <button class="btn  btn-square btn-xs btn-error"
                                        wire:click="deleteFlight({{ $flight->id }})" wire:target="deleteFlight"
                                        wire:loading.class="loading">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" wire:loading.remove
                                            wire:target="deleteFlight">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                -->
                            @endif
                        @endif

                        @if ($flight->signature == null)
                            <a href="{{ route('flight.edit', ['flight' => $flight->id]) }}"
                                class="btn btn-warning btn-square btn-xs">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>

                            </a>
                        @endif
                        <a href="{{ route('flight.show', ['flight' => $flight->id]) }}"
                            class="btn  btn-square btn-xs btn-success">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>

                        </a>


                    </td>
                    </tr>
                @endforeach

            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Carrier</th>

                    <th>Flight Date</th>
                    <th>Turnaround Type</th>
                    <th>Aircraft Type</th>

                    <th>Origin</th>
                    <th>Destination</th>
                    <th>Done By</th>

                    <th>Actions</th>

                </tr>
            </tfoot>
        </table>
        <div class="p-2">
            {{ $flights->appends(request()->query())->links() }}
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            flatpickr(".date", {
                'mode': 'range'
            });



        })
    </script>

</div>
