<?php

namespace Database\Seeders;

use App\Models\Driver\Driver;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $drivers = [
            [
                'name' => 'driver_1',
                'email' => 'driver_1@gmail.com',
                'number' => '123456',
                'password' => Hash::make('abcd1234')
            ],
            [
                'name' => 'driver_2',
                'email' => 'driver_2@gmail.com',
                'number' => '123456',
                'password' => Hash::make('abcd1234')
            ],
            [
                'name' => 'driver_3',
                'email' => 'driver_3@gmail.com',
                'number' => '123456',
                'password' => Hash::make('abcd1234')
            ],
            [
                'name' => 'driver_4',
                'email' => 'driver_4@gmail.com',
                'number' => '123456',
                'password' => Hash::make('abcd1234')
            ]
        ];
        foreach ($drivers as $driver)
        {
            Driver::create($driver);
        }
    }
}
