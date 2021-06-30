<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class ProductSize
 * @package App\Models
 * @version June 30, 2021, 1:47 pm UTC
 *
 * @property integer $product_id
 * @property string $size
 */
class ProductSize extends Model
{
    use SoftDeletes, Translatable;


    public $table = 'product_sizes';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'product_id',
        'size'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'size' => 'string'
    ];


    public $translatedAttributes = ['size'];

    public static function rules()
    {
        $languages = array_keys(config('langs'));

        foreach ($languages as $language) {
            $rules[$language . '.size']         = 'required|string|max:191';
        }

        return $rules;
    }
}
