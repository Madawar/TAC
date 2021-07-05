@extends('layouts.master_layout')
<?php
use Illuminate\Support\Str;
?>
@section('main-heading')
    <h1
        class="p-4  text-center text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">
        View flights
    </h1>
@endsection
@section('secondary-heading')
    <h1
        class="p-4 text-center text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">
        Over View </h1>
@endsection

@section('content')
    <div class="p-2" id="appx">

        <form method="GET" action="{{ route('flight.index') }}">
            <div class="flex flex-col md:flex-row space-y-2 md:space-y-0  md:space-x-1 bg-gray-500 border p-2 ">
                <div class="flex-auto">
                    <input type="text" placeholder="Date" name="date"
                        class="date input input-bordered w-full @error('date') input-error  @enderror">
                </div>
                <div class="flex-auto ">
                    <x-forms.input label="" placeholder="Search" name="search" />
                </div>
                <div class="flex-auto ">
                    <x-forms.select label="" placeholder="Staff" name="staff_id" :options="$staff" />
                </div>

                <div class="flex-auto ">

                    <button class="btn btn-square" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                    @if (request()->query())
                        <a href="{{ route('flight.index') }}" class="btn btn-success btn-square">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                        </a>
                    @endif
                </div>

            </div>
        </form>
       <div class="overflow-x-auto">
    <table class="table table-compact w-full">
        <thead>

            <tr>
                <th></th>
                      <th>Carrier Id</th>
      <th>Serial</th>
      <th>Remarks</th>
      <th>Delay Code</th>
      <th>Std</th>
      <th>Sta</th>
      <th>Departure</th>
      <th>Arrival</th>
      <th>Flight Date</th>
      <th>Turnaround Type</th>
      <th>Aircraft Registration</th>
      <th>Aircraft Type</th>
      <th>Flight Type</th>
      <th>Destination</th>
      <th>Origin</th>
      <th>Flight No</th>



            </tr>
        </thead>
        <tbody>

            @foreach ($flights as $flight)
                <tr>
                    <th>{{ $loop->index + 1 }}</th>
                           <td>{{ $flight->carrier_id }}</td>
       <td>{{ $flight->serial }}</td>
       <td>{{ $flight->remarks }}</td>
       <td>{{ $flight->delay_code }}</td>
       <td>{{ $flight->STD }}</td>
       <td>{{ $flight->STA }}</td>
       <td>{{ $flight->departure }}</td>
       <td>{{ $flight->arrival }}</td>
       <td>{{ $flight->flight_date }}</td>
       <td>{{ $flight->turnaround_type }}</td>
       <td>{{ $flight->aircraft_registration }}</td>
       <td>{{ $flight->aircraft_type }}</td>
       <td>{{ $flight->flight_type }}</td>
       <td>{{ $flight->destination }}</td>
       <td>{{ $flight->origin }}</td>
       <td>{{ $flight->flight_no }}</td>

                    <td>

                    @if ($flight->payments()->exists())

                    @else
                        <button class="btn btn-outline btn-square btn-xs"
                            v-on:click="openModal({{ $flight->id }})">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    @endif
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
                      <th>Carrier Id</th>
      <th>Serial</th>
      <th>Remarks</th>
      <th>Delay Code</th>
      <th>Std</th>
      <th>Sta</th>
      <th>Departure</th>
      <th>Arrival</th>
      <th>Flight Date</th>
      <th>Turnaround Type</th>
      <th>Aircraft Registration</th>
      <th>Aircraft Type</th>
      <th>Flight Type</th>
      <th>Destination</th>
      <th>Origin</th>
      <th>Flight No</th>

            </tr>
        </tfoot>
    </table>
</div>


        {{ $flights->appends(request()->query())->links() }}
        <div id="my-modal" class="modal" :class="{ 'visible opacity-100 pointer-events-auto': isActive }">
            <div class="modal-box">
                <p>Are You Sure you want to delete this Sale. This will Delete Commisions and any Payment Associated with
                    this Payment</p>
                <div class="modal-action">
                    <div v-on:click="deleteItem" class="btn btn-primary">Yes</div>
                    <div v-on:click="closeModal" class="btn">Close</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('secondary-content')


@endsection

@section('pre_jquery')
    <script>




    </script>

@endsection

@section('jquery')
    <script>
        var app2 = new Vue({
            el: '#appx',
            mounted() {
                tippy('.service')
                flatpickr(".date", {
                  //  defaultDate: "{{ Carbon\Carbon::today()->format('Y-m-d') }}",
                    mode: "range"
                });
            },
            data: {
                isActive: false,
                item_id: null,
            },
            methods: {
                showConfirm: function() {
                    this.isActive = !this.isActive;
                },
                deleteSale: function() {
                    this.$http.delete(route('sale.destroy', {
                            sale: app2.item_id
                        }))
                        .then(function(response) {
                            console.log(response);
                            app2.showConfirm();
                            app2.item_id = null;
                                 window.location.href = route('sale.index');
                            // app2.showSuccessful();
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
                openModal: function(id) {
                    app2.showConfirm();
                    app2.item_id = id;
                },
                closeModal: function() {
                    app2.showConfirm();

                }
            },
            watch: {
                product: function(val) {
                    this.service = this.products[val];

                },
                staff: function(val) {
                    console.log(this.staff_rate[val]);
                    this.commision = this.staff_rate[val];

                }

            }
        })

    </script>
@endsection
