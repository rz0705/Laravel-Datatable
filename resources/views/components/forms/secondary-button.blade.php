<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-secondary rounded']) }}>
    {{ $slot }}
</button>
