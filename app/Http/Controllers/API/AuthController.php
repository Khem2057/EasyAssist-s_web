<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\models\MobileUsers;

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
        $input['password'] = bcrypt($input['password']);
        $mobile_users = MobileUsers::create($input);

        $success['token'] = $mobile_users->createToken('MyApp')->plainTextToken;
        $success['name'] = $mobile_users->name;

        $response = [
            'success' => true,
            'data' => $success,
            'message' => 'User register successfully'
        ];

        return response() -> json($response, 200);
    }

    public function login(Request $request){
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            $mobile_users = Auth::MobileUsers();

            $success['token'] = $mobile_users->createToken('MyApp')->plainTextToKen;
            $success['name'] = $mobile_users->name;
    
            $response = [
                'success' => true,
                'data' => $success,
                'message' => 'User login successfully'
            ];
            return response() -> json($response, 200);
        }else{
            $response = [
                'success' =>false,
                'message' =>'Unauthorized'
            ];
            return response()->json($response,401);
        }
    }


    // public function getData(){
    //     return "kam garyo?";
    // }
}
