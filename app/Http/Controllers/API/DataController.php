<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MobileUsers;
use App\Models\Services;
use App\Models\WorkerService;
use App\Models\booking;
use App\Models\Notifications;
use App\Models\Products;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Validator;


class DataController extends Controller
{
    public function index(){
        $mobile_user = MobileUsers::all();
        $services = Services::all();
        $worker_services = WorkerService::all();
        $booking = Booking::all();
        $notifications = Notifications::all();
        $products = Products::all();

        $data = [
            'mobile_user' => $mobile_user,
            'services' => $services,
            'worker_services' =>$worker_services,
            'booking' => $booking,
            'notifications' => $notifications,
            'products' => $products,
        ];

        return response()->json($data);
    }
    
    
}
