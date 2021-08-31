@extends('layouts.master_mobile')
<?php use Illuminate\Support\Str; ?>
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
    <div class="p-2" >

        @livewire('finance.finance-activity',['flight'=>$flight,'image'=>$image])



    </div>
@endsection

@section('secondary-content')
    <div class=" ">
        @livewire('flight-details')
    </div>

@endsection

@section('pre_jquery')
    <script>




    </script>

@endsection

@section('jquery')

@endsection
