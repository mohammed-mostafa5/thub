<?php

namespace App\Repositories\AdminPanel;

use App\Models\ProductSize;
use App\Repositories\BaseRepository;

/**
 * Class ProductSizeRepository
 * @package App\Repositories\AdminPanel
 * @version June 30, 2021, 1:47 pm UTC
*/

class ProductSizeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'size'
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
        return ProductSize::class;
    }
}
