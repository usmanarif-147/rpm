<?php

namespace App\Models\Manager;

use App\Models\Admin\Property;
use App\Models\User\Vehicle;
use App\Notifications\ManagerResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class Manager extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'manager';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'password', 'number'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * scopes
     */
    public function scopeSearchByName($query, $name)
    {
        $query->where('name', 'like', '%' . $name . '%');
    }
    public function scopeSearchByProperties($query, $name)
    {
        $query->wherehas('properties', function ($query) use ($name) {
            $query->where('properties.id', '=', $name);
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
    public function properties()
    {
        return $this->belongsToMany(Property::class);
    }

    /**
     * send reset password notification
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ManagerResetPasswordNotification($token));
    }
}
