<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class UserController extends Controller
{
    // public function showone($id){
    //     $user = User::where('_id', $id)->first();

    //     return response()->json($user);
    // }

    //DELETE USER ACCOUNT
    public function delete(){
        $user = Auth::id();

        $delete = User::where('_id', $id)->delete();
        
        return response()->json([ 'message' => 'Account Deleted Successfully'], 200);
    }


    // public function 
}
