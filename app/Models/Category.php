<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Category
 * @package App\Models
 * @version June 14, 2021, 8:14 am UTC
 *
 * @property integer $service_id
 * @property string $text
 * @property string $brief
 * @property integer $status
 */
class Category extends Model
{
    use SoftDeletes, Translatable;


    public $table = 'categories';


    protected $dates = ['deleted_at'];

    public $translatedAttributes = ['text', 'brief'];

    public $fillable = ['service_id', 'status'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'service_id' => 'integer',
        'text' => 'string',
        'brief' => 'string',
        'status' => 'integer'
    ];


    public static function rules()
    {
        $languages = array_keys(config('langs'));

        foreach ($languages as $language) {
            $rules[$language . '.text'] = 'required|string|max:191';
            $rules[$language . '.brief'] = 'required|string|max:191';
        }

        $rules['service_id'] = 'required';
        $rules['status'] = 'required|in:0,1';

        return $rules;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
