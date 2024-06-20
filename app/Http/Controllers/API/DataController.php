<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MobileUsers;
use App\Models\Services;
use App\Models\WorkerService;
use App\Models\booking;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Validator;


class DataController extends Controller
{
    public function index(){
        $mobile_user = MobileUsers::all();
        $services = Services::all();
        $worker_services = WorkerService::all();
        $booking = Booking::all();

        $data = [
            'mobile_user' => $mobile_user,
            'services' => $services,
            'worker_services' =>$worker_services,
            'booking' => $booking,
        ];

        return response()->json($data);
    }

    public function booking_store(Request $request){
        
        $validator = Validator::make($request->all(),[
            'address' => 'required',
            'description' => 'required',
            'image' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);
        if($validator -> fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 422);
        }

        $input = $request->all();
        $bookings = booking::create($input);



        $response = [
            'success' => true,
            'message' => 'Booking successfully',
            'data' => $bookings
        ];

        return response() -> json($response, 200);
    }



    public function editProfile(Request $request){
        $validator = Validator::make($request->all(),[
            'mobile_user_id' => 'required|exists:mobile_users,mobile_user_id',
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
            
            $mobileUser = MobileUsers::find($request->mobile_user_id);

            if(!$mobileUser){
                $response = [
                    'success' => false,
                    'message' => 'User not found'
                ];
                return response()->json($response, 404);
            }

            $mobileUser->update($request->only(['name', 'address', 'contact', 'email']));


            $response = [
                'success' => true,
                'message' => 'Profile updated successfully',
                'data' => $mobileUser
            ];
            return response()->json($response, 200);

    }
    
}
