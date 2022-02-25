<?php

namespace App\Http\Controllers;

use App\Models\Admin\Property;
use App\Models\Driver\Driver;
use App\Models\Manager\Manager;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $totalProperties = Property::all()->count();
        $totalManagers = Manager::all()->count();
        $totalDrivers = Driver::all()->count();
        return view('admin.dashboard', compact('totalProperties','totalManagers','totalDrivers'));
    }
}
