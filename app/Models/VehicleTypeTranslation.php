<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class VehicleTypeTranslation extends Model
{
    protected $table = 'vehicle_type_translations';

    protected $fillable = ['text'];

    public $timestamps = false;
}
