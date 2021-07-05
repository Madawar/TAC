@extends('layouts.master_layout')

@section('main-heading')
    <h1
        class="p-4  text-center text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">
        Create Flight
    </h1>
@endsection
@section('secondary-heading')
    <h1
        class="p-4 text-center text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">
        Overview </h1>
@endsection


@section('pre_jquery')
    <script>


    </script>
@endsection

@section('content')

    @if ($flight)
        <form action="{{ route('flight.update', ['flight' => $flight->id]) }}" method="POST" id="appx">
            @method('PATCH')
        @else
            <form action="{{ route('flight.store') }}" method="post" id="appx">
    @endif

    @csrf

    <div class="flex flex-col md:flex-row p-2 md:space-x-3 w-full" >

        <div class="flex-auto">

            <x-forms.select label="Carrier" placeholder="Carrier" name="carrier_id" :options="[]"
                model="{!! $flight ?? null !!}" />

        </div>
        <div class="flex-auto">
            <x-forms.input label="Flight Number" placeholder="Flight Number" name="flight_no"
                model="{!! $flight ?? null !!}" />
        </div>
        <div class="flex-auto">
            <x-forms.select label="Aircraft Type" placeholder="Aircraft Type" name="aircraft_type" :options="[]"
                model="{!! $flight ?? null !!}" />

        </div>

    </div>
    <div class="flex flex-col md:flex-row p-2 md:space-x-3 w-full">

        <div class="flex-auto">

            <x-forms.select label="Turnaround Type" placeholder="Turnaround Type" name="turnaround_type" :options="[]"
                model="{!! $flight ?? null !!}" />

        </div>


    </div>
    <div class="flex flex-col md:flex-row p-2 md:space-x-3 w-full">
        <div class="flex-auto">
            <x-forms.select label="Flight Handling Type" placeholder="Flight Handling Type" name="flight_type" :options="[]"
                model="{!! $flight ?? null !!}" />
        </div>
        <div class="flex-auto">
            <x-forms.input label="Scheduled Time of Arrival" placeholder="Scheduled Time of Arrival" name="STA" class="date"
                model="{!! $flight ?? null !!}" />
        </div>
        <div class="flex-auto">
            <x-forms.input label="Scheduled Time Of Departure" placeholder="Scheduled Time Of Departure" name="STD" class="date"
                model="{!! $flight ?? null !!}" />
        </div>
    </div>
    <div class="flex flex-col md:flex-row p-2 md:space-x-3 w-full">

        <div class="flex-auto">
            <x-forms.input label="Flight Origin" placeholder="Flight Origin" name="origin"
                model="{!! $flight ?? null !!}" />
        </div>
        <div class="flex-auto">
            <x-forms.input label="Destination" placeholder="Destination" name="destination"
                model="{!! $flight ?? null !!}" />
        </div>

    </div>

    <div class="shadow-sm m-2 bg-gray-100">

        <div class="alert alert-error ">
            <div class="flex-1 ">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#2196f3" class="w-6 h-6 mx-2">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              <label>Most of this information you can fill at the airside but if you know them you can do so now</label>
            </div>
          </div>


        <div class="flex flex-col md:flex-row p-2 md:space-x-3 w-full">

            <div class="flex-auto">
                <x-forms.input label="Aircraft Registration" placeholder="Aircraft Registration"
                    name="aircraft_registration" model="{!! $flight ?? null !!}" />

            </div>
            <div class="flex-auto">
                <x-forms.input label="Arrival Date & Time" placeholder="Arrival Date & Time" name="arrival" class="date"
                    model="{!! $flight ?? null !!}" />

            </div>
            <div class="flex-auto">
                <x-forms.input label="Departure Time & Date" placeholder="Departure Time & Date" name="departure" class="date"
                    model="{!! $flight ?? null !!}" />

            </div>

        </div>

        <div class="flex flex-col md:flex-row p-2 md:space-x-3 w-full">
            <div class="flex-auto">
                <x-forms.select label="Delay Code" placeholder="Delay Code" name="delay_code" :options="[]"
                model="{!! $flight ?? null !!}" />

            </div>
        </div>

        <div class="flex flex-col md:flex-row p-2 md:space-x-3 w-full">
            <div class="flex-auto">
                <x-forms.textarea label="Remarks" placeholder="Remarks" name="remarks" model="{!! $flight ?? null !!}" />

            </div>
        </div>



    </div>
    <!-- Move this to Layout -->
ff




    <div class="flex-col p-2 w-full">
        <div class="grid justify-items-stretch">
            <button class="btn btn-primary">Save Flight</button>
        </div>
    </div>
    </form>
@endsection

@section('secondary-content')


@endsection
@section('jquery')
    <script>
        var app2 = new Vue({
            el: '#appx',
            mounted() {
                flatpickr(".date", {
                  //  defaultDate: "{{ Carbon\Carbon::today()->format('Y-m-d') }}"
                  enableTime: true,
                });
            },
            data: {

            },
            methods: {

            },
            watch: {


            }
        })
    </script>
@endsection
