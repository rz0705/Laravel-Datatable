<a href="{{ $link }}" {{ $attributes->merge(['class' => 'btn btn-danger rounded f-14']) }}
    @if (isset($dataBsToggle) && $dataBsToggle == 'modal') data-bs-toggle="modal"
        data-bs-target="{{ $dataBsModalTarget }}" @endif>
    {{ $slot }}
</a>
