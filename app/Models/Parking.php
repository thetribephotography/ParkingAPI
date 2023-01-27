<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Parking extends Model
{
    use HasFactory;

        protected $fillable = [
        'user_id',
        'vehicle_id',
        'space_id',
        'space_number',
        'entered_at',
        'departed_at',
        'deleted_at',
    ];

    public function Vehicle(){
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function Space(){
        return $this->hasMany(Space::class, '_id', 'space_id');
    }

    public function User(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
