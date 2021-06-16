<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Option
 * @package App\Models
 * @version April 20, 2021, 9:38 am UTC
 *
 * @property integer $min_model_year
 */
class Option extends Model
{
    use SoftDeletes;


    public $table = 'options';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'min_model_year',
        'cap_max_free_cancellation',
        'towing_max_free_cancellation',
        'cap_request_fees',
        'towing_request_fees',
        'towing_min_balance',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'min_model_year' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'min_model_year'                => 'required',
        'cap_max_free_cancellation'     => 'required',
        'towing_max_free_cancellation'  => 'required',
        'cap_request_fees'              => 'required',
        'towing_request_fees'           => 'required',
        'towing_min_balance'            => 'required',
    ];
}
