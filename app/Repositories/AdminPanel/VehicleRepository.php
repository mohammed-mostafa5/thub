<?php

namespace App\Repositories\AdminPanel;

use App\Models\Vehicle;
use App\Repositories\BaseRepository;

/**
 * Class vehicleRepository
 * @package App\Repositories\AdminPanel
 * @version April 5, 2021, 2:42 pm UTC
 */

class VehicleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'brand',
        'model',
        'vehicle_license',
        'license_plate',
        'technical_report',
        'company_id'
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
        return Vehicle::class;
    }
}
