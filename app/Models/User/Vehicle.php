<?php

namespace App\Models\User;

use App\Models\Admin\Property;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = ['property_id', 'make', 'model', 'license', 'resident_name', 'apartment_no', 'email', 'valid_till'];

    protected $appends = ['is_expired', 'time', 'date', 'time_left'];

    /**
     * mutators
     */
    public function setValidTillAttribute($value)
    {
        $this->attributes['valid_till'] = now()->addHours(3);
    }

    /**
     * accessors
     */
    public function getResidentNameAttribute($vale)
    {
        return ucfirst($vale);
    }

    /**
     * Append attributes
     */
    public function getIsExpiredAttribute()
    {
        if (now()->greaterThanOrEqualTo(Carbon::parse($this->valid_till))) {
            return "expired";
        }
        return "active";
    }

    public function getTimeAttribute()
    {
        return date("g:i a", strtotime($this->created_at));
    }

    public function getDateAttribute()
    {
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }

    public function getTimeLeftAttribute()
    {
        $timeLeft = now()->diffInHours(Carbon::parse($this->valid_till)->addHour(),false);
        return $timeLeft > 0 ? $timeLeft : 0;
    }

    /**
     * Scopes
     */

    public function scopeActivePermits($query)
    {
        return $query->where('valid_till', '>=',Carbon::now()->format('Y-m-d H:i:s'));
    }

    public function scopeExpiredPermits($query)
    {
        return $query->where('valid_till', '<',Carbon::now()->format('Y-m-d H:i:s'));
    }
    public function scopeSearchByMake($query, $make)
    {
        return $query->where('make', 'like', '%' . $make . '%');
    }

    public function scopeSearchByModal($query, $modal)
    {
        return $query->where('model', 'like', '%' . $modal . '%');
    }

    public function scopeSearchByLicense($query, $license)
    {
        return $query->where('license', 'like', '%' . $license . '%');
    }

    public function scopeSearchByDate($query, $date)
    {
        return $query->whereDate('created_at', $date);
    }

    public function scopeSearchByApartment($query, $apartment)
    {
        return $query->where('apartment_no', 'like', '%' . $apartment . '%');
    }

    public function scopeSearchByResidentName($query, $residentName)
    {
        return $query->where('resident_name', 'like', '%' . $residentName . '%');
    }

    public function scopeGetRecords($query, $start, $length)
    {
        return $query->orderBy('id', 'desc')
            ->offset($start)
            ->limit($length)
            ->get();
    }

    /**
     * Relationships
     */
    public function property()
    {
        return $this->belongsTo(Property::class)->withDefault();
    }
}
