<?php

namespace App\Models\Admin;

use App\Models\Driver\Driver;
use App\Models\Manager\Manager;
use App\Models\User\Vehicle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = ['name','address', 'status'];

    /**
     * scopes
    */
    public function scopeActiveProperties($query)
    {
        return $query->where('status',1);
    }
    public function scopeDeactiveProperties($query)
    {
        return $query->where('status',0);
    }
    public function scopeSearchByName($query,$name)
    {
        return $query->where('name', 'like', '%' . $name . '%');
    }
    public function scopeSearchByManager($query, $manager)
    {
        return $query->wherehas('managers', function ($query) use ($manager){
            $query->where('managers.id','=',$manager);
        });
    }
    public function scopeGetRecords($query, $start, $length)
    {
        return $query->orderBy('id', 'desc')
            ->offset($start)
            ->limit($length)
            ->get();
    }

    /**
     * relationships
    */
    public function managers()
    {
        return $this->belongsToMany(Manager::class);
    }

    public function drivers()
    {
        return $this->belongsToMany(Driver::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
