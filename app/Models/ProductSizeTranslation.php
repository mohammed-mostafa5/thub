<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProductSizeTranslation extends Model
{
    protected $table = 'product_size_translations';

    protected $fillable = ['size'];

    public $timestamps = false;
}
