<div>
    @if ($flight)
        <div class=" mt-2 w-36  bg-gray shadow-sm p-2">
            <div class="flex flex-row border-b border-gray-50 p-2 text-center">

                <div class="flex-auto text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark-mode:text-white">{{$flight->carrier->carrier_code}} {{$flight->flight_no}}</div>

            </div>
            <div class="flex flex-row ">
                <div class="flex-auto text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark-mode:text-white ">Carrier</div>
                <div class="flex-auto tracking-widest text-base">{{$flight->carrier->carrier_code}}</div>

            </div>
        </div>
    @endif

</div>
