<?php

namespace App\DataTables;

use Illuminate\Contracts\Support\Renderable;
use Yajra\DataTables\Services\DataTable;

class BaseDataTable extends DataTable
{
    public $domHtml;
    public $dateFormat;
    public $dateTimeFormat;

    public function __construct()
    {
        $this->dateFormat = config('app.date_format_php');
        $this->dateTimeFormat = config('app.date_time_format_php');
        $this->domHtml = "<'row'<'col-md-6'l><'col-md-6'f>>" .
                "<'row'<'col-md-12'tr>>" .
                "<'row'<'col-md-5'i><'col-md-7'p>>";
    }

    /**
     * Display printable view of datatables.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function printPreview(): Renderable
    {
        $data = $this->getDataForPrint();
        $pdfPageTitle = $this->pdfPageTitle;

        return view($this->printPreview, compact('data', 'pdfPageTitle'));
    }
}
