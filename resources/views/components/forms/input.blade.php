@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'form-control p-2 text-left f-14 f-w-500 border-additional-grey',
]) !!}>
