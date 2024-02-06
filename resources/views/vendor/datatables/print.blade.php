<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} - {{ $pdfPageTitle ?? '' }}</title>
    <style>
        body {
            margin: 25px;
            font-family: 'Nunito', sans-serif;
            font-size: 14px;
            line-height: 1.42857143;
            color: #333;
            background-color: #fff;
        }

        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        html {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            font-size: 10px;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }

        :after,
        :before {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        table {
            border-spacing: 0;
            border-collapse: collapse;
            width: 100%;
            max-width: 100%;
            margin-bottom: 25px;
            background-color: transparent;
        }

        .table-bordered {
            border: 1px solid #ddd;
        }

        .table-striped>tbody>tr:nth-of-type(2n + 1) {
            background-color: #f9f9f9;
        }

        th {
            padding: 0;
        }

        th {
            text-align: left;
        }

        .table>tbody>tr>th {
            padding: 8px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #ddd;
        }

        .table-condensed>tbody>tr>th {
            padding: 5px;
        }

        .table-bordered>tbody>tr>th {
            border: 1px solid #ddd;
        }

        td {
            padding: 0;
        }

        .table>tbody>tr>td {
            padding: 8px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #ddd;
        }

        .table-condensed>tbody>tr>td {
            padding: 5px;
        }

        .table-bordered>tbody>tr>td {
            border: 1px solid #ddd;
        }

        .text-success {
            color: #3c763d;
        }

        .text-danger {
            color: #a94442;
        }

        .text-warning {
            color: #8a6d3b;
        }

        .text-center {
            text-align: center;
        }

        .info-label {
            font-weight: bold;
        }

        .color-danger {
            color: #ff0000;
        }

        .color-success {
            color: #124805;
        }

        .copyright-footer {
            margin-top: 10px;
            text-align: center;
            color: #777;
            font-size: 12px;
        }

        tr {
            page-break-inside: avoid;
            /* Avoid page breaks within rows */
        }

        td,
        th {
            padding: 5px;
            margin: 0;
        }

        .table-head {
            background-color: #5D6975 !important;
            color: #fff;
        }
    </style>
</head>

<body>
    <table class="table table-bordered table-condensed table-striped">
        @foreach ($data as $row)
            @if ($loop->first)
                <tr class="table-head">
                    {{-- SI no. --}}
                    <th>SI No.</th>
                    @foreach ($row as $key => $value)
                        <th>{!! $key !!}</th>
                    @endforeach
                </tr>
            @endif
            <tr>
                <td>{{ $loop->iteration }}</td>
                @foreach ($row as $key => $value)
                    @if (is_string($value) || is_numeric($value))
                        <td>{!! $value !!}</td>
                    @else
                        <td></td>
                    @endif
                @endforeach
            </tr>
        @endforeach
    </table>
    <p class="copyright-footer">&copy; {{ now()->format('Y') }} {{ config('app.name') }}. All rights reserved.</p>
</body>

</html>
