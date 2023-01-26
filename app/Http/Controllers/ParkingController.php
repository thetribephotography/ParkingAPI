<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Parking;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Space;

class ParkingController extends Controller
{
    // public function brain(Request $request $id){
    //     $validate = $request->validate([
    //         'vehicle_id' => 'required',
    //         'space_name' => 'required',
    //     ]);

    //     $space_name = $request->space_name;

    //     $space_num = Space::where('name', $space_name)->get();

    //     // getting space_id in particular
    //     $space_id = $space_num->_id;

    //     //getting space array
    //     $space = $space_num->space;
        
    //     //time 
    //      $time = Carbon::now()->subHour();
        

    //     $empty = null;

    //     for ($i = 0; $i < count($space); $i++) {
    //     if ($space[$i] === null && $spaces[$i]['updated_at'] >= $time) {
    //         $empty = $space[$i];
    //         break;

    //         return response()->json(['Please Park at Space', $empty]);

    //     }if(!$empty) {
    //         return response()->json(['No Space found.....Kindly Wait']);
    //         }
    //     }

    //     $saveData = new Parking;
    //     $saveData->vehicle_id = $request->vehicle_id;
    //     $saveData->space_id = $request->$space_id;
    //     $saveData->space_number = $request->$empty;
    //     // $saveData->entered_at =  


    // }


    public function space(){
        $show_all = Space::all();

        return response()->json($show_all);
    }



    public function check($id){
        $space = Space::where('_id', $id)->first();

        

    }
}
