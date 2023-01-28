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





                    // $validate = $request->validate([
        //     'vehicle_id' => 'required',
        //     // 'space_name' => 'required',
        // ]); 

        // $space_name = $request->space_name;

        // $space_num = Space::where('id', $space_name)->first();

        // $space_id = Space::where('_id', $id)->first();



        // getting space_id in particular
        // $space_id = $space_num->_id;

        //getting space array
        // $space = $space_id->space;
        
        //time 
        //  $time = Carbon::now()->subHour();
        

        // $empty = null;

        // for ($i = 0; $i < count($space); $i++) {
        // if ($space[$i] === null && $spaces[$i]['updated_at'] >= $time) {
        //     $empty = $space[$i];
        //     break;

        //     return response()->json(['Please Park at Space', $empty]);

        // }if(!$empty) {
        //     return response()->json(['No Space found.....Kindly Wait']);
        //     }
        // }

    }

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

            return response()->json(['Saved Successfully']);

        }
}
