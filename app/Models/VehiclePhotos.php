<?php

namespace App\Models;

use App\Helpers\ImageUploaderTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehiclePhotos extends Model
{
    use HasFactory, ImageUploaderTrait;

    public $table = 'vehicle_photos';

    public $fillable = [
        'vehicle_id',
        'photo',
        'company_id',
    ];



    ################################# Functions #####################################

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

    public function getPhotoAttribute($val)
    {
        return $val ? asset('uploads/images/original') . '/' . $val : null;
    }
}
