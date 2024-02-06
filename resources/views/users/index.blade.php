<x-app-layout :pageTitle="$pageTitle">
    @push('datatable-styles')
        @include('sections.datatable_css')
    @endpush

    <x-slot name="title">
        {{ __('Users') }}
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <x-app-title class="d-block" :pageTitle="__($pageTitle)"></x-app-title>

                    @if (session('success'))
                        <x-alert level="success" :message="session('success')" />
                    @elseif (session('error'))
                        <x-alert level="error" :message="session('error')" />
                    @endif

                    <x-cards.data :title="__('modules/user.all')" :action="route('users.create')">

                        <form action="" id="filter-form">
                            <div class="row mb-3">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <x-forms.label for="datatableRange" value="{{ __('app.duration') }}" />
                                    <div class="input-group">
                                        <x-forms.input type="text"
                                            class="form-control p-2 text-left f-14 f-w-500 border-additional-grey"
                                            id="datatableRange" placeholder="{{ __('app.dateRange') }}" />

                                        <x-forms.danger-button class="btn-sm f-14 p-2 d-none" type="button"
                                            id="reset-filters">
                                            <i class="fa fa-times"></i> @lang('app.reset')
                                        </x-forms.danger-button>
                                    </div>
                                </div>
                                <!-- Other filters can be added similarly -->
                            </div>
                        </form>

                        {{ $dataTable->table(['class' => 'table dataTable table-striped table-bordered table-hover no-footer']) }}

                        <x-slot name="footer"></x-slot>

                    </x-cards.data>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        @include('sections.datatable_js')
        <script>
            $('#users-table').on('preXhr.dt', function(e, settings, data) {
                var dateRangePicker = $('#datatableRange').data('daterangepicker');
                var startDate = $('#datatableRange').val();

                if (startDate == '') {
                    startDate = null;
                    endDate = null;
                } else {
                    startDate = dateRangePicker.startDate.format(dateFormat);
                    endDate = dateRangePicker.endDate.format(dateFormat);
                }

                data.startDate = startDate;
                data.endDate = endDate;
            });
            const showTable = () => {
                window.LaravelDataTables["users-table"].draw(false);
            }

            $('#reset-filters').click(function() {
                $('#filter-form')[0].reset();
                $('#reset-filters').addClass('d-none');
                showTable();
            });
        </script>
    @endpush
</x-app-layout>
