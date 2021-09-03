<div class="flex flex-col md:flex-row p-2 md:space-x-3 w-full">
    @if($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
@endif
    <div class="flex-auto mb-1 md:mb-0">

        <select
            class="px-3 py-3 placeholder-gray-400 text-gray-600 relative bg-white bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:ring w-full"
            wire:model="service.service_list_id" wire:change="getUom">
            <option value="" selected>Please Choose an Item</option>
            @foreach ($services as $service)
                <option value="{{ $service->id }}">{{ $service->description }}</option>
            @endforeach
        </select>


    </div>

    @if ($serviceUom == 'TIME-INTERVAL')
        <div class="flex-auto mb-1 md:mb-0"  wire:ignore>

            <input type="text" placeholder="Start Time" wire:ignore  x-data wire:model="service.start_time"
                    x-init="() => {

                        instance = flatpickr($refs.input,{
                            enableTime: true,
                            noCalendar: true,
                            dateFormat: 'H:i',
                            onChange: function(dateObj, dateStr) {
                                console.log('start Saving');
                                @this.call('updateDate', 'start_time',dateStr)
                            }
                        });

                    }"
                    x-ref="input"


                class=" px-3 py-3 placeholder-gray-400 text-gray-600 relative bg-white bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:ring w-full" />




        </div>
        <div class="flex-auto mb-1 md:mb-0" wire:ignore >
            <input type="text" placeholder="Start Time" wire:ignore  x-data wire:model="service.end_time"
            x-init="() => {

                instance = flatpickr($refs.input,{
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: 'H:i',
                    onChange: function(dateObj, dateStr) {
                        console.log('start Saving');
                        @this.call('updateDate', 'end_time',dateStr)
                    }
                });

            }"
            x-ref="input"


        class=" px-3 py-3 placeholder-gray-400 text-gray-600 relative bg-white bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:ring w-full" />
        </div>

    @endif
    @if ($serviceUom == 'QTY')
        <div class="flex-auto">
            <input type="text" placeholder="Quantity" wire:model="service.qty" wire:change="save"
                class="px-3 py-3 placeholder-gray-400 text-gray-600 relative bg-white bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:ring w-full" />
        </div>
    @endif

    <div class="flex-none">
        <button class="btn btn-block md:btn-circle btn-sm btn-error mt-2 shadow-sm" wire:click="removeItem({{$key}})")>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                class="inline-block w-4 h-4 stroke-current md:w-4 md:h-4">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                </path>
            </svg>
        <span class="md:hidden">Remove</span>
        </button>

    </div>
</div>
