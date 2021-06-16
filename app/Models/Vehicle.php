<?php

namespace App\Models;

use Eloquent as Model;
use App\Models\Category;
use App\Helpers\ImageUploaderTrait;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class vehicle
 * @package App\Models
 * @version April 5, 2021, 2:42 pm UTC
 *
 * @property string $brand
 * @property string $model
 * @property string $vehicle_license
 * @property string $license_plate
 * @property string $technical_report
 * @property integer $company_id
 */
class Vehicle extends Model
{
    use SoftDeletes, ImageUploaderTrait;

    public $table = 'vehicles';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'category_id',
        'company_id',
        'service_id',
        'brand_id',
        'model_id',
        'color_id',
        'vehicle_type_id',
        'model_year',
        'engine_serial_number',
        'chassis_number',
        'license_plate',
        'front_vehicle_license',
        'back_vehicle_license',
        'technical_report',
        'status',
    ];

    public static $rules = [
        'company_id' => 'nullable',
        'brand_id' => 'required',
        'service_id' => 'required',
        'brand_id' => 'required',
        'model_id' => 'required',
        'color_id' => 'required',
        'vehicle_type_id' => 'required',
        'model_year' => 'required',
        'engine_serial_number' => 'required|unique:vehicles,engine_serial_number',
        'chassis_number' => 'required|unique:vehicles,chassis_number',
        'license_plate' => 'required|string|max:191|unique:vehicles,license_plate',
        'front_vehicle_license' => 'required|image|mimes:jpeg,jpg,png',
        'back_vehicle_license' => 'required|image|mimes:jpeg,jpg,png',
        'technical_report' => 'required|image|mimes:jpeg,jpg,png',
    ];


    ################################# Functions #####################################

    public function setFrontVehicleLicenseAttribute($file)
    {
        try {
            if ($file) {

                $fileName = $this->createFileName($file);

                $this->originalImage($file, $fileName);

                $this->thumbImage($file, $fileName, 190, 275);

                $this->attributes['front_vehicle_license'] = $fileName;
            }
        } catch (\Throwable $th) {
            $this->attributes['front_vehicle_license'] = $file;
        }
    }

    public function setBackVehicleLicenseAttribute($file)
    {
        try {
            if ($file) {

                $fileName = $this->createFileName($file);

                $this->originalImage($file, $fileName);

                $this->thumbImage($file, $fileName, 190, 275);

                $this->attributes['back_vehicle_license'] = $fileName;
            }
        } catch (\Throwable $th) {
            $this->attributes['back_vehicle_license'] = $file;
        }
    }

    public function setTechnicalReportAttribute($file)
    {
        try {
            if ($file) {

                $fileName = $this->createFileName($file);

                $this->originalImage($file, $fileName);

                $this->thumbImage($file, $fileName, 190, 275);

                $this->attributes['technical_report'] = $fileName;
            }
        } catch (\Throwable $th) {
            $this->attributes['technical_report'] = $file;
        }
    }


    public function getFrontVehicleLicenseAttribute($val)
    {
        return $val ? asset('uploads/images/original') . '/' . $val : null;
    }

    public function getBackVehicleLicenseAttribute($val)
    {
        return $val ? asset('uploads/images/original') . '/' . $val : null;
    }

    public function getTechnicalReportAttribute($val)
    {
        return $val ? asset('uploads/images/original') . '/' . $val : null;
    }


    ############################# Relations #############################

    public function photos()
    {
        return $this->hasMany(VehiclePhotos::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function model()
    {
        return $this->belongsTo(VehicleModel::class);
    }

    public function type()
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id', 'id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
