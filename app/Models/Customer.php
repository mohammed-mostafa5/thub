<?php

namespace App\Models;

use App\Helpers\ImageUploaderTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Customer extends Authenticatable implements MustVerifyEmail, JWTSubject
{
    use Notifiable,  SoftDeletes, ImageUploaderTrait, HasFactory;


    public $table = 'customers';


    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // 'password',
        'remember_token',
    ];

    public $fillable = [
        'name',
        'phone',
        'address',
        'email',
        'address',
        'email_verified_at',
        'photo',
        'verify_code',
        'status'
    ];


    public static $rules = [
        'name' => 'required|string|max:191',
        'phone' => 'required|string|max:191',
        'address' => 'nullable|string|max:191',
        'email' => 'nullable|email|max:191|unique:customers',
        'photo' => 'required|image|mimes:jpeg,jpg,png',
        'g-recaptcha-response'   => ''
    ];

    public static $registerRules = [
        'name' => 'required|string|max:191',
        'phone' => 'required|string|max:191|unique:customers',
    ];

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    ################################### Appends #####################################

    protected $appends = ['photo_original_path', 'photo_thumbnail_path', 'private_channel_pusher', 'rating_avg'];

    public function getPhotoOriginalPathAttribute()
    {
        return $this->photo ? asset('uploads/images/original/' . $this->photo) : null;
    }

    public function getPhotoThumbnailPathAttribute()
    {
        return $this->photo ? asset('uploads/images/thumbnail/' . $this->photo) : null;
    }

    // Private Channel Pusher
    public function getPrivateChannelPusherAttribute()
    {
        return 'Customer-' . $this->id;
    }
    // Private Channel Pusher

    public function getRatingAvgAttribute()
    {
        return $this->rates()->avg('rate');
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

    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    public function rates()
    {
        return $this->hasMany(CustomerRate::class);
    }
}
