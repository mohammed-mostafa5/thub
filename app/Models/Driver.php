<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Driver extends Model
{
    use Notifiable,  SoftDeletes;


    public $table = 'drivers';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'address',
    ];

    public static $rules = [
        'name'                          => 'required|string|max:191',
        'address'                       => 'required|string|max:191',

    ];


    ########################### Relations #########################

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
}
