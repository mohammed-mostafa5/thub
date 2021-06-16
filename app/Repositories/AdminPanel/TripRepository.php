<?php

namespace App\Repositories\AdminPanel;

use App\Models\Trip;
use App\Repositories\BaseRepository;

/**
 * Class TripRepository
 * @package App\Repositories\AdminPanel
 * @version April 6, 2021, 12:48 pm UTC
*/

class TripRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'customer_id',
        'driver_id',
        'from_location',
        'to_location',
        'from_time',
        'to_time',
        'rate',
        'duration',
        'distance',
        'customer_name',
        'customer_phone'
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
        return Trip::class;
    }
}
