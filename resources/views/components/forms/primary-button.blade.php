@props(['disabled' => false])

<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary rounded ']) }}
    {{ $disabled ? 'disabled' : '' }}>
    {{ $slot }} </button>
