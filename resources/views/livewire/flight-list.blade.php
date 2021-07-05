<div>
    <div class="bg-gray-50 shadow-sm mb-1 border ">
        <div class="flex flex-col md:flex-row p-2 md:space-x-3 w-full">
            <div class="flex-grow">
                <div class="relative flex w-full flex-wrap items-stretch my-1">

                    <input type="text" placeholder="Search Anything ..." wire:model="search"
                        class="px-3 py-3 placeholder-gray-400 text-gray-600 relative bg-white bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:ring w-full pl-10" />
                </div>
            </div>
            <div class="flex-auto">
                <div class="relative flex w-full flex-wrap items-stretch my-1">

                    <input type="text" placeholder="Search By Date" wire:model="date"
                        class="date px-3 py-3 placeholder-gray-400 text-gray-600 relative bg-white bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:ring w-full pl-10" />
                </div>

            </div>
            <div class="flex-auto justify-items-end">

                <div class=" flex justify-center items-center pt-1" wire:loading>
                    <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-red-500"></div>
                </div>


            </div>

        </div>
    </div>

    <div class="overflow-x-auto">

        <table class="table table-compact w-full">
            <thead>

                <tr>
                    <th></th>
                    <th>Carrier</th>

                    <th>Flight Date</th>
                    <th>Turnaround Type</th>
                    <th>Aircraft Type</th>

                    <th>Origin</th>
                    <th>Destination</th>

                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>

                @foreach ($flights as $flight)
                    <tr>
                        <th>
                            <div class="flex flex-row ">
                                <label class="pr-1">
                                    <input type="radio" class="radio" name="opt"
                                        wire:click="$emit('flightpicked',{{ $flight->id }})">
                                    <span class="radio-mark"></span>
                                </label>
                                <div class="mt-0">
                                    {{ $flight->serial }}
                                </div>

                            </div>

                        </th>
                        <td>
                            <div class="flex flex-row">
                                <div class="pt-1 rounded-btn w-6 h-6">
                                    <img src="{{ asset('storage/images/thumbnail/' . $flight->carrier->logo) }}">
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
                        <td>{{ $flight->destination }}</td>


                        <td>


                            <button class="btn btn-outline btn-square btn-xs"
                                v-on:click="openModal({{ $flight->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>

                            <a href="{{ route('flight.edit', ['flight' => $flight->id]) }}"
                                class="btn btn-outline btn-square btn-xs">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
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

                    <th>Actions</th>

                </tr>
            </tfoot>
        </table>

    </div>
    {{ $flights->appends(request()->query())->links() }}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            flatpickr(".date");



        })
    </script>

</div>
