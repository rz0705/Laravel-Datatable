<?php

namespace App\DataTables;

use App\Exports\UsersExport;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends BaseDataTable
{

    /**
     * Export class handler.
     *
     * @var class-string
     */
    protected string $exportClass = UsersExport::class;

    /**
     * The title of the PDF page for the UsersDataTable class.
     *
     * @var string
     */
    protected string $pdfPageTitle = 'Users';

    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn(
                'status',
                function ($row) {
                    return $row->status->getLabelHtml();
                }
            )
            ->editColumn(
                'created_at',
                function ($row) {
                    return Carbon::parse($row->created_at)->format($this->dateTimeFormat);
                }
            )
            ->editColumn(
                'updated_at',
                function ($row) {
                    return Carbon::parse($row->updated_at)->format($this->dateTimeFormat);
                }
            )
            ->addColumn(
                'action',
                function ($row) {
                    return view('users.datatables_actions', compact('row'));
                }
            )
            ->rawColumns(['status', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        $request = $this->request();
        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');
        $searchStr = $request->input('search.value') ?? '';

        if ($startDate && $endDate) {
            $startDate = Carbon::createFromFormat($this->dateFormat, $startDate)->startOfDay();
            $endDate = Carbon::createFromFormat($this->dateFormat, $endDate)->endOfDay();

            $model = $model->whereBetween('created_at', [$startDate, $endDate]);
        }

        if ($searchStr) {
            $model = $model->where('name', 'like', "%{$searchStr}%")
                           ->orWhere('email', 'like', "%{$searchStr}%");
        }

        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom($this->domHtml)
                    ->orderBy(0)
                    ->selectStyleSingle()
                    ->language(__('app.datatable'))
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                    ])
                    ->parameters([
                        'initComplete' => 'function () {
                           window.LaravelDataTables["users-table"].buttons().container()
                            .appendTo("#table-actions")
                        }',
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->title(__('modules/user.id')),
            Column::make('name')->title(__('modules/user.name')),
            Column::make('email')->title(__('modules/user.email')),
            Column::make('created_at')->title(__('modules/user.created_at')),
            Column::make('updated_at')->title(__('modules/user.updated_at')),
            Column::make('status')->title(__('modules/user.status.title'))->addClass('text-center'),
            Column::computed('action')
                  ->title(__('app.action'))
                  ->exportable(false)
                  ->printable(false)
                  ->width(120)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
