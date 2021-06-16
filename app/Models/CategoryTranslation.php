<?php

namespace App\Models;

use Eloquent as Model;

class CategoryTranslation extends Model
{
    protected $table = 'category_translations';

    protected $fillable = ['text', 'brief'];

    public $timestamps = false;
}
