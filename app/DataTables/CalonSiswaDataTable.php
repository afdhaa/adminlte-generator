<?php

namespace App\DataTables;

use App\Models\CalonSiswa;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class CalonSiswaDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'calon_siswas.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CalonSiswa $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CalonSiswa $model)
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
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'nisn',
            'nama_lengkap',
            'tanggal_lahir',
            'tempat_lahir',
            'anak_ke',
            'jml_saudara',
            'hp_siswa',
            'nik',
            'alamat',
            'rt',
            'rw',
            'provinsi',
            'kota',
            'kecamatan',
            'desa',
            'nama_ayah',
            'pekerjaan_ayah',
            'nama_ibu',
            'pekerjaan_ibu',
            'nama_wali',
            'pekerjaan_wali',
            'hp_wali',
            'asal_smp',
            'kota_smp',
            'mat_s1',
            'mat_s2',
            'mat_s3',
            'mat_s4',
            'mat_s5',
            'rt_mat',
            'inggris_s1',
            'inggris_s2',
            'inggris_s3',
            'inggris_s4',
            'inggris_s5',
            'rt_inggris',
            'indonesia_s1',
            'indonesia_s2',
            'indonesia_s3',
            'indonesia_s4',
            'indonesia_s5',
            'rt_indonesia',
            'ipa_s1',
            'ipa_s2',
            'ipa_s3',
            'ipa_s4',
            'ipa_s5',
            'rt_ipa',
            'ips_s1',
            'ips_s2',
            'ips_s3',
            'ips_s4',
            'ips_s5',
            'rt_ips',
            'password',
            'email'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'calon_siswas_datatable_' . time();
    }
}
