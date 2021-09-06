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
    <div class="p-2">
        <form action="{{ route('profile.update', ['profile' => $user->id]) }}" method="POST" id="appx">
            @method('PATCH')
            @csrf
            <x-forms.input label="User Name" placeholder="Username" name="name" model="{!! $user ?? null !!}" />
            <x-forms.password label="Password" placeholder="Password" name="password" />
            <input type="hidden" id="signature" name="signature" />
            <div class="card text-center shadow-2xl mt-10">
                <div class="card-body">
                    <h2 class="card-title">Your Signature</h2>


                    @if ($user->signature)
                        <img src="{{ $image }}" class="object-contain w-32" />
                    @endif
                    <canvas id="canvas" width=400 height=400 wire:ignore class="canvas bg-yellow-400 shadow-sm">

                    </canvas>

                    <div class="flex flex-row pt-3">

                        <div class="flex-auto">
                            <div id='clearButton' class="btn btn-primary"> Clear </div>
                        </div>
                        <div class="flex-auto">
                            <button class="btn btn-primary" type="submit"> Save and Complete </button>
                        </div>

                    </div>

                </div>
            </div>
        </form>
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

        function resizeCanvas() {
            // When zoomed out to less than 100%, for some very strange reason,
            // some browsers report devicePixelRatio as less than 1
            // and only part of the canvas is cleared then.
            var ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);
        }
        var signaturePad = new SignaturePad(canvas);
        window.onresize = resizeCanvas;
        resizeCanvas();
        clearButton.addEventListener("click", function(event) {
            signaturePad.clear();
            return false;
        });

        signaturePad.onEnd = function() {
            data = signaturePad.toDataURL();
            document.getElementById("signature").value = data;
        };
    </script>
@endsection
