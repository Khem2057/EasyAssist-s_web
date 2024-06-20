<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class AdminUserController extends Controller
{
    public function index(){
        $data['adminuser'] = User::all();
        return view('dashboard.adminuser',$data);
    }

    public function delete($id){
        $adminusr = User::find($id);
        if(!is_null($adminusr)){
            $adminusr->delete();
            Session::flash('success', 'Admin deleted successfully.');
        }
        else{
            Session::flash('error', 'Admin not found.');
        }
        return redirect()->route('adminuser');
    }

    public function addadminpage(){
        return view('dashboard.addAdmin');
    }

    public function addadmin(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $result = $user->save();
        if($result){
            Session::flash('success', 'Added Admin successfully');
        }
        else{
            Session::flash('error', 'Failed to add Admin');
        }
        return redirect()->route('addadminpage');
    }
}
