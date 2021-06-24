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
        'name',
        'address',
        'housing_type',
        'house_number',
        'state_id',
        'building_number',
        'floor_number',
        'apartment_number',
        'pickup_date',
        'status',  // 0 => New, 1 => Picked up, 2 => Delevered
    ];


    ############################### Relations ##################################

    public function photos()
    {
        return $this->hasMany(DonationPhoto::class);
    }
    public function types()
    {
        return $this->hasMany(TypeOfDonation::class);
    }
}
