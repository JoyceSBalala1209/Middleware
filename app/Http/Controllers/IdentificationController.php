<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merchant;
use App\Models\User;
use App\Models\Verify_merchant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;



//IMPORT DB IF YOU USE DB FOR QUERYING
use Illuminate\Support\Facades\DB;

class IdentificationController extends Controller
{
    //

    public function create(Request $request)
    {

        //This is the code for validation of every request
        $validated = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'contact_number' => 'required',
            'business_name' => 'required',
            'confirmPassword'=>'required|same:password',
            'password' => 'required|min:8',
          

        ]);

        //if validation fails this will return the error response
        if ($validated->fails()) {
            $responseArr['message'] = $validated->errors();
            return response()->json($responseArr);
        }


        $emailCheck = DB::table('merchant')->where('email', $request->email)->limit(1)->count();

        if ($emailCheck === 0) {

            //if correct, it will insert in the table of merchant
            $merchantTable = DB::table('merchant')->insert(
                [
                    'first_name' => $request->firstname,
                    'last_name' => $request->lastname,
                    'email' => $request->email,
                    'contact_number' => $request->contact_number,
                    'name_of_business' => $request->business_name,
                    'password' => Hash::make($request->password),
                    'about' => $request->about,
                ]
            );

            //it will return status 200 if it was inserted in the DB and 500 if inserting is not successful
            if ($merchantTable) {
                return response()->json(
                    [
                        'success' => $merchantTable,
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
        $user = Merchant::where('email', $request->email)->first();                 
      
       if (!$user || !Hash::check($request->password, $user->password)) {
        return response('Login invalid', 503);
     }

        $token = $user->createToken($request->device_name)->plainTextToken;

            return response([
                'token' => [$token],
                'message' => ['Log In Successs.']                              //success log in message
            ], 201);
      
    } 
    
    //Verify Merchant : Proof of Identification
    function verifymerchant()
     {
        $verify_merchant = DB::table('verify_merchant')->get('proof_of_identification');
        
        return response()->json
            ([
             'MerchantID'=> $verify_merchant,
                ]
                ,200);

     }

     //function to logut / delete token
     function logout(Request $request){                        
        $request ->user()->currentAccessToken()->delete();
        return response()->json([                                              // postman->headers-> key: Authorizaion || value: Bearer[space][token]
            'status_code' => 200,
            'message' => 'Token deleted successfuly.'
        ]);
     }

     //Update Profile Information
     public function update(Request $request, $id)
    {
        $request->validate([
            'profile_image'=>'profile_image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $merchantTable = User::where('id',$id)->first();
        unlink($merchantTable->profile_image);
        $profile_image_name = time().'.'.$request->profile_image->extension();
        $request->profile_image->move(public_path('public'),$profile_image_name);
        $path = 'public/'.$profile_image_name;
        $merchantTable->profile_image = $path;

        $merchantTable = merchant::find($id);
        $merchantTable->first_name = $request->input('first_name');
        $merchantTable->last_name = $request->input('last_name');
        $merchantTable->about = $request->input('about');
        $merchantTable->contact_number = $request->input('contact_number');
        $merchantTable->email = $request->input('email');
        $merchantTable->name_of_business = $request->input('name_of_business');

    //Updates new information to the Database
        $merchantTable->save();
        return response()->json($merchantTable);
    }
 
}