<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\HasApiTokens;
use App\models\MobileUsers;
use App\Models\EmailVerification;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'address' => 'required',
            'contact' => 'required|unique:mobile_users,contact',
            'email' => 'required|unique:mobile_users,email',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);
        if($validator -> fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 422);
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = MobileUsers::create($input);

        if($user){
            // $user->assignRole('user');
            $this-> sendOtp($user);
            $response = [
                'success' => true,
                'message' => 'Mail has been sent please check your email'
            ];
            return response() -> json($response, 200);
        }
        else{
            $response = [
                'success' => false,
                'message' => 'Unable to create user'
            ];
            return response() -> json($response, 422);
        }

        // $success['token'] = $mobile_users->createToken('token')->plainTextToken;
        // $success['name'] = $mobile_users->name;

        // $response = [
        //     'success' => true,
        //     'data' => $success,
        //     'message' => 'User register successfully',
        // ];

        // return response() -> json($response, 200);
    }


    // public function login(LoginRequest $request){
    //     $credentials = $request->only('email', 'password');
    //     // dd($credentials);
    //     if(Auth::guard('mobile')->attempt($credentials)){
    //         // $mobile_users = Auth::MobileUsers();
    //         $mobile_users = Auth::guard('mobile')->user();

    //         $success['token'] = $mobile_users->createToken('Personal Access Token')->plainTextToken;
    //         $success['name'] = $mobile_users->name;
    
    //         $response = [
    //             'success' => true,
    //             'data' => $success,
    //             'message' => 'User login successfully'
    //         ];
    //         return response() -> json($response, 200);
    //     }else{
    //         $response = [
    //             'success' =>false,
    //             'message' =>'Unauthorized'
    //         ];
    //         return response()->json($response,401);
    //     }
    // }

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $token = $user->createToken('MyAppToken')->plainTextToken;

        return response()->json(['token' => $token], 200);
    } else {
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}


    // public function getData(){
    //     return "kam garyo?";
    // }

    public function logout(){
        $user = Auth::user();
        if($user){
            $user->currentAccessToken()->delete();
            $response = [
                'success' => true,
                'message' => 'User logout successfully'
            ];
            return response() -> json($response, 200);
        }else{
            $response = [
                'success' => false,
                'message' => 'User not found'
            ];
            return response() -> json($response, 422);
        }

    }


    public function forgotPassword(Request $request)
        {
            // dd('helllo');
            try {
                $validateUser = Validator::make($request->all(), [
                    'email' => 'required|email|exists:mobile_users'
                ]);
        
                if ($validateUser->fails()) {
                    // dd('validate fail');
                    return response()->json([
                        'status' => false,
                        'message' => 'Validation error',
                        'errors' => $validateUser->errors()
                    ], 401);
                
                }
                // dd('validate pass');
                $user = MobileUsers::where('email', $request->email)->first();
        
                $this->sendOtp($user);
                return response()->json([
                    'status' => true,
                    'message' => 'OTP has been sent. Please verify your account to reset the password'
                ], 200);

                // $this->verifiedOtp($user);
                // return response()->json([
                //     'status'=>true,
                //     'message'=>'OTP has been verified'
                // ],200);
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage()
                ], 500);
            }
    }


    public function sendOtp($user)
    {
        $otp = rand(100000, 999999);
        $time = date('Y-m-d H:i:s');
        
        EmailVerification::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'otp' => $otp,
                'created_at' => $time,
            ]
        );

        Log::info('Sending OTP', ['otp' => $otp, 'email' => $user->email]);

        $data['email'] = $user->email;
        $data['title'] = 'Mail Verification';
        $data['body'] = 'Your OTP is: ' . $otp;

        try {
            Mail::raw('Your OTP is: ' . $otp, function ($message) use ($data) {
                $message->to($data['email'])->subject($data['title']);
            });

            Log::info('OTP sent successfully to ' . $data['email']);
        } catch (\Exception $e) {
            Log::error('Failed to send OTP', ['error' => $e->getMessage()]);
        }
    }




   
    

    public function verifiedOtp(Request $request)
{
    try {
        $user = MobileUsers::where('email', $request->email)->first();
        $otpData = EmailVerification::where('email', $request->email)
                                    ->where('otp', $request->otp)
                                    ->first();

        if (!$otpData) {
            return response()->json([
                'status' => false,
                'message' => 'You entered the wrong OTP'
            ], 401);
        }

        // Compare times using Carbon  
        $currentTime = Carbon::now();
        $otpTime = new Carbon($otpData->updated_at);
        $expiryTime = $otpTime->addMinutes(3); // Calculate expiry time

        // $currentTime = strtotime(date('Y-m-d H:i:s'));
        // $time = strtotime($otpData->updated_at);

        if ($currentTime->lte($expiryTime)) { // Using 'lte' instead of 'lessThanOrEqualTo'
        
        // if ($currentTime >= $time && $time >= $currentTime - (90 + 5)) {
            MobileUsers::where('id', $user->id)->update([
                'is_verified' => 1
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Email has been verified'
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Your OTP has expired'
            ], 400);
        }
    } catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'message' => $th->getMessage()
        ], 500);
    }
}





    public function resendOtp(Request $request){
        try{
            $user = MobileUsers::where('email',$request->email)->first();
            $otpData = EmailVerification::where('email',$request->email)->first();
            $currentTime = time();
            $time = $otpData->created_at;

            if($currentTime >= $time && $time >=$currentTime - (300+5)){
                return response()->json([
                    'status'=>false,
                    'message'=>'Please try after some time.'
                ],401);
            }
            else{
                $this->sendOtp($user);
                return response()->json([
                    'status'=>true,
                    'message'=>'OTP has been sent. Please check your Email.'
                ],200);
            }
        }catch(\Throwable $th){
            return response()->json([
                'status'=>false,
                'message'=>$th->getMessage()
            ],500);
        }
    }



    public function resetpassword(Request $request)
    {
       $validateUser = Validator::make(
        $request->all(),
        [
            // 'email' => 'required|email',
            'new_password' => 'required|confirmed|min:8',
        ]
    );
    if ($validateUser->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'validation error',
            'errors' => $validateUser->errors()
        ], 401);
    }
    $user = MobileUsers::where('email', $request->email)->where('is_verified','=',1)->first();
    $user->update(['password' => Hash::make($request->new_password)]);
    return response()->json(['status'=>true, 'message' => 'Password reset successfully'],200);
}
}
