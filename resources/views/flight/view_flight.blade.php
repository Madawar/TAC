@extends('layouts.master_layout')
<?php use Illuminate\Support\Str;
use App\Http\Controllers\FlightController;
?>
@section('main-heading')
    <h1
        class="p-4  text-center text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">
        View flight
    </h1>
@endsection
@section('secondary-heading')
    <h1
        class="p-4 text-center text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">
        Over View </h1>
@endsection

@section('content')
    <div class="p-2">
        <form method="get" action="{{route('flight.show', ['flight' => $flight->id])}}">
             <div class="form-control mb-5">
            <label class="label">
                <span class="label-text">Send Email to Customer : </span>
            </label>
            <div class="relative">
                <input name="mm" type="text" placeholder="Search" class="w-full pr-16 input input-primary input-bordered">
                <input name="email" type="hidden" value="1" placeholder="Search" class="w-full pr-16 input input-primary input-bordered">
                <button type="submit" class="absolute top-0 right-0 rounded-l-none btn btn-primary">Send</button>
            </div>
    </div>
    <iframe src="{{ $pdf }}" width="100%" height="800px">
    </iframe>



    </div>
@endsection

@section('secondary-content')
    <div class=" ">

    </div>

@endsection

@section('pre_jquery')
    <script>




    </script>

@endsection

@section('jquery')

@endsection
