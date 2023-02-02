<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth', 'api'])->group(function(){

    // VEHICLE
    Route::post('/vehicle_register', [VehicleController::class, 'register']);
    Route::get('/vehicle_view', [VehicleController::class, 'view']);
    Route::get('/vehicle_show/{id}', [VehicleController::class, 'show']);
    Route::post('/vehicle_edit/{id}', [VehicleController::class, 'edit']);
    Route::post('/vehicle_delete/{id}', [VehicleController::class, 'delete']);
    Route::post('/vehicle_choose', [VehicleController::class, 'store']);


    // USER
    Route::get('/user_delete', [UserController::class, 'delete']);


    //PARKING
    Route::get('/spaces', [ParkingController::class, 'space']);
    Route::post('/pick_space/{id}', [ParkingController::class, 'check']);
    Route::post('/park', [ParkingController::class, 'park']);
    Route::get('/history', [ParkingController::class, 'history']);
    Route::get('/history/{id}', [ParkingController::class, 'view_one']);
    Route::post('/finish/{id}', [ParkingController::class, 'end']);


});
    

require __DIR__.'/auth.php';