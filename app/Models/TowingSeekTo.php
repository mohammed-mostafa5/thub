<?php

namespace App\Models;

use App\Helpers\ImageUploaderTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TowingSeekTo extends Model
{
    use HasFactory, ImageUploaderTrait;

    public $table = 'seek_to';

    public $fillable = [
        'seek_id',
        'driver_id',
        'status', //0=>pending, 1=>confirm, 2=>reject
        'photo',
    ];

    ####################################### Relations #######################################

    public function driver()
    {
        return $this->belongsTo(Driver::class);
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
