

{!! json_encode($options) !!}
@php
$options = array_merge(
    [
        'enableTime' => 'true',

        'dateFormat' => 'H:i',
    ],
    $options,
);
@endphp

<div wire:ignore>
    <input wire:ignore x-data="{value: @entangle($attributes->wire('model')), instance: undefined}" x-init="() => {
                $watch('value', value => instance.setDate(value, true));
                instance = flatpickr($refs.input, {{ json_encode((object) $options) }});
            }" x-ref="input" x-bind:value="value" type="text"
        {{ $attributes->merge(['class' => 'input input-bordered']) }} />
</div>
