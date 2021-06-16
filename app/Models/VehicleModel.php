<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class VehicleModel
 * @package App\Models
 * @version April 15, 2021, 9:20 am UTC
 *
 * @property integer $brand_id
 * @property string $name
 */
class VehicleModel extends Model
{
    use SoftDeletes, Translatable;


    public $table = 'vehicle_models';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'brand_id',
    ];

    public $translatedAttributes = ['text'];

    public static function rules()
    {
        $languages = array_keys(config('langs'));

        foreach ($languages as $language) {
            $rules[$language . '.text'] = 'required|string|max:191';
        }

        // $rules['brand_id'] = 'required';

        return $rules;
    }


    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
