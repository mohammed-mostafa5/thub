<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Garage
 * @package App\Models
 * @version June 14, 2021, 10:07 am UTC
 *
 * @property string $garage_name
 * @property string $owner_name
 * @property string $mobile
 * @property string $commercial_registration_number
 * @property string $address
 * @property string $location
 * @property integer $status
 */
class Garage extends Model
{
    use SoftDeletes;


    public $table = 'garages';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'garage_name',
        'owner_name',
        'mobile',
        'commercial_registration_number',
        'address',
        'location',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'garage_name' => 'string',
        'owner_name' => 'string',
        'mobile' => 'string',
        'commercial_registration_number' => 'string',
        'address' => 'string',
        'location' => 'string',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'garage_name' => 'required|string|max:191',
        'owner_name' => 'required|string|max:191',
        'mobile' => 'required|string|max:191',
        'commercial_registration_number' => 'required|string|max:191',
        'address' => 'required|string|max:191',
        'location' => 'required',
        'status' => 'required'
    ];

    
}
