<?php

namespace App\Repositories;

use App\Models\SoalTest;
use App\Repositories\BaseRepository;

/**
 * Class SoalTestRepository
 * @package App\Repositories
 * @version February 9, 2021, 7:49 am UTC
*/

class SoalTestRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'soal',
        'pilihan_a',
        'pilihan_b',
        'pilihan_c',
        'pilihan_d',
        'jawaban',
        'image'
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
        return SoalTest::class;
    }
}
