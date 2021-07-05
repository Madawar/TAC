@extends('layouts.master_layout')

@section('main-heading')
    <h1
        class="p-4  text-center text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">
        Create Carrier
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

    @if ($carrier)
        <form action="{{ route('carrier.update', ['carrier' => $carrier->id]) }}" method="POST" enctype="multipart/form-data" id="appx">
            @method('PATCH')
        @else
            <form action="{{ route('carrier.store') }}" method="post" enctype="multipart/form-data" id="appx">
    @endif

    @csrf

    <div class="flex flex-col md:flex-row p-2 md:space-x-3 w-full">

        <div class="flex-auto">
            <x-forms.input label="Carrier Name" placeholder="Carrier Name" name="carrier_name"
                model="{!! $carrier ?? null !!}" />
        </div>

        <div class="flex-auto">

            <x-forms.input label="Carrier 3 Letter Code" placeholder="Carrier 3 Letter Code" name="carrier_code"
                model="{!! $carrier ?? null !!}" />

        </div>


    </div>
    <div class="flex flex-col md:flex-row p-2 md:space-x-3 w-full">

        <div class="flex-auto">
            <x-forms.input label="Carrier Email" placeholder="Carrier Email" name="carrier_email"
                model="{!! $carrier ?? null !!}" />

        </div>


    </div>
    <div class="flex flex-col md:flex-row p-2 md:space-x-3 w-full">



        <div class="flex-auto">
            <label
            class="w-64 flex flex-col items-center px-4 py-6 bg-white rounded-md shadow-md tracking-wide uppercase border border-blue cursor-pointer hover:bg-purple-600 hover:text-white text-purple-600 ease-linear transition-all duration-150">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
              </svg>
            <span class="mt-2 text-base leading-normal">Select Carrier Logo</span>
            <input type='file' name="logo" class="hidden" />
          </label>

        </div>

    </div>


    <!-- Move this to Layout -->







    <div class="flex-col p-2 w-full">
        <div class="grid justify-items-stretch">
            <button class="btn btn-primary">Save Carrier</button>
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
                    defaultDate: "{{ Carbon\Carbon::today()->format('Y-m-d') }}"
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
