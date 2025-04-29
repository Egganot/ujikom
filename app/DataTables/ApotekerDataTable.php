<?php

namespace App\DataTables;

use App\Models\Apoteker;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ApotekerDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('aksi', 'apoteker.action')
            ->addIndexColumn()
            ->addColumn('aksi', function (Apoteker $row) {
                return view('pages.apoteker.action', ['data' => $row]);
            })
            ->addColumn('email', function (Apoteker $row) {
                return $row->user->email;
            })
            ->rawColumns(['aksi'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Apoteker $model): QueryBuilder
    {
        return $model->newQuery()->with('user');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('apoteker-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy('0', 'desc')
            ->addTableClass('table table-row-dashed align-middle gy-5 dataTable no-footer fw-semibold fs-5')
            ->setTableHeadClass('thead fw-bold text-white text-uppercase')
            ->select(false)
            ->buttons([]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')
                ->visible(false)
                ->searchable(false),
            Column::computed('aksi')
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->width(10)
                ->addClass('text-center'),
            Column::make('NmApoteker')
                ->title("Nama Apoteker")
                ->searchable(true),
            Column::computed('email')
                ->title("Email")
                ->searchable(true),
            Column::make('Alamat')
                ->title("Alamat")
                ->searchable(true),
            Column::make('Kota')
                ->title("Kota")
                ->searchable(true),
            Column::make('Telpon')
                ->title("Telpon")
                ->searchable(true),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Apoteker_' . date('YmdHis');
    }
}
