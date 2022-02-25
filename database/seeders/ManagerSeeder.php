<?php

namespace Database\Seeders;

use App\Models\Manager\Manager;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $managers = [
            [
                'name' => 'manager_1',
                'number' => '12345',
                'email' => 'manager_1@gmail.com',
                'password' => Hash::make('abcd1234')
            ],
            [
                'name' => 'manager_2',
                'number' => '12345',
                'email' => 'manager_2@gmail.com',
                'password' => Hash::make('abcd1234')
            ],
            [
                'name' => 'manager_3',
                'number' => '1234',
                'email' => 'manager_3@gmail.com',
                'password' => Hash::make('abcd1234')
            ],
        ];
        foreach ($managers as $manager)
        {
            Manager::create($manager);
        }
    }
}
