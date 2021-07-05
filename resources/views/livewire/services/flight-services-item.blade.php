<div class="flex flex-col md:flex-row p-2 md:space-x-3 w-full">
    @if($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
@endif
    <div class="flex-auto">

        <select
            class="px-3 py-3 placeholder-gray-400 text-gray-600 relative bg-white bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:ring w-full"
            wire:model="service.service_list_id" wire:change="getUom">
            <option value="">Please Choose an Item</option>
            @foreach ($services as $service)
                <option value="{{ $service->id }}">{{ $service->description }}</option>
            @endforeach
        </select>


    </div>

    @if ($serviceUom == 'TIME-INTERVAL')
        <div class="flex-auto">
            <input type="text" placeholder="Start Time" x-data wire:model="service.start_time" x-init="flatpickr($refs.input,{
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: 'H:i',
                    })" x-ref="input"
                class=" px-3 py-3 placeholder-gray-400 text-gray-600 relative bg-white bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:ring w-full" />


        </div>
        <div class="flex-auto">
            <input type="text" placeholder="End Time" x-data wire:model="service.end_time" x-init="flatpickr($refs.input2,{
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: 'H:i',
                })" x-ref="input2"
                class="date_start px-3 py-3 placeholder-gray-400 text-gray-600 relative bg-white bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:ring w-full" />

        </div>

    @endif
    @if ($serviceUom == 'QTY')
        <div class="flex-auto">
            <input type="text" placeholder="Quantity" wire:model="service.qty"
                class="px-3 py-3 placeholder-gray-400 text-gray-600 relative bg-white bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:ring w-full" />

        </div>
    @endif
    <input type="hidden" name="uom" value="{{$serviceUom}}"/>
    <div class="flex-none">
        <button class="btn btn-circle btn-sm btn-error mt-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                class="inline-block w-4 h-4 stroke-current md:w-4 md:h-4">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                </path>
            </svg>
        </button>
    </div>
</div>
