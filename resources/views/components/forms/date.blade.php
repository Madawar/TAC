@props(['options' => []])

@php
$options = array_merge(
    [
        'enableTime' => 'true',
        'noCalendar' => 'true',
        'dateFormat' => 'H:i',
    ],
    $options,
);
@endphp

<div wire:ignore>
    <input x-data="{value: @entangle($attributes->wire('model')), instance: undefined}" x-init="() => {
                $watch('value', value => instance.setDate(value, true));
                instance = flatpickr($refs.input, {{ json_encode((object) $options) }});
            }" x-ref="input" x-bind:value="value" type="text"
        {{ $attributes->merge(['class' => 'px-3 py-3 placeholder-gray-400 text-gray-600 relative bg-white bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:ring w-full']) }} />
</div>
