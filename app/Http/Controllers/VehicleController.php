<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Parking;
use App\Models\User;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    //REGISTER VEHICLE
    public function register(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'vehicle_type' => 'required',
            'plate_number' => 'required',
        ]);

        $user = Auth::id();

        $reg = new Vehicle;

        $reg->user_id = $request->$user;
        $reg->name = $request->name;
        $reg->vehicle_type = $request->vehicle_type;
        $reg->pate_number = $request->plate_number;

        $reg->save();

        return response()->json(['Saved Successfully']);
    }

    
    //VIEW ALL VEHICLES
    public function view(){
        $user = Auth::id();

        $show = Vehicle::where('user_id', $user)->get();

        return response()->json($show);
    }

    
    //VIEW SPECIFIC VEHICLE
    public function show($id){
        $show_one = Vehicle::where('_id', $id)->first();

        return response()->json($show_one);

    }



    //UPDATE/EDIT SPECIFIC VEHICLE
    public function edit(Request $request, $id){
        $show_one = Vehicle::where('_id', $id)->first();
        
        if($request->all() == ''){
            return response()->json(['No Updates were made']);
        } else {

            $show_one->name = $request->name;
            $show_one->vehicle_type = $request->vehicle_type;
            $show_one->plate_number = $request->plate_number;

            $show_one->update();

            return response()->json(['Update Successful']);
        }
    }


    //DELETE VEHICLE
    public function delete($id){
        $delete = Vehicle::where('_id', $id)->delete();

        return response()->json(['Successfully Deleted']);
    }

    //CHOOSE VEHICLE AND SAVE IN SESSION
    public function store(Request $request, $id){

        $vehicle = Vehicle::where('_id', $id)->first();

        session()->put('vehicle_id', $vehicle);
    }

}
