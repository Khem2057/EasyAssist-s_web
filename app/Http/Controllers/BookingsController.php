<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\session;

class BookingsController extends Controller
{
    public function index(){
        $data['bookings']= Booking::all();
        return view('dashboard.booking',$data);
    }

    public function delete($id){
        $booking = Booking::find($id);
        if(!is_null($booking)){
            $booking->delete();
            Session::flash('success', 'Booking deleted successfully.');
        }
        else{
            Session::flash('error', 'Booking not found.');
        }
        return redirect()->route('booking');
    }
}
