<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::create([
            'name'              => 'Ahmed',
            'phone'             => '01077777777',
            'address'           => 'Egypt, Cairo',
            'photo'             => 'photo.jpg',
            'email'             => 'customer@email.com',
            'email_verified_at' => now(),
        ]);

        Customer::create([
            'name'              => 'Nabil',
            'phone'             => '01055555555',
            'address'           => 'Egypt, Cairo',
            'photo'             => 'photo.jpg',
            'email'             => 'customer2@email.com',
            'email_verified_at' => now(),
        ]);

        Customer::factory()->count(10)->create();
    }
}
