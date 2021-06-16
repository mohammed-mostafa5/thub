<?php

namespace App\Models;

use App\Helpers\ImageUploaderTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Driver extends Authenticatable implements MustVerifyEmail, JWTSubject
{
    use Notifiable,  SoftDeletes, ImageUploaderTrait;


    public $table = 'drivers';


    protected $dates = ['deleted_at'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public $fillable = [
        'name',
        'phone',
        'photo',
        'address',
        'email',
        'email_verified_at',
        'verify_code',
        'status', // 0 => Inactive, 1 => Active
    ];

    public static $rules = [
        'name'                          => 'required|string|max:191',
        'address'                       => 'required|string|max:191',
        'phone'                         => 'required|string|max:191|unique:drivers',
        'photo'                         => 'required|image|mimes:jpeg,jpg,png',
        'email'                         => 'nullable|email|max:191|unique:drivers',
        'medical_report'                => 'required|image|mimes:jpeg,jpg,png',
        'front_identity_card'           => 'required|image|mimes:jpeg,jpg,png',
        'back_identity_card'            => 'required|image|mimes:jpeg,jpg,png',
        'police_clearance_certificate'  => 'required|image|mimes:jpeg,jpg,png',
        'front_driver_licence'          => 'required|image|mimes:jpeg,jpg,png',
        'back_driver_licence'           => 'required|image|mimes:jpeg,jpg,png',
        'g-recaptcha-response'          => ''
        // 'g-recaptcha-response'   => 'required'
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


    ########################### Relations ###########################



    ################################### Scopes #####################################


    ################################### Appends #####################################

    protected $appends = [
        'photo_original_path',
        'photo_thumbnail_path',
        'private_channel_pusher',

    ];

    // Photo
    public function getPhotoOriginalPathAttribute()
    {
        return $this->photo ? asset('uploads/images/original/' . $this->photo) : null;
    }

    public function getPhotoThumbnailPathAttribute()
    {
        return $this->photo ? asset('uploads/images/thumbnail/' . $this->photo) : null;
    }
    // Photo

    // Private Channel Pusher
    public function getPrivateChannelPusherAttribute()
    {
        return 'Driver-' . $this->id;
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

    ################################## Relations #####################################

    public function rates()
    {
        return $this->hasMany(DriverRate::class);
    }
}
