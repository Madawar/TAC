<div>
    <?php use Illuminate\Support\Str; ?>
    <div class="border border-gray-300 m-1 shadow-inner">
        <div
            class="border-b border-gray-300 shadow-xl p-2 leading-loose text-center uppercase font-semibold  bg-gray-500 text-white">
            Incidental Services for Flight {{ $carrier }}-{{ $flight->flight_no }} for
            {{ Carbon\Carbon::parse($flight->flight_date)->format('j-M-y') }}



        </div>
        <div class="divide-y divide-gray-300">
            @if ($serviceItems)
                @foreach ($serviceItems as $key => $service)
                    @livewire('services.flight-services-item',['service' =>
                    $service,'key'=>$key,'flight'=>$flight],key($key))
                @endforeach
            @endif
        </div>

        <div class="">
            <div class="flex justify-center ">

                <button class="btn btn-circle m-1" wire:click="addService" wire:target="addService" wire:loading.class="loading">
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-4 h-4 stroke-current md:w-6 md:h-6"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" wire:loading.remove wire:target="addService">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>


                </button>
            </div>

        </div>
    </div>

</div>
