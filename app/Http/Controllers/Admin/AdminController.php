<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Property;
use App\Models\Driver\Driver;
use App\Models\Manager\Manager;
use App\Models\User\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $totalPermits = Vehicle::all()->count();
        $totalProperties = Property::all()->count();
        $totalManagers = Manager::all()->count();
        $totalDrivers = Driver::all()->count();
        return view('admin.dashboard', compact('totalProperties','totalManagers','totalDrivers','totalPermits'));
    }

    public function allVehiclesAjax(Request $request)
    {
        if ($request->current == 1) {
            $start = 0;
        } else {
            $start = ($request->current - 1) * $request->length;
        }

        $query = Vehicle::where(function ($query) use ($request) {
            if ($request->make) {
                $query->searchByMake($request->make);
            }
            if ($request->modal) {
                $query->searchByModal($request->modal);
            }
            if ($request->license) {
                $query->searchByLicense($request->license);
            }
            if ($request->date) {
                $query->searchBydate($request->date);
            }
            if ($request->apartment) {
                $query->searchByApartment($request->apartment);
            }
            if ($request->resident_name) {
                $query->searchByResidentName($request->resident_name);
            }
        });

        $total_vehicles = $query->count();
        $vehicles = $query->getRecords($start, $request->length);

        return response()->json([
            'total' => $total_vehicles,
            'vehicles' => $vehicles
        ]);
    }
}
