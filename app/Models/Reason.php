<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Reason
 * @package App\Models
 * @version June 2, 2021, 9:17 am UTC
 *
 * @property integer $type
 * @property integer $status
 */
class Reason extends Model
{
    use SoftDeletes, Translatable;


    public $table = 'reasons';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'type',
        'status'
    ];


    public $translatedAttributes = ['title'];

    public static function rules()
    {
        $languages = array_keys(config('langs'));

        foreach ($languages as $language) {
            $rules[$language . '.title'] = 'required|string|min:3|max:191';
        }

        $rules['type']      = 'required';
        $rules['status']    = 'required|in:0,1';

        return $rules;
    }



    ##################### Scopes ######################

    public function scopeCancelTrip($query)
    {
        return $query->where('type', 1);
    }

    public function scopeCancelRequest($query)
    {
        return $query->where('type', 2);
    }
}
