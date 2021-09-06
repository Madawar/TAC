@extends('layouts.master_layout')
<?php use Illuminate\Support\Str; ?>
@section('main-heading')
    <h1
        class="p-4  text-center text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">
        Update Profile
    </h1>
@endsection
@section('secondary-heading')
    <h1
        class="p-4 text-center text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">
        Over View </h1>
@endsection

@section('content')
    <div class="p-2" >

        <x-forms.input label="User Name" placeholder="Username" name="name" model="{!! $user ?? null !!}" />
        <x-forms.password label="Password" placeholder="Password" name="password" />

        <div class="card text-center shadow-2xl mt-10">
            <div class="card-body">
                <h2 class="card-title">Your Signature</h2>


                @if ($user->signature)
                    <img src="{{ $image }}" class="object-contain w-32" />
                @endif
                <canvas id="canvas" class="canvas bg-yellow-400 shadow-sm w-full">

                </canvas>

                    <div class="flex flex-row pt-3">

                        <div class="flex-auto">
                            <div  class="btn btn-primary"> Clear </div>
                        </div>
                        <div class="flex-auto">
                            <button  class="btn btn-primary" type="submit"> Save and Complete </button>
                        </div>

                    </div>

            </div>
        </div>
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
<script>

var canvas = document.querySelector("canvas");

var signaturePad = new SignaturePad(canvas);


</script>
@endsection
