<?php

namespace App\Repositories;

use App\Models\JalurPartisipasi;
use App\Repositories\BaseRepository;

/**
 * Class JalurPartisipasiRepository
 * @package App\Repositories
 * @version February 23, 2021, 7:53 am UTC
*/

class JalurPartisipasiRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'participate'
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
        return JalurPartisipasi::class;
    }
}
