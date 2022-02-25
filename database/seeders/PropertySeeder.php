<?php

namespace Database\Seeders;

use App\Models\Admin\Property;
use App\Models\Driver\Driver;
use App\Models\Manager\Manager;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $drivers = Driver::all()->toArray();

        $properties = [
            [
                'name' => 'property_1',
                'address' => 'property_1 address',
                'status' => 1
            ],
            [
                'name' => 'property_2',
                'address' => 'property_2 address',
                'status' => 1
            ],
            [
                'name' => 'property_3',
                'address' => 'property_3 address',
                'status' => 0
            ],
            [
                'name' => 'property_4',
                'address' => 'property_4 address',
                'status' => 1
            ],
            [
                'name' => 'property_5',
                'address' => 'property_5 address',
                'status' => 0
            ]
        ];

        foreach ($properties as $property)
        {
            Property::create($property);
        }
    }
}
