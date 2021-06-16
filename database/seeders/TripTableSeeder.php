<?php

namespace Database\Seeders;

use App\Models\Trip;

use Illuminate\Database\Seeder;

class TripTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $trips = [
            [
                'customer_id'    => 1,
                'driver_id'      => 2,
                'vehicle_id'      => 1,
                // 'from_location'  => 'from location',
                // 'to_location'    => 'to location',
                'from_time'      => now(),
                'to_time'        => now()->addHours(1),
                'rate'           => 3,
                'duration'       => 40,
                'distance'       => 10,
                'price'          => 50,
                'customer_name'  => 'Ahmed',
                'customer_phone' => '01308286548',
            ],
            [
                'customer_id'    => 2,
                'driver_id'      => 1,
                'vehicle_id'      => 1,
                // 'from_location'  => 'from location',
                // 'to_location'    => 'to location',
                'from_time'      => now(),
                'to_time'        => now()->addHours(1),
                'rate'           => 4,
                'duration'       => 20,
                'distance'       => 30,
                'price'          => 30,
                'customer_name'  => 'Manar',
                'customer_phone' => '01308286548',
            ],
            [
                'customer_id'    => 1,
                'driver_id'      => 2,
                'vehicle_id'     => 1,
                // 'from_location'  => 'from location',
                // 'to_location'    => 'to location',
                'from_time'      => now(),
                'to_time'        => now()->addHours(1),
                'rate'           => 3,
                'duration'       => 30,
                'distance'       => 25,
                'price'          => 40,
                'customer_name'  => 'Ahmed',
                'customer_phone' => '01308286548',
            ],

        ];


        foreach ($trips as $trip) {
            Trip::create($trip);
        }
    }
}
