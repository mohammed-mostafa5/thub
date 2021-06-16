<?php

namespace App\Models;

use App\Helpers\ImageUploaderTrait;
use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Service
 * @package App\Models
 * @version March 29, 2021, 12:43 pm UTC
 *
 * @property integer $parent_id
 * @property integer $has_children
 * @property integer $status
 */
class Service extends Model
{
    use SoftDeletes, Translatable, ImageUploaderTrait;


    public $table = 'services';

    protected $dates = ['deleted_at'];

    public $translatedAttributes = ['text', 'description'];

    public $fillable = [
        'parent_id',
        'has_children',
        'status',
        'photo'
    ];


    public static function rules()
    {
        $languages = array_keys(config('langs'));

        foreach ($languages as $language) {
            $rules[$language . '.text'] = 'required|string|max:191';
            $rules[$language . '.description'] = 'required|string|max:255';
        }

        $rules['status'] = 'required|in:0,1';
        $rules['has_children'] = 'required|in:0,1';
        $rules['photo'] = 'required|image|mimes:jpeg,jpg,png';

        return $rules;
    }


    ################################# Relations #####################################

    public function mainService()
    {
        return $this->belongsTo('App\Models\Service', 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\Service', 'parent_id', 'id');
    }


    ################################### Appends #####################################

    protected $appends = ['photo_original_path', 'photo_thumbnail_path'];

    public function getPhotoOriginalPathAttribute()
    {
        return $this->photo ? asset('uploads/images/original/' . $this->photo) : null;
    }

    public function getPhotoThumbnailPathAttribute()
    {
        return $this->photo ? asset('uploads/images/thumbnail/' . $this->photo) : null;
    }


    ################################### Scopes #####################################

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeParent($query)
    {
        return $query->where('parent_id', null);
    }

    public function scopeChild($query)
    {
        return $query->where('parent_id', '!=', null);
    }

    ############################## Accessors & Mutators #############################


    public function getStatusNameAttribute()
    {
        return $this->attributes['status'] ? 'Active' : 'Inactive';
    }

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
}
