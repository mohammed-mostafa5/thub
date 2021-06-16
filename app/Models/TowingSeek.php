<?php

namespace App\Models;

use App\Helpers\ImageUploaderTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class TowingSeek extends Model
{
    use HasFactory, SpatialTrait, ImageUploaderTrait;

    public $fillable = [
        'customer_id',
        'driver_id',
        'trip_id',
        'status', // 0 => in progress, 1 => pending, 2 => confirm, 3 => reject, 4 => cancel
        'reason_id',
        'photo',
    ];

    protected $spatialFields = ['from_location', 'to_location'];

    public static $rules = [
        'latitude_from'         => 'required',
        'longitude_from'        => 'required',
        'latitude_to'           => '',
        'longitude_to'          => '',
        'photo'                 => '',

    ];

    ####################################### Relations #######################################

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function drivers()
    {
        return $this->belongsToMany(Driver::class, 'seek_to', 'seek_id', 'driver_id')->withPivot('status');
    }


    ################################### Appends #####################################

    protected $appends = [
        'photo_original_path',
        'photo_thumbnail_path',
    ];

    // Photo
    public function setPhotoAttribute($file)
    {
        try {
            if ($file) {

                $fileName = $this->createFileName($file);

                $this->originalImage($file, $fileName);

                $this->thumbImage($file, $fileName, 190, 275);

                $this->attributes['photo'] = $fileName;
            }
        } catch (\Throwable $th) {
            $this->attributes['photo'] = $file;
        }
    }

    public function getPhotoOriginalPathAttribute()
    {
        return $this->photo ? asset('uploads/images/original/' . $this->photo) : null;
    }

    public function getPhotoThumbnailPathAttribute()
    {
        return $this->photo ? asset('uploads/images/thumbnail/' . $this->photo) : null;
    }
    // Photo
}
