<?php

namespace App\Repositories;

use App\Models\CalonSiswaMinat;
use App\Repositories\BaseRepository;

/**
 * Class CalonSiswaMinatRepository
 * @package App\Repositories
 * @version February 23, 2021, 8:16 am UTC
*/

class CalonSiswaMinatRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'calon_siswa_id',
        'minat_id'
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
        return CalonSiswaMinat::class;
    }
}
