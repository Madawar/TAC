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

        @if ($flight->signature != null)
            <form method="get" action="{{ route('flight.show', ['flight' => $flight->id]) }}">
                <div class="form-control mb-5">
                    <label class="label">
                        <span class="label-text">Send Email to Customer : </span>
                    </label>
                    <div class="relative">
                        <input name="mm" type="text" placeholder="Carrier Emails" value="{{ $carrier_emails }}"
                            class="w-full pr-16 input input-primary input-bordered">
                        <input name="email" type="hidden" value="1" placeholder="Search"
                            class="w-full pr-16 input input-primary input-bordered">
                        @if ($flight->email_sent == 0)
                            <button type="submit" class="absolute top-0 right-0 rounded-l-none btn btn-primary">Send</button>
                        @endif
                    </div>
                </div>
            </form>
        @else
            <div class="alert alert-error mb-1">
                <div class="flex-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        class="w-6 h-6 mx-2 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                    <label>Chargesheet is not signed yet cannot send email</label>
                </div>
            </div>
        @endif
        @if ($flight->email_sent)
            <div class="alert alert-error mb-1">
                <div class="flex-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        class="w-6 h-6 mx-2 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                    <label>Please Note an email has already been sent to the airline, Please Resend from Your
                        Computer!!!</label>
                </div>
            </div>
        @endif
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
