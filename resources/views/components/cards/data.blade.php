<div {{ $attributes->merge(['class' => 'card bg-white b-shadow-4']) }}>
    @if ($title)
        <x-cards.card-header>
            {!! $title !!}

            <x-slot name="action">

                {{-- Add User Action at the end --}}
                <a href="{{ $action }}" class="btn btn-primary btn-sm float-end">
                    <i class="fa fa-plus"></i> @lang('app.add') @lang('app.user')
                </a>

            </x-slot>

        </x-cards.card-header>
    @endif

    @if ($padding === 'false')
        <div class="card-body p-0 {{ $otherClasses }}">
            {{ $slot }}
        </div>
    @else
        <div class="card-body {{ $otherClasses }}">
            {{ $slot }}
        </div>
    @endif

    @isset($footer)
        <x-cards.card-footer>

        </x-cards.card-footer>
    @endisset
</div>
