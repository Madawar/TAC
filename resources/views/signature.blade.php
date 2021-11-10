@extends('layouts.signature_mobile')
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
    <div>

        <canvas id="canvas" class="canvas h-screen w-full bg-yellow-400 shadow-sm ">

        </canvas>
        <div class="flex flex-row pt-3">

            <div class="flex-auto">
                <button wire:click="$emit('clear')" class="btn btn-primary"> Clear </button>
            </div>
            <div class="flex-auto">
                <button wire:click="$emit('save')" class="btn btn-primary" wire:target="signatureSaved"
                    wire:loading.class="loading"> Save and Complete </button>
            </div>

        </div>
    </div>

@endsection



@section('jquery')
    <script>
        var canvas = document.querySelector("canvas");

        var signaturePad = new SignaturePad(canvas);

        function resizeCanvas() {
            // When zoomed out to less than 100%, for some very strange reason,
            // some browsers report devicePixelRatio as less than 1
            // and only part of the canvas is cleared then.
            var ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = window.innerHeight - 100;
            canvas.getContext("2d").scale(ratio, ratio);
        }
        var signaturePad = new SignaturePad(canvas);
        window.onresize = resizeCanvas;
        resizeCanvas();
    </script>

@endsection
