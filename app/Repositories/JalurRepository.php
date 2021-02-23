<?php

namespace App\Repositories;

use App\Models\Jalur;
use App\Repositories\BaseRepository;

/**
 * Class JalurRepository
 * @package App\Repositories
 * @version February 9, 2021, 7:46 am UTC
*/

class JalurRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'jalur'
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
        return Jalur::class;
    }
}
