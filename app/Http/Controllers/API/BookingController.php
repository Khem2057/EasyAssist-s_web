<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function booking_store(Request $request){
        
        $validator = Validator::make($request->all(),[
            'address' => 'required',
            'description' => 'required',
            'service_time' => 'required',
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
}
