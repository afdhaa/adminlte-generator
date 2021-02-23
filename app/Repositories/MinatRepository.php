<?php

namespace App\Repositories;

use App\Models\Minat;
use App\Repositories\BaseRepository;

/**
 * Class MinatRepository
 * @package App\Repositories
 * @version February 9, 2021, 7:47 am UTC
*/

class MinatRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'minat'
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
        return Minat::class;
    }
}
