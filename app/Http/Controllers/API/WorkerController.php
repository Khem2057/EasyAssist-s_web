<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\MobileUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function applyForWorker(Request $request, $id) {
        // dd('hello');
        // Find the mobile user by ID
        $mobileuser = MobileUsers::find($id);
    
        if (!$mobileuser) {
            $response = [
                'success' => false,
                'message' => 'User not found'
            ];
            return response()->json($response, 404);
        }
    
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'file' => 'required|file', // Added file validation
        ]);
    
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 422);
        }
    
        // Handle the file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('uploads', 'public'); // Store the file in the 'uploads' directory in the 'public' disk
            $mobileuser->file = $filePath;
        }
    
        // Update the status
        $mobileuser->status = "2";
    
        // Save the changes
        $result = $mobileuser->update();
    
        if ($result) {
            $response = [
                'success' => true,
                'message' => 'Apply for worker successfully'
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'success' => false,
                'message' => 'Failed to apply'
            ];
            return response()->json($response, 422);
        }
    }
    
}
