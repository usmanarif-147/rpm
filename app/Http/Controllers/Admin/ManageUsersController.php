<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegistrationRrequest;
use App\Models\Admin\Property;
use App\Models\Driver\Driver;
use App\Models\Manager\Manager;
use App\Notifications\DriverRegisterdNotification;
use App\Notifications\ManagerRegisterdNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ManageUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function drivers()
    {
        $properties = Property::activeProperties()->get();
        return view('admin.drivers', compact('properties'));
    }

    public function allDriversAjax(Request $request)
    {
        if ($request->current == 1) {
            $start = 0;
        } else {
            $start = ($request->current - 1) * $request->length;
        }

        $query = Driver::where(function ($query) use ($request) {
            if ($request->driverName) {
                $query->searchByName($request->driverName);
            }
            if($request->property){
                $query->searchByProperties($request->property);
            }
        });

        $total_drivers = $query->count();
        $drivers_query = $query->getRecords($start, $request->length);

        $drivers = $drivers_query->load(['properties']);
        return response()->json([
            'total' => $total_drivers,
            'drivers' => $drivers
        ]);
    }

    public function createDriver(UserRegistrationRrequest $request)
    {
        $request->validated();
        try {
            DB::transaction(function () use ($request) {
                $driver = Driver::create($request->all());
                $driver->properties()->attach($request->properties);
                Notification::route('mail', $driver->email)
                    ->notify(new DriverRegisterdNotification($request->only(['email','password'])));
            });

            return response()->json([
                'title' => "Driver Created!",
                'text' => "Driver Created Successfully!"
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'error' => $ex->getMessage()
            ], 500);
        }
    }

    public function editDriver($id)
    {
        $driver = Driver::with('properties')->where('id', $id)->get();
        return response()->json([
            'driver' => $driver
        ]);
    }

    public function updateDriver(UserRegistrationRrequest $request)
    {
        $request->validated();
        try {
            DB::transaction(function () use ($request) {
                $driver = Driver::find($request->id);
                $driver->name = $request->name;
                $driver->number = $request->number;
                $driver->email = $request->email;
                $driver->save();
                $driver->properties()->sync($request->properties);
            });
            return response()->json([
                'title' => "Driver Updated!",
                'text' => "Driver Updated Successfully!"
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'error' => $ex->getMessage()
            ]);
        }
    }

    public function deleteDriver($id)
    {
        $manager = Driver::find($id);
        $manager->properties()->detach();
        $manager->delete();

        return response()->json([
            'title' => "Driver deleted!",
            'text' => "Driver deleted Successfully!"
        ]);
    }


    /**
     * managers operations
    */
    public function managers()
    {
        $properties = Property::activeProperties()->get();
        return view('admin.managers', compact('properties'));
    }

    public function allManagersAjax(Request $request)
    {
        if ($request->current == 1) {
            $start = 0;
        } else {
            $start = ($request->current - 1) * $request->length;
        }
        $query = Manager::where(function ($query) use ($request) {
            if ($request->managerName) {
                $query->searchByName($request->managerName);
            }
            if($request->property){
                $query->searchByProperties($request->property);
            }
        });

        $total_managers = $query->count();
        $managers_query = $query->getRecords($start, $request->length);

        $managers = $managers_query->load(['properties']);
        return response()->json([
            'total' => $total_managers,
            'managers' => $managers
        ]);
    }

    public function createManager(UserRegistrationRrequest $request)
    {
        $request->validated();
        try {
            DB::transaction(function () use ($request) {
                $manager = Manager::create($request->all());
                $manager->properties()->attach($request->properties);
                Notification::route('mail', $manager->email)
                    ->notify(new ManagerRegisterdNotification($request->only(['email','password'])));
            });
            return response()->json([
                'title' => "Manager Created!",
                'text' => "Manager Created Successfully!"
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'error' => $ex->getMessage()
            ]);
        }
    }

    public function editManager($id)
    {
        $manager = Manager::with('properties')->where('id', $id)->get();
        return response()->json([
            'manager' => $manager
        ]);
    }

    public function updateManager(UserRegistrationRrequest $request)
    {
        $request->validated();
        try {
            DB::transaction(function () use ($request) {
                $manager = Manager::find($request->id);
                $manager->name = $request->name;
                $manager->number = $request->number;
                $manager->email = $request->email;
                $manager->save();
                $manager->properties()->sync($request->properties);
            });
            return response()->json([
                'title' => "Manager Updated!",
                'text' => "Manager Updated Successfully!"
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'error' => $ex->getMessage()
            ]);
        }
    }

    public function deleteManager($id)
    {
        $manager = Manager::find($id);
        $manager->properties()->detach();
        $manager->delete();

        return response()->json([
            'title' => "Manager deleted!",
            'text' => "Manager deleted Successfully!"
        ]);
    }
}
