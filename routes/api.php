<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\IdentificationController;
use App\Http\Controllers\NewBooking;

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

Route::middleware('auth:sanctum')->get('/user', function(Request $request) {
    return $request->user();
});

Route::post('/booking', [BookingController::class, 'insertBooking']);

Route::post('/newroute', [NewBooking::class, 'insertRoute']);
Route::post('/otherdetails', [NewBooking::class, 'insertOtherDetails']);
Route::post('/price', [NewBooking::class, 'insertPrice']);

Route::post('/merchantsignup', [IdentificationController::class,'create']);

Route::post('/merchantlogin', [IdentificationController::class,'logIn']);

Route::get('/optionlist', [BookingController::class, 'displayOptions']);

Route::get('/getbooking/{merchantid}', [BookingController::class, 'displayBooking']);

Route::get('/verification', [IdentificationController::class, 'verifymerchant']);

Route::group(['middleware' =>['auth:sanctum']],function(){

    Route::post('/merchantlogout', [IdentificationController::class,'logout']);

    Route::post('/customerlogout', [CustomerController::class,'logout']);

});

Route::put('/merchantupdate/{id}', [IdentificationController::class, 'update']);

Route::post('/customersignup', [CustomerController::class,'signup']);

Route::post('/customerlogin', [CustomerController::class,'logIn']);
