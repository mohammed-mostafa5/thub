<?php

namespace App\Repositories\AdminPanel;

use App\Models\Service;
use App\Repositories\BaseRepository;

/**
 * Class ServiceRepository
 * @package App\Repositories\AdminPanel
 * @version March 29, 2021, 12:43 pm UTC
*/

class ServiceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'parent_id',
        'has_children',
        'status'
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
        return Service::class;
    }
}
