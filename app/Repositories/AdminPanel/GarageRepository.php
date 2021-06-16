<?php

namespace App\Repositories\AdminPanel;

use App\Models\Garage;
use App\Repositories\BaseRepository;

/**
 * Class GarageRepository
 * @package App\Repositories\AdminPanel
 * @version June 14, 2021, 10:07 am UTC
*/

class GarageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'garage_name',
        'owner_name',
        'mobile',
        'commercial_registration_number',
        'address',
        'location',
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
        return Garage::class;
    }
}
