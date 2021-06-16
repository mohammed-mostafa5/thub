<?php

namespace App\Models;

use App\Helpers\ImageUploaderTrait;
use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Reward
 * @package App\Models
 * @version May 31, 2021, 11:56 am UTC
 *
 * @property string $title
 * @property string $brief
 * @property string $description
 * @property integer $discount_type
 * @property string $discount_value
 * @property string $discount_to
 * @property integer $trip_count
 * @property string $start_at
 * @property string $end_at
 * @property string $photo
 * @property string $logo
 * @property string $code
 */
class Reward extends Model
{
    use SoftDeletes, Translatable, ImageUploaderTrait;


    public $table = 'rewards';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'brief',
        'description',
        'discount_type', // ['1' => 'Percent', '2' => 'Cash', '3' => 'Code']
        'discount_value',
        'discount_to', // ['1' => 'All', '2' => 'Driver', '3' => 'Customer']
        'trip_count',
        'start_at',
        'end_at',
        'photo',
        'logo',
        'code'
    ];


    public $translatedAttributes = ['title', 'brief', 'description'];

    public static function rules()
    {
        $languages = array_keys(config('langs'));

        foreach ($languages as $language) {
            $rules[$language . '.title'] = 'required|string|min:3|max:191';
            $rules[$language . '.brief'] = 'required|string|min:3|max:191';
            $rules[$language . '.description'] = 'required|string';
        }

        $rules['discount_type'] = 'required|in:1,2,3';
        $rules['discount_value'] = 'required|string|max:191';
        $rules['discount_to'] = 'required|in:1,2,3';
        $rules['trip_count'] = 'nullable';
        $rules['start_at'] = 'nullable';
        $rules['end_at'] = 'nullable';
        $rules['photo'] = 'required|image|mimes:jpeg,jpg,png';
        $rules['logo'] = 'required|image|mimes:jpeg,jpg,png';
        $rules['code'] = 'nullable';


        return $rules;
    }

    protected $appends = [
        'photo_original_path',
        'photo_thumbnail_path',
        'logo_original_path',
        'logo_thumbnail_path',
    ];

    ################################# Functions #####################################

    // Photo //
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
    // Photo //


    // Logo //
    public function setLogoAttribute($file)
    {
        try {
            if ($file) {

                $fileName = $this->createFileName($file);

                $this->originalImage($file, $fileName);

                $this->thumbImage($file, $fileName, 190, 275);

                $this->attributes['logo'] = $fileName;
            }
        } catch (\Throwable $th) {
            $this->attributes['logo'] = $file;
        }
    }


    public function getLogoOriginalPathAttribute()
    {
        return $this->photo ? asset('uploads/images/original/' . $this->photo) : null;
    }

    public function getLogoThumbnailPathAttribute()
    {
        return $this->photo ? asset('uploads/images/thumbnail/' . $this->photo) : null;
    }
    // Logo //


    ################################### Scopes #####################################

    public function scopeDriver($query)
    {
        return $query->where('discount_to', 1)->orWhere('discount_to', 2);
    }

    public function scopeCustomer($query)
    {
        return $query->where('discount_to', 1)->orWhere('discount_to', 3);
    }
}
