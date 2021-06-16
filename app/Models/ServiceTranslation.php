<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ServiceTranslation extends Model
{
    protected $table = 'service_translations';

    protected $fillable = ['text', 'description'];

    public $timestamps = false;
}
