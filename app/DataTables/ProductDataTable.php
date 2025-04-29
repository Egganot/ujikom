<?php

namespace App\DataTables;

use App\Models\Obat;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('aksi', 'product.action')
            ->addIndexColumn()
            ->addColumn('aksi', function (Obat $row) {
                return view('pages.product.action', ['data' => $row]);
            })
            ->addColumn('NmSupplier', function (Obat $row) {
                return $row->supplier->NmSupplier;
            })
            ->addColumn('Kadaluarsa', function (Obat $row) {
                $today = Carbon::now();
                $kadaluarsa = Carbon::parse($row->Kadaluarsa);

                $selisihHari = $today->diffInDays($kadaluarsa, false);

                if ($selisihHari <= 30 && $selisihHari >= 0) {
                    return '<span class="badge bg-warning text-white">' . $kadaluarsa->format('Y-m-d') . '</span>';
                } elseif ($selisihHari < 0) {
                    return '<span class="badge bg-danger text-white"> Obat ini Telah Kadaluarsa </span>';
                } else {
                    return $kadaluarsa->format('Y-m-d');
                }
            })
            ->rawColumns(['aksi', 'Kadaluarsa'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Obat $model): QueryBuilder
    {
        return $model->newQuery()->with('supplier');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('product-table')
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
            Column::make('NmObat')
                ->title("Nama Obat")
                ->searchable(true),
            Column::make('Jenis')
                ->title("Jenis")
                ->searchable(true),
            Column::make('Satuan')
                ->title("Satuan")
                ->searchable(true),
            Column::make('HargaBeli')
                ->title("HargaBeli")
                ->searchable(true),
            Column::make('HargaJual')
                ->title("HargaJual")
                ->searchable(true),
            Column::make('Stok')
                ->title("Stok")
                ->searchable(true),
            Column::computed('Kadaluarsa')
                ->title("Kadaluarsa")
                ->searchable(true),
            Column::computed('NmSupplier')
                ->title("Nama Supplier")
                ->searchable(true),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Product_' . date('YmdHis');
    }
}
