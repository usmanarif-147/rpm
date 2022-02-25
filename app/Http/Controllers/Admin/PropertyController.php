<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyRequest;
use App\Models\Admin\Property;
use App\Models\Manager\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $managers = Manager::all();
        return view('admin.property.properties', compact('managers'));
    }

    public function activePropertiesAjax(Request $request)
    {
        if ($request->current == 1) {
            $start = 0;
        } else {
            $start = ($request->current - 1) * $request->length;
        }

        $query = Property::where(function ($query) use ($request) {
            if ($request->propertyName) {
                $query->searchByName($request->propertyName);
            }
            if($request->manager){
                $query->searchByManager($request->manager);
            }
        })->activeProperties();

        $total_properties = $query->count();
        $properties_query = $query->getRecords($start, $request->length);;

        $properties = $properties_query->load(['managers','drivers']);
        return response()->json([
            'total' => $total_properties,
            'properties' => $properties
        ]);
    }

    public function deactivatedProperties(Request $request)
    {
        $managers = Manager::all();
        return view('admin.property.deactivated_properties', compact('managers'));
    }

    public function deactivatedPropertiesAjax(Request $request)
    {
        if ($request->current == 1) {
            $start = 0;
        } else {
            $start = ($request->current - 1) * $request->length;
        }

        $query = Property::where(function ($query) use ($request) {
            if ($request->propertyName) {
                $query->searchByName($request->propertyName);
            }
            if($request->manager){
                $query->searchByManager($request->manager);
            }
        })->deactiveProperties();

        $total_properties = $query->count();
        $properties_query = $query->getRecords($start, $request->length);

        $properties = $properties_query->load(['managers','drivers']);
        return response()->json([
            'total' => $total_properties,
            'properties' => $properties
        ]);
    }

    public function createProperty(PropertyRequest $request)
    {
        $request->validated();
        try {
            DB::transaction(function () use ($request) {
                $property = Property::create($request->all());
                $property->managers()->attach($request->managers);
            });
            return response()->json([
                'title' => "Property Created!",
                'text' => "Property Created Successfully!"
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'error' => $ex->getMessage()
            ]);
        }
    }

    public function editProperty($id)
    {
        $property = Property::with('managers')->where('id', $id)->get();
        return response()->json([
            'property' => $property
        ]);
    }

    public function updateProperty(PropertyRequest $request)
    {
        $request->validated();
        try {
            DB::transaction(function () use ($request) {
                $property = Property::find($request->id);
                $property->name = $request->name;
                $property->address = $request->address;
                $property->status = $request->status;
                $property->save();
                $property->managers()->sync($request->managers);
            });
            return response()->json([
                'title' => "Property Updated!",
                'text' => "Property Updated Successfully!"
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'error' => $ex->getMessage()
            ]);
        }
    }

    public function deactivateProperty($id)
    {
        $property = Property::find($id);
        $property->status = 0;
        $property->save();

        return response()->json([
            'title' => "Property Deactivated!",
            'text' => "Property Deactivated Successfully!"
        ]);
    }

    public function activateProperty($id)
    {
        $property = Property::find($id);
        $property->status = 1;
        $property->save();

        return response()->json([
            'title' => "Property Activated!",
            'text' => "Property Activated Successfully!"
        ]);
    }
}
