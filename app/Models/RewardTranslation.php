<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class RewardTranslation extends Model
{
    protected $table = 'reward_translations';

    protected $fillable = ['title', 'brief', 'description'];

    public $timestamps = false;
}
