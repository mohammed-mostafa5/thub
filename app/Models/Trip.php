<?php

namespace App\Models;

use Eloquent as Model;
use App\Models\Vehicle;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Trip
 * @package App\Models
 * @version April 6, 2021, 12:48 pm UTC
 *
 * @property integer $customer_id
 * @property integer $driver_id
 * @property string $from_location
 * @property string $to_location
 * @property string $from_time
 * @property string $to_time
 * @property string $rate
 * @property string $duration
 * @property string $distance
 * @property string $customer_name
 * @property string $customer_phone
 */
class Trip extends Model
{
    use SoftDeletes, SpatialTrait;


    public $table = 'trips';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'customer_id',
        'driver_id',
        'vehicle_id',
        'from_location',
        'to_location',
        'from_time',
        'to_time',
        'rate',
        'duration',
        'distance',
        'price',
        'customer_name',
        'customer_phone',
        'status',
        'reason_id',
        'cancellation_notes',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'customer_id' => 'integer',
        'driver_id' => 'integer',
        'vehicle_id' => 'integer',
        'from_location' => 'string',
        'to_location' => 'string',
        'from_time' => 'string',
        'to_time' => 'string',
        'rate' => 'string',
        'duration' => 'string',
        'distance' => 'string',
        'customer_name' => 'string',
        'customer_phone' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'customer_id' => 'required',
        'driver_id' => 'required',
        'vehicle_id' => 'required',
        'from_location' => 'required',
        'to_location' => 'required',
        'from_time' => 'required',
        'to_time' => 'required',
        'rate' => 'required|string|max:191',
        'duration' => 'required|string|max:191',
        'distance' => 'required|string|max:191',
        'price' => 'required|string|max:191',
        'customer_name' => 'required|string|max:191',
        'customer_phone' => 'required|string|max:191'
    ];

    protected $spatialFields = ['from_location', 'to_location'];

    ############################ Relations ######################

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
