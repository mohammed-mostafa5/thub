<?php

namespace App\Repositories\AdminPanel;

use App\Models\Reward;
use App\Repositories\BaseRepository;

/**
 * Class RewardRepository
 * @package App\Repositories\AdminPanel
 * @version May 31, 2021, 11:56 am UTC
*/

class RewardRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'brief',
        'description',
        'discount_type',
        'discount_value',
        'discount_to',
        'trip_count',
        'start_at',
        'end_at',
        'photo',
        'logo',
        'code'
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
        return Reward::class;
    }
}
