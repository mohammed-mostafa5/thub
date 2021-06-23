<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $table = 'customer_donations';

    protected $fillable = [
        'customer_id',
        'pickup_date',
        'status',
    ];
}
