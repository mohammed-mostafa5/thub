<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class VehicleModelTranslation extends Model
{
    protected $table = 'vehicle_model_translations';

    protected $fillable = ['text'];

    public $timestamps = false;
}
