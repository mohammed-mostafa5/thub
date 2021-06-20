<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name'              => 'Ahmed',
                'phone'             => '01077777777',
                'address'           => 'Egypt, Cairo',
            ],
            [
                'name'              => 'Nabil',
                'phone'             => '01055555555',
                'address'           => 'Egypt, Cairo',
            ],
        ]);
    }
}
