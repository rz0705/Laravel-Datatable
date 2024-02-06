<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} - {{ $pageTitle }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Bootstrap Bundle with Popper -->
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    {{-- Font Awesome 5 CSS --}}
    <script src="https://kit.fontawesome.com/9cee9f8575.js" crossorigin="anonymous"></script>

    {{-- Font --}}
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{-- Datatable CSS --}}
    @stack('datatable-styles')

    {{-- Jquery DateRangePicker --}}
    <link rel="stylesheet" href="{{ asset('css/daterangepicker.css') }}">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>

<body class="font-sans antialiased">
    <div id="min-vh-100 bg-light">
        <!-- Page Heading -->
        @if (isset($header))
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <h1 class="page-heading">
                            {{ $header }}
                        </h1>
                    </div>
                </div>
            </div>
        @endif

        <!-- Page Content -->
        <main class="py-4">
            {{ $slot }}
        </main>
    </div>

    {{-- Jquery --}}
    <script src="{{ asset('js/jquery-3.7.0.js') }}"></script>

    {{-- DateRangePicker --}}
    <script src="{{ asset('js/moment.min.js') }}"></script>

    <script>
        // Config for DateRangePicker
        const dateFormat = "{{ config('app.date_format_js') }}";

        const daterangeConfig = {
            "@lang('app.today')": [moment(), moment()],
            "@lang('app.last30Days')": [moment().subtract(29, 'days'), moment()],
            "@lang('app.thisMonth')": [moment().startOf('month'), moment().endOf('month')],
            "@lang('app.lastMonth')": [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month')
                .endOf(
                    'month')
            ],
            "@lang('app.last90Days')": [moment().subtract(89, 'days'), moment()],
            "@lang('app.last6Months')": [moment().subtract(6, 'months'), moment()],
            "@lang('app.last1Year')": [moment().subtract(1, 'years'), moment()]
        };

        const daterangeLocale = {
            "format": dateFormat,
            "customRangeLabel": "@lang('app.customRange')",
            "separator": " @lang('app.to') ",
            "applyLabel": "@lang('app.apply')",
            "cancelLabel": "@lang('app.cancel')",
            "daysOfWeek": ['@lang('app.weeks.Sun')', '@lang('app.weeks.Mon')',
                '@lang('app.weeks.Tue')',
                '@lang('app.weeks.Wed')', '@lang('app.weeks.Thu')', '@lang('app.weeks.Fri')',
                '@lang('app.weeks.Sat')'
            ],
            "monthNames": [
                '@lang('app.months.January')',
                '@lang('app.months.February')',
                "@lang('app.months.March')",
                "@lang('app.months.April')",
                "@lang('app.months.May')",
                "@lang('app.months.June')",
                "@lang('app.months.July')",
                "@lang('app.months.August')",
                "@lang('app.months.September')",
                "@lang('app.months.October')",
                "@lang('app.months.November')",
                "@lang('app.months.December')"
            ],
            "firstDay": 1
        };
    </script>

    <script src="{{ asset('js/daterangepicker.min.js') }}"></script>

    {{-- Custom JS --}}
    @stack('scripts')
</body>
</html>
