<?php

namespace App\Repositories;

use App\Models\CalonSiswa;
use App\Repositories\BaseRepository;

/**
 * Class CalonSiswaRepository
 * @package App\Repositories
 * @version February 9, 2021, 7:44 am UTC
*/

class CalonSiswaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CalonSiswa::class;
    }
}
