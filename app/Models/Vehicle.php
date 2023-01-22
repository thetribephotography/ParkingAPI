<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'vehicle_type',
        'plate_number',
        'deleted_at',
    ];


    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function Parking(){
        return $this->hasMany(Parking::class);
    }
}


