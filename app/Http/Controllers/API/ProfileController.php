<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\MobileUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function editProfile(Request $request){
        $validator = Validator::make($request->all(),[
            'id' => 'required|exists:mobile_users,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact' => 'required|string|max:20',
            'email' => 'required|string|email|max:255'
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

            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                if ($mobileUser->image) {
                    Storage::delete($mobileUser->image);
                }
        
                // Store the new image
                // $imagePath = $request->file('image')->store('images');

                $image = $request->file('image')->getClientOriginalName();
                $path = $request->file('image')->storeAs('service', $image, 'public');
                $mobileUser->image = $path;
        
                // Update the image path in the database
                // $mobileUser->image = $imagePath;
            }
            $mobileUser->save();

            $mobileUser->update($request->only(['name', 'address', 'contact', 'email']));
            

            $response = [
                'success' => true,
                'message' => 'Profile updated successfully',
                'data' => $mobileUser
            ];
            return response()->json($response, 200);

    }
}
