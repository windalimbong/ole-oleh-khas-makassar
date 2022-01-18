<?php

namespace App\DataTables;

use App\Models\TransaksiUser;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class HistoryTransaksiDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                $action = '<button type="button" class="waves-effect btn btn-sm btn-danger" onclick="actionhistory(\'' . 'hapus' . '\',\'' . $data->id . '\')">
                <i class="material-icons" style="color:white;">clear</i>
                </button>';
                return $action;
            })
            ->addColumn('id_transaksi', function ($data) {
                return $data->transaksiuser->nama;
            })
            ->addColumn('created_at', function ($data) {
                return Carbon::parse($data->created_at)->translatedFormat('l, d F Y');
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\TransaksiUser $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(TransaksiUser $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('historytransaksidatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->dom('Bfrtip')
                    ->orderBy(0, 'desc')
                    ->autoWidth(false);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id' => ['title' => 'No', 'orderable' => true, 'searchable' => true, 'render' => function () {
                return 'function(data,type,fullData,meta){return meta.settings._iDisplayStart+meta.row+1;}';
            }],
            Column::make('id_transaksi')->title('Transaksi'),
            Column::make('jumlah')->title('Jumlah'),
            Column::make('total_harga')->title('Total Harga'),
            Column::make('created_at')->title('Tanggal Pemesanan'),
            Column::computed('action')
                ->exportable(FALSE)
                ->printable(FALSE)
                ->width(150)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'HistoryTransaksi_' . date('YmdHis');
    }
}
