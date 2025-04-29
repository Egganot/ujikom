<?php

namespace App\DataTables;

use App\Models\Pembelian;
use App\Models\Penjualan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ReportDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     */
    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                return view('pages.report.action', ['data' => $row]);
            })
            ->rawColumns(['aksi'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(): QueryBuilder
    {
        // Query pembelian
        $pembelian = Pembelian::select(
            'pembelians.id',
            DB::raw("'Pembelian' as Jenis"),
            'suppliers.NmSupplier as Nama',
            'pembelians.TglNota',
            'pembelians.Diskon'
        )
            ->join('suppliers', 'pembelians.KdSupplier', '=', 'suppliers.id');

        // Query penjualan
        $penjualan = Penjualan::select(
            'penjualans.id',
            DB::raw("'Penjualan' as Jenis"),
            'pelanggans.NmPelanggan as Nama',
            'penjualans.TglNota',
            'penjualans.Diskon'
        )
            ->join('pelanggans', 'penjualans.KdPelanggan', '=', 'pelanggans.id');

        // Gabungkan pembelian dan penjualan
        $query = $pembelian->unionAll($penjualan);

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('report-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy('3', 'desc') // order by tanggal
            ->addTableClass('table table-row-dashed gy-5 dataTable no-footer fw-semibold fs-5')
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
            Column::make('id')->visible(false)->searchable(false),
            Column::computed('aksi')
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->width(10)
                ->addClass('text-center'),
            Column::make('Jenis')
                ->title('Jenis')
                ->searchable(true)
                ->addClass('text-center'),
            Column::make('Nama')
                ->title('Nama Supplier / Pelanggan')
                ->searchable(true)
                ->addClass('text-center'),
            Column::make('TglNota')
                ->title('Tanggal Transaksi')
                ->searchable(true)
                ->addClass('text-center'),
            Column::make('Diskon')
                ->title('Diskon (%)')
                ->searchable(true)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Report_' . date('YmdHis');
    }
}
