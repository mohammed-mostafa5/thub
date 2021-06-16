<?php

namespace App\Models;

use App\Helpers\ImageUploaderTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Company extends Authenticatable implements MustVerifyEmail, JWTSubject
{
    use Notifiable,  SoftDeletes, ImageUploaderTrait;


    public $table = 'companies';


    protected $dates = ['deleted_at'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $fillable = [
        'company_name',
        'name',
        'phone',
        'email',
        'email_verified_at',
        'password',
        'logo',
        'address',
        'commercial_register',
        'establishment_card',
        'tax_identification',
        'identity_card',
        'verify_code',
        'status',      // 0 => in progress, 1 => Pending, 2 => Approved, 3 => Rejected, 4 => Deactivate
    ];


    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:191',
        'company_name' => 'required|string|max:191',
        'phone' => 'required|string|max:191',
        'email' => 'nullable|email|max:191|unique:companies',
        'password' => 'required|min:6|max:191',
        'address' => 'required|string|max:191',
        'logo' => 'required|image|mimes:jpeg,jpg,png',
        'commercial_register' => 'required|image|mimes:jpeg,jpg,png',
        'establishment_card' => 'required|image|mimes:jpeg,jpg,png',
        'tax_identification' => 'required|image|mimes:jpeg,jpg,png',
        'identity_card' => 'required|image|mimes:jpeg,jpg,png',
        'g-recaptcha-response'   => ''
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

    protected $appends = [
        'logo_original_path',
        'logo_thumbnail_path',
        'commercial_register_original_path',
        'commercial_register_thumbnail_path',
        'tax_identification_original_path',
        'tax_identification_thumbnail_path',
        'identity_card_original_path',
        'identity_card_thumbnail_path',
        'establishment_card_original_path',
        'establishment_card_thumbnail_path'
    ];

    //Logo
    public function getLogoOriginalPathAttribute()
    {
        return $this->logo ? asset('uploads/images/original/' . $this->logo) : null;
    }

    public function getLogoThumbnailPathAttribute()
    {
        return $this->logo ? asset('uploads/images/thumbnail/' . $this->logo) : null;
    }
    // Logo

    // Commercial Register
    public function getCommercialRegisterOriginalPathAttribute()
    {
        return $this->commercial_register ? asset('uploads/images/original/' . $this->commercial_register) : null;
    }

    public function getCommercialRegisterThumbnailPathAttribute()
    {
        return $this->commercial_register ? asset('uploads/images/thumbnail/' . $this->commercial_register) : null;
    }
    // Commercial Register

    // Tax Identification
    public function getTaxIdentificationOriginalPathAttribute()
    {
        return $this->tax_identification ? asset('uploads/images/original/' . $this->tax_identification) : null;
    }

    public function getTaxIdentificationThumbnailPathAttribute()
    {
        return $this->tax_identification ? asset('uploads/images/thumbnail/' . $this->tax_identification) : null;
    }
    // Tax Identification

    // Identity Card
    public function getIdentityCardOriginalPathAttribute()
    {
        return $this->identity_card ? asset('uploads/images/original/' . $this->identity_card) : null;
    }

    public function getIdentityCardThumbnailPathAttribute()
    {
        return $this->identity_card ? asset('uploads/images/thumbnail/' . $this->identity_card) : null;
    }
    // Identity Card

    // establishment Card
    public function getEstablishmentCardOriginalPathAttribute()
    {
        return $this->establishment_card ? asset('uploads/images/original/' . $this->establishment_card) : null;
    }

    public function getEstablishmentCardThumbnailPathAttribute()
    {
        return $this->establishment_card ? asset('uploads/images/thumbnail/' . $this->establishment_card) : null;
    }
    // establishment Card

    ################################# Functions #####################################

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

    public function setCommercialRegisterAttribute($file)
    {
        try {
            if ($file) {

                $fileName = $this->createFileName($file);

                $this->originalImage($file, $fileName);

                $this->thumbImage($file, $fileName, 190, 275);

                $this->attributes['commercial_register'] = $fileName;
            }
        } catch (\Throwable $th) {
            $this->attributes['commercial_register'] = $file;
        }
    }

    public function setTaxIdentificationAttribute($file)
    {
        try {
            if ($file) {

                $fileName = $this->createFileName($file);

                $this->originalImage($file, $fileName);

                $this->thumbImage($file, $fileName, 190, 275);

                $this->attributes['tax_identification'] = $fileName;
            }
        } catch (\Throwable $th) {
            $this->attributes['tax_identification'] = $file;
        }
    }

    public function setIdentityCardAttribute($file)
    {
        try {
            if ($file) {

                $fileName = $this->createFileName($file);

                $this->originalImage($file, $fileName);

                $this->thumbImage($file, $fileName, 190, 275);

                $this->attributes['identity_card'] = $fileName;
            }
        } catch (\Throwable $th) {
            $this->attributes['identity_card'] = $file;
        }
    }

    public function setEstablishmentCardAttribute($file)
    {
        try {
            if ($file) {

                $fileName = $this->createFileName($file);

                $this->originalImage($file, $fileName);

                $this->thumbImage($file, $fileName, 190, 275);

                $this->attributes['establishment_card'] = $fileName;
            }
        } catch (\Throwable $th) {
            $this->attributes['establishment_card'] = $file;
        }
    }

    // public function getStatusAttribute()
    // {
    //     return $this->attributes['status'] ? 'Active' : 'Inactive';
    // }

    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = bcrypt($value);
        }
    }
}
