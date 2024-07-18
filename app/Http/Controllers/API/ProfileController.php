<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\MobileUsers;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function editProfile(Request $request){
        $validator = Validator::make($request->all(),[
            'id' => 'required|exists:mobile_users,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:mobile_users,email,'
        ]);

        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 422);
            }
            
            $mobileUser = MobileUsers::find($request->id);

            if(!$mobileUser){
                $response = [
                    'success' => false,
                    'message' => 'User not found'
                ];
                return response()->json($response, 404);
            }

            $mobileUser->update($request->only(['name', 'address', 'contact', 'email','image']));


            $response = [
                'success' => true,
                'message' => 'Profile updated successfully',
                'data' => $mobileUser
            ];
            return response()->json($response, 200);

    }
}
