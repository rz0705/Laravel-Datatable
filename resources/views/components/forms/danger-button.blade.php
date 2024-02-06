<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-danger rounded ']) }}>
    {{ $slot }}
</button>
