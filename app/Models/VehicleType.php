<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class VehicleType
 * @package App\Models
 * @version April 15, 2021, 9:25 am UTC
 *
 */
class VehicleType extends Model
{
    use SoftDeletes, Translatable;


    public $table = 'vehicle_types';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'id'
    ];

    public $translatedAttributes = ['text'];

    public static function rules()
    {
        $languages = array_keys(config('langs'));

        foreach ($languages as $language) {
            $rules[$language . '.text'] = 'required|string|max:191';
        }

        return $rules;
    }
}
