<?php

namespace Database\Seeders;

use App\Jobs\CreateVehicleJob;
use App\Models\User\Vehicle;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<100; $i++)
        {
            $seed = str_split('abcdefghijklmnopqrstuvwxyz' .'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
            $first_name = ['john', 'virgo', 'ronnie', 'wilson', 'wayne', 'john', 'william', 'donaladson', 'mark', 'selby'];
            $last_name = ['trump', 'carrey', 'minati', 'jackie', 'chain', 'jet', 'lee', 'bruce'];
            $make_array = ['toyota', 'mercedez', 'audi', 'bugati', 'honda', 'corolla', 'BMW'];

            $property_id = rand(1,5);
            $make = $make_array[array_rand($make_array)];
            $model = rand(1990,2022);
            $license = $make.'-'.$model.'-'.$property_id;

            $resident_name = $first_name[array_rand($first_name)].' '. $last_name[array_rand($last_name)];
            $apartment_no = $seed[array_rand($seed)].'-'.rand(100,1001);
            $email = strtok($resident_name,' ').'@gmail.com';

            $arr = [
                'property_id' => $property_id,
                'make' => $make,
                'model' => $model,
                'license' => $license,
                'resident_name' => $resident_name,
                'apartment_no' => $apartment_no,
                'email' => $email,
                'valid_till' => '',
            ];

            Vehicle::create($arr);

//            CreateVehicleJob::dispatch($arr)->delay(now()->addSecond());
        }



    }
}
