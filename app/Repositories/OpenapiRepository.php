<?php

namespace App\Repositories;

use App\Models\Openapi;
use App\Repositories\BaseRepository;

/**
 * Class OpenapiRepository
 * @package App\Repositories
 * @version November 23, 2020, 5:52 pm UTC
*/

class OpenapiRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
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
        return Openapi::class;
    }
}
