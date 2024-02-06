<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        @php
            $link = '';
        @endphp

        @for ($i = 1; $i <= count(Request::segments()); $i++)
            @if ($i < count(Request::segments()) && $i > 0)
                @php $link .= '/' . Request::segment($i); @endphp

                @if (!is_numeric(Request::segment($i)))
                    <li class="breadcrumb-item">
                        <a href="<?= str_contains(url()->current(), 'public') ? '/public' . $link : $link ?>">
                            {{ mb_convert_case(str_replace('-', ' ', Request::segment($i)), MB_CASE_TITLE, 'utf8') }}
                        </a>
                    </li>
                @endif
            @else
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $pageTitle }}
                </li>
            @endif
        @endfor
    </ol>
</nav>
