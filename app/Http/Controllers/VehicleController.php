<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;    
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Parking;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Session;


class VehicleController extends Controller
{

    // REGISTER VEHICLE
    public function register(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'vehicle_type' => 'required',
            'plate_number' => 'required',
        ]);

        $user = Auth::id();

        $reg = new Vehicle;

        $reg->user_id = $user;
        $reg->name = $request->name;
        $reg->vehicle_type = $request->vehicle_type;
        $reg->plate_number = $request->plate_number;

        $reg->save();

        return response()->json(['message' => $reg], 200);
    }

    
    // VIEW ALL VEHICLES
    public function view(){
        $user = Auth::id();

        $show = Vehicle::where('user_id', $user)->get();

        return response()->json(['message' => $show], 200);
    }

    
    // VIEW SPECIFIC VEHICLE
    public function show($id){
        $show_one = Vehicle::where('_id', $id)->first();

        return response()->json(['message' => $show_one], 200);

    }


    // UPDATE/EDIT SPECIFIC VEHICLE
    public function edit(Request $request, $id){
        $show_one = Vehicle::where('_id', $id)->first();
        
        if($request->all() == ''){
            return response()->json(['message' => 'No Updates were made'], 404);
        } else {

            $show_one->name = $request->name;
            $show_one->vehicle_type = $request->vehicle_type;
            $show_one->plate_number = $request->plate_number;

            $show_one->update();

            return response()->json(['message' => $show_one], 200);
        }
    }


    // DELETE VEHICLE
    public function delete($id){
        $delete = Vehicle::where('_id', $id)->delete();

        return response()->json(['message' => 'Successfully Deleted'], 200);
    }


    // CHOOSE VEHICLE AND SAVE IN SESSION
    public function store(Request $request){
        $validated = $request->validate([
            'vehicle' => 'required',
        ]);

        $id = $request->vehicle;

        $vehicle = Vehicle::where('_id', $id)->first();

        session()->put('vehicle_id', $vehicle);

        return response()->json([ 'message' => 'I Must Say.....Nice Car!'], 200);
    }

}
