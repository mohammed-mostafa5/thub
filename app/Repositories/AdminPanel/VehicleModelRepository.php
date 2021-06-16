<?php

namespace App\Repositories\AdminPanel;

use App\Models\VehicleModel;
use App\Repositories\BaseRepository;

/**
 * Class VehicleModelRepository
 * @package App\Repositories\AdminPanel
 * @version April 15, 2021, 9:20 am UTC
*/

class VehicleModelRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'brand_id',
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
        return VehicleModel::class;
    }
}
