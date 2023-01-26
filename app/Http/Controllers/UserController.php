<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class UserController extends Controller
{
    public function showone($id){
        $user = User::where('_id', $id)->first();

        return response()->json($user);
    }


    // public function 
}
