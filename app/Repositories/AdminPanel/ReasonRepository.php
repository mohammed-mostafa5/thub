<?php

namespace App\Repositories\AdminPanel;

use App\Models\Reason;
use App\Repositories\BaseRepository;

/**
 * Class ReasonRepository
 * @package App\Repositories\AdminPanel
 * @version June 2, 2021, 9:17 am UTC
*/

class ReasonRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type',
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
        return Reason::class;
    }
}
