<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Cargo;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Validator;

//IMPORT DB IF YOU USE DB FOR QUERYING
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    //

    public function insertBooking(Request $request)
    {

        //This is the code for validation of every request
        $validated = Validator::make($request->all(), [
            'email' => 'required|email',
            'sender_location' => 'required',
            'sender_contact' => 'required|digits:11',
            'recipient_location' => 'required',
            'recipient_contact' => 'required|digits:11',
            'vehicle' => 'required',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'cargo_type' => 'required',
            'time' => 'required',
            'distance' => 'required|numeric',
            'inclusions' => 'required',
            'remarks' => 'required',
            'price' => 'required|numeric',
            'mode_of_payment' => 'required',
            'status' =>'required',
        ]);

        //if validation fails this will return the error response
        if ($validated->fails()) { 
            $responseArr['message'] = $validated->errors();
            return response()->json($responseArr);
        }

        //if correct, it will insert in the table of booking
        $bookingTable = DB::table('booking')->insert(
            [

                'email' => $request->email,
                'sender_location' => $request->sender_location,
                'sender_contact' => $request->sender_contact,
                'recipient_location' => $request->recipient_location,
                'recipient_contact' => $request->recipient_contact,
                'vehicle' => $request->vehicle,
                'length' => $request->length,
                'width' => $request->width,
                'height' => $request->height,
                'weight' => $request->weight,
                'cargo_type' => $request->cargo_type,
                'time' => $request->time,
                'distance' => $request->distance,
                'inclusions' => $request->inclusions,
                'remarks' => $request->remarks,
                'price' => $request->price,
                'mode_of_payment' => $request->mode_of_payment,
                'status' => $request->status,

            ]
        );

        //it will return status 200 if it was inserted in the DB and 500 if inserting is not successful
        if ($bookingTable) {
            return response()->json(
                [
                    'success' => $bookingTable,
                    'message' => 'successfully inserted',
                ],
                200
            );
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to insert',
            ], 500);
        }
    }
    
    //function to display contents of cargo and vehicle table
    public function displayOptions(){

        $vehicle = DB::table('vehicle')->get('vehicle_type');
        $cargo = DB::table('cargo')->get('cargo_type');

        //will return status 200 containing the contents of the database
        return response()->json
            ([
                'Vehicles'=>$vehicle,
                'CargoType'=>$cargo,
                ]
                ,200);
    }

    public function displayBooking(Request $request,$merchantid){
        //get booking condition to same of email
       // $bookingGet = DB::table('booking')->where('email',$email)->get();
                                 //OR
     $bookingGet = DB::table('booking')->where('merchant_id',$merchantid)->get();

        //get booking condition to same order number
       // $bookingGet = DB::table('booking')->where('order_number',$order_number)->get();

//if booking get        
        if ($bookingGet) {
            return response()->json(
              $bookingGet
            );
        } else {
            //if query failed
            return response()->json([
                'success' => false,
                'message' => 'Failed to get',
            ], 500);
        }

    }
}
