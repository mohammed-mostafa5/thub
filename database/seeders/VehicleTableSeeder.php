<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use App\Models\DriverVehicle;
use Illuminate\Database\Seeder;

class VehicleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicles = [
            [
                'company_id' => 1,
                'service_id' => 1,
                'brand_id' => 1,
                'model_id' => 1,
                'color_id' => 1,
                'vehicle_type_id' => 1,
                'model_year' => 2018,
                'engine_serial_number' => 891989818198118,
                'chassis_number' => 9819819819818,
                'license_plate' => 'أ س د 55',
                'front_vehicle_license' => 'image.jpg',
                'back_vehicle_license' => 'image.jpg',
                'technical_report' => 'image.jpg',
            ],
            [
                'company_id' => 1,
                'service_id' => 1,
                'brand_id' => 1,
                'model_id' => 1,
                'color_id' => 2,
                'vehicle_type_id' => 1,
                'model_year' => 2018,
                'engine_serial_number' => 891989855198118,
                'chassis_number' => 98198158419818,
                'license_plate' => 'ف ه د 30',
                'front_vehicle_license' => 'image.jpg',
                'back_vehicle_license' => 'image.jpg',
                'technical_report' => 'image.jpg',
            ],
            [
                'company_id' => 1,
                'service_id' => 1,
                'brand_id' => 1,
                'model_id' => 1,
                'color_id' => 3,
                'vehicle_type_id' => 1,
                'model_year' => 2018,
                'engine_serial_number' => 891958589855198118,
                'chassis_number' => 981981575819818,
                'license_plate' => 'ن م س 40',
                'front_vehicle_license' => 'image.jpg',
                'back_vehicle_license' => 'image.jpg',
                'technical_report' => 'image.jpg',
            ],


        ];


        foreach ($vehicles as $vehicle) {
            Vehicle::create($vehicle);
        }

        $vehicle_drivers = [
            [
                'company_id' => 1,
                'vehicle_id' => 1,
                'driver_id' => 1,
            ],
            [
                'company_id' => null,
                'vehicle_id' => 3,
                'driver_id' => 1,
            ],
            [
                'company_id' => null,
                'vehicle_id' => 2,
                'driver_id' => 2,
            ],
        ];

        foreach ($vehicle_drivers as $vehicle_driver) {
            DriverVehicle::create($vehicle_driver);
        }
    }
}
