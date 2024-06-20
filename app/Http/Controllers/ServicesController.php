<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Services;
use Illuminate\Support\Facades\Session;

class ServicesController extends Controller
{
    public function index(){
        $data['services'] = Services::all(); 
        return view('dashboard.services',$data);
    }


    public function addpage(){
        return view('dashboard.addServices');
    }

    public function addservice(Request $request){
        $service = new Services();
        $service->name = $request->name;
        $service->description = $request->description;
        $service->price = $request->price;
        $result = $service->save();
        if($result){
            Session::flash('success', 'Added service successfully');
        }
        else{
            Session::flash('error', 'Failed to add service');
        }
        return redirect()->route('addservicepage');
    }

    public function delete($id){
        $services = Services::find($id);
        if(!is_null($services)){
            $services->delete();
            Session::flash('success', 'Services deleted successfully.');
        }
        else{
            Session::flash('error', 'Services not found.');
        }
        return redirect()->route('services');
    }
}
