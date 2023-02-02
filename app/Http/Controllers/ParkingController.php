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
use Carbon\Carbon;

class ParkingController extends Controller
{
    //SHOWS ALL PARKING LOT'S TO PARK IN
    public function space(){
        $show_all = Space::all();

        return response()->json($show_all);
    }

    //CHECKS FOR AVAILABLE PARKING SPACE IN THAT PARKING LOT
    public function check($id){

        // checks the parking table for currently ocuupied spaces for a particular park
        $closed = Parking::whereNull('left_at')->where('space_id', $id)->get();

        // finds the specific Park and assigns the space array to a variable
        $space_id = Space::where('_id', $id)->first();
            $space_num = $space_id->space;

            //loops through the occupied spaces instance and gets the space number and stores in an array
            $closed_num = array();
            foreach($closed as $closed){
                $closed_num[] = $closed->space_number;
            }

            //picks the numbers that are only found in the $space_num array variable when compared to the $closed_num array and send response in json
             $final = array_diff($space_num, $closed_num);

             $this->park($space_id);

            return response()->json($final);

    }

        // STORES PICKED PARKED SPOT IN DB
        public function park(Request $request, $space_id){
            $validated = $request->validate([
                'space_num' => 'required',
                'vehicle_name' => 'required',
            ]);

            $user = Auth::id();
            $time = Carbon::now();

            // $space_num = Space::where('')
            
            // $vehicle = $request->vehicle_name;
            // $vehicle_name = Vehicle::where('_id', $vehicle && '_id', $user )->get();

            $sess_vehicle = Session::get('vehicle_id');

            $store = new Parking;
            $store->user_id = $user;
            $store->vehicle_id = $sess_vehicle;
            $store->space_id = $space_id;
            $store->space_number = $request->space_num;
            $store->entered_at = $time;

            $store->save();

            return response()->json($store, ['Saved Successfully']);

        }


        //SHOWS USER PARKING HISTORY
        public function history(){
            $user = Auth::id();

            $history = Parking::where('user_id', $user)->get();
            
            if(!history){
                return response()->json(['You do not have an History Yet!.']);
            }

            return response()->json($history);
        }

        //VIEW DETAILS OF SINGLE PARKING HISTORY
        public function view_one($id){
            $user = Auth::id();

            $view = Parking::where('_id', $id && 'user_id', $user )->first();

            return response()->json($view);
        }

        //UPDATES DB ONCE USER HAS SUCCESSFULLY EXITED ALLOCATED PARKING SPACE
        public function end($id){
            $depart = Parking::where('_id', $id)->first();

            $end_time = Carbon::now();

            $depart->departed_at = $end_time;

            $depart->update();

            return response()->json(['Kindly Vacate Your Parked Area Immediately.....Thank You!!']);

        }
}
