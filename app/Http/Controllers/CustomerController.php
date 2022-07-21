<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

//IMPORT DB IF YOU USE DB FOR QUERYING
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    //
    public function signup(Request $request)
    {

        //This is the code for validation of every request
        $validated = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_number' => 'required|digits:11',

        ]);

        //if validation fails this will return the error response
        if ($validated->fails()) {
            $responseArr['message'] = $validated->errors();
            return response()->json($responseArr);
        }


        $emailCheck = DB::table('customer')->where('email', $request->email)->limit(1)->count();

        if ($emailCheck === 0) {

            //if correct, it will insert in the table of customer
            $customerTable = DB::table('customer')->insert(
                [
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'contact_number' => $request->contact_number,
                ]
            );

            //it will return status 200 if it was inserted in the DB and 500 if inserting is not successful
            if ($customerTable) {
                return response()->json(
                    [
                        'success' => $customerTable,
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
        } else {
            return response()->json([
                'message' => 'Email already existing',
            ], 404);
        }
    }

    //Customer Login Function
    function logIn(Request $request)                                
    {

        $validated = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        //if validation fails this will return the error response
        if ($validated->fails()) {
            $responseArr['message'] = $validated->errors();
            return response()->json($responseArr);
        }

        //requesting first the email 
        $user = Customer::where('email', $request->email)->first();                 
      
       if (!$user || !Hash::check($request->password, $user->password)) {
        return response('Login invalid', 503);
     }

        $token = $user->createToken($request->device_name)->plainTextToken;

            return response([
                'token' => [$token],
                'message' => ['Log In Successs.']                              //success log in message
            ], 201);
      
    }

     //function to logut / delete token
     function logout(Request $request){                        
        $request ->user()->currentAccessToken()->delete();
        return response()->json([                                              // postman->headers-> key: Authorizaion || value: Bearer[space][token]
            'status_code' => 200,
            'message' => 'Token deleted successfuly.'
        ]);
     }

}
