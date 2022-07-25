<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Route;
use App\Models\OtherDetails;
use App\Models\Price;
use Illuminate\Support\Facades\Validator;

//IMPORT DB IF YOU USE DB FOR QUERYING
use Illuminate\Support\Facades\DB;

class NewBooking extends Controller
{
    //

    public function insertRoute(Request $request)
    {

        //This is the code for validation of every request
        $validated = Validator::make($request->all(), [
            'senderloc' => 'required',
            'recipientloc' => 'required',  
            'vehicletype' => 'required',
            'cargotype' => 'required',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            
        ]);

        //if validation fails this will return the error response
        if ($validated->fails()) { 
            $responseArr['message'] = $validated->errors();
            return response()->json($responseArr);
        }

        //if correct, it will insert in the table of booking
        $bookingRoute = DB::table('routes_input')->insert(
            [
            
                'senderloc' => $request->senderloc,
                'recipientloc' => $request->recipientloc,   
                'wholevehicle' => $request->vehicletype,
                'cargotype' => $request->cargotype,
                'length' => $request->length,
                'width' => $request->width,
                'height' => $request->height,
                'weight' => $request->weight,
    

            ]
        );

        //it will return status 200 if it was inserted in the DB and 500 if inserting is not successful
        if ($bookingRoute) {
            return response()->json(
                [
                    'success' => $bookingRoute,
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

    public function insertOtherDetails(Request $request)
    {

        //This is the code for validation of every request
        $validated = Validator::make($request->all(), [
            'remarks' => 'required',
        //    'inclusion' => 'required',  
           
        ]);

        //if validation fails this will return the error response
        if ($validated->fails()) { 
            $responseArr['message'] = $validated->errors();
            return response()->json($responseArr);
        }

        //if correct, it will insert in the table of booking
        $bookingOtherDetails = DB::table('other_details')->insert(
            [
            
                'remarks' => $request->remarks,
                // 'inclusion' => $request->inclusion,   
                
    

            ]
        );

        //it will return status 200 if it was inserted in the DB and 500 if inserting is not successful
        if ($bookingOtherDetails) {
            return response()->json(
                [
                    'success' => $bookingOtherDetails,
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

    
    public function insertPrice(Request $request)
    {

        //This is the code for validation of every request
        $validated = Validator::make($request->all(), [
            // 'mode_of_payment' => 'required',
            'sender_name' => 'required',
            'sender_number' => 'required|digits:10',
            'recipient_name' => 'required',
            'recipient_number' => 'required|digits:10',
            // 'distance' => 'required',
            // 'price' => 'required|numeric',
            
        ]);

        //if validation fails this will return the error response
        if ($validated->fails()) { 
            $responseArr['message'] = $validated->errors();
            return response()->json($responseArr);
        }

        //if correct, it will insert in the table of booking
        $bookingPrice = DB::table('price_input')->insert(
            [
               
                'sender_name' => $request->sender_name,
                'sender_number' => $request->sender_number,
                'recipient_name' => $request->recipient_name,
                'recipient_number' => $request->recipient_number,
                // 'distance' => $request->distance,
                // 'price' => $request->price,
                // 'mode_of_payment' => $request->mode_of_payment,
                
            ]
        );

        //it will return status 200 if it was inserted in the DB and 500 if inserting is not successful
        if ($bookingPrice) {
            return response()->json(
                [
                    'success' => $bookingPrice,
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
    
}
