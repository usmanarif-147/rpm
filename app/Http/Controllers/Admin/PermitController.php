<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PermitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function activePermits()
    {
        return view('admin.permit.active_permits');
    }
    public function activePermitsAjax(Request $request)
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
        })->activePermits();

        $total_vehicles = $query->count();
        $vehicles = $query->getRecords($start, $request->length);

        return response()->json([
            'total' => $total_vehicles,
            'vehicles' => $vehicles
        ]);
    }
    public function expiredPermits()
    {
        return view('admin.permit.expired_permits');
    }
    public function expiredPermitsAjax(Request $request)
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
        })->expiredPermits();

        $total_vehicles = $query->count();
        $vehicles = $query->getRecords($start, $request->length);

        return response()->json([
            'total' => $total_vehicles,
            'vehicles' => $vehicles
        ]);
    }
}
