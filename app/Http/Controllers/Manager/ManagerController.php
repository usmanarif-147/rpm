<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Admin\Property;
use App\Models\Manager\Manager;
use App\Models\User\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:manager');
    }


    public function index()
    {
        $manager = Manager::with('properties')->where('id', \auth()->id())->get();
        $properties = $manager[0]->properties;
        return view('manager.dashboard', compact('properties'));
    }

    public function getVehiclesAjax(Request $request)
    {
        if ($request->current == 1) {
            $start = 0;
        } else {
            $start = ($request->current - 1) * $request->length;
        }
        $manager = Manager::with('properties')->where('id', auth()->id())->get();
        $query = Vehicle::where(function ($query) use ($request) {
            if($request->type){
                ($request->type == 'active') ? $query->activePermits() : $query->expiredPermits();
            }
            if($request->property){
                $query->where('property_id', $request->property);
            }
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
                $query->searchByDate($request->date);
            }
            if ($request->apartment) {
                $query->searchByApartment($request->apartment);
            }
            if ($request->resident_name) {
                $query->searchByResidentName($request->resident_name);
            }
        })->whereIn('property_id', $manager[0]->properties->pluck('id')->toArray());
        $total_vehicles = $query->count();
        $vehicles = $query->getRecords($start, $request->length);
        return response()->json([
            'total' => $total_vehicles,
            'vehicles' => $vehicles
        ]);
    }

    public function getVehicleDetailsAjax(Request $request)
    {
        return response()->json([
            'vehicle' => Vehicle::with('property')->where('id', $request->id)->get()
        ]);
    }
}
