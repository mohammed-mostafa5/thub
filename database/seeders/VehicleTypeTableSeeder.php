<?php

namespace Database\Seeders;

use App\Models\VehicleType;
use Illuminate\Database\Seeder;

class VehicleTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicleTypes = [
            [
                'en' => [
                    'text' => 'Type 1',
                ],
                'ar' => [
                    'text' => 'Type 1',
                ],
            ],
            [
                'en' => [
                    'text' => 'Type 2',
                ],
                'ar' => [
                    'text' => 'Type 2',
                ],
            ],
            [
                'en' => [
                    'text' => 'Type 3',
                ],
                'ar' => [
                    'text' => 'Type 3',
                ],
            ],

        ];


        foreach ($vehicleTypes as $vehicleType) {
            VehicleType::create($vehicleType);
        }
    }
}
