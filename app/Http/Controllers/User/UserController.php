<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleRequest;
use App\Models\Admin\Admin;
use App\Models\Admin\Property;
use App\Models\Driver\Driver;
use App\Models\Manager\Manager;
use App\Models\User\Vehicle;
use App\Notifications\VehicleRegistrationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class UserController extends Controller
{
    public function index()
    {
        $properties = Property::where('status', 1)->get();
        return view('user.welcome', compact('properties'));
    }

    public function contact()
    {
        return view('user.contact');
    }

    public function storeVehicle(VehicleRequest $request)
    {
        /**
         * add new column (valid_till) with form request
        */
        $request['valid_till'] = '';
        $request->validated();

        try{
            $vehicle = Vehicle::create($request->all());
            $emailsSendTo = [
                $request->email,
                Admin::find(1)->email,
            ];
            if($vehicle->property->managers){
                foreach ($vehicle->property->managers as $manager)
                {
                    array_push($emailsSendTo,$manager->email);
                }
            }

            Notification::route('mail', $emailsSendTo)
                ->notify(new VehicleRegistrationNotification($vehicle));

            return response()->json([
                'success' => "success"
            ]);
        }catch(\Exception $ex){
            return response()->json([
                'error' => $ex->getMessage()
            ]);
        }
    }
}
