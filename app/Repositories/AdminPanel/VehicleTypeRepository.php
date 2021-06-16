<?php

namespace App\Repositories\AdminPanel;

use App\Models\VehicleType;
use App\Repositories\BaseRepository;

/**
 * Class VehicleTypeRepository
 * @package App\Repositories\AdminPanel
 * @version April 15, 2021, 9:25 am UTC
*/

class VehicleTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
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
        return VehicleType::class;
    }
}
