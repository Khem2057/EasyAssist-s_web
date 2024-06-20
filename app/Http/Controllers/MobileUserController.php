<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MobileUsers;
use Illuminate\Support\Facades\Session;

class MobileUserController extends Controller
{
    public function index(){
        $data['clientMobileUser'] = MobileUsers::where('status',0)->get();
        return view('dashboard.mobileUser',$data);
    }

    public function delete($id){
        $mobileuser = MobileUsers::find($id);
        if(!is_null($mobileuser)){
            $mobileuser->delete();
            Session::flash('success', 'Mobile user deleted successfully.');
        }
        else{
            Session::flash('error', 'Mobile user not found.');
        }
        return redirect()->route('mobileuser');
    }
}
