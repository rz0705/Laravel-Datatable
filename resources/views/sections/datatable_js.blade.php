<script src="{{ asset('datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatables/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('datatables/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('datatables/js/buttons.bootstrap5.min.js') }}"></script>
<script src="{{ asset('datatables/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('datatables/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('datatables/js/buttons.server-side.js') }}"></script>
{!! $dataTable->scripts() !!}

<script type="text/javascript">
    $(function() {
        var start = moment().subtract(89, 'days');
        var end = moment();

        function cb(start, end) {
            $('#datatableRange').val(start.format(dateFormat) + ' @lang('app.to') ' + end.format(dateFormat));
            $('#reset-filters').removeClass('d-none');
        }

        $('#datatableRange').daterangepicker({
            autoUpdateInput: false,
            locale: daterangeLocale,
            linkedCalendars: false,
            startDate: start,
            endDate: end,
            ranges: daterangeConfig
        }, cb);


        $('#datatableRange').on('apply.daterangepicker', function(ev, picker) {
            showTable();
        });

    });
</script>
