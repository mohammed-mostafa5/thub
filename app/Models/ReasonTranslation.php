<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ReasonTranslation extends Model
{
    protected $table = 'reason_translations';

    protected $fillable = ['title'];

    public $timestamps = false;
}
