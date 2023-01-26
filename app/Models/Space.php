<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Space extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'space',
        'deleted_at',
    ];
}
