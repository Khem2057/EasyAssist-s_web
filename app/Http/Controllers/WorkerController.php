<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MobileUsers;
use Illuminate\Support\Facades\Session;

class WorkerController extends Controller
{
    public function index(){
        $data['workerMobileUser'] = MobileUsers::where('status',1)->get();
        return view('dashboard.workers',$data);
    }

    public function delete($id){
        $workers = MobileUsers::find($id);
        if(!is_null($workers)){
            $workers->delete();
            Session::flash('success', 'Worker deleted successfully.');
        }
        else{
            Session::flash('error', 'Worker not found.');
        }
        return redirect()->route('workers');
    }


    public function update( $id){
        $mobileuser = MobileUsers::find($id);

        $mobileuser->status = "0";
        $result = $mobileuser->update();
        if($result){
            Session::flash('success', 'Updated successfully');
        }
        else{
            Session::flash('error', 'failed to update');
        }
        return redirect()->route('workers');
    }

    public function newRequestWorker(){
        $data['workerMobileUser'] = MobileUsers::where('status',2)->get();
        return view('dashboard.newrequestworker',$data);
    }


    public function deleteNewRequest($id){
        $workers = MobileUsers::find($id);
        if(!is_null($workers)){
            $workers->delete();
            Session::flash('success', 'Request deleted successfully.');
        }
        else{
            Session::flash('error', 'Request not found.');
        }
        return redirect()->route('newrequestworker');
    }

    public function approveNewRequest( $id){
        $mobileuser = MobileUsers::find($id);

        $mobileuser->status = "1";
        $result = $mobileuser->update();
        if($result){
            Session::flash('success', 'Approved user successfully');
        }
        else{
            Session::flash('error', 'Failed to update');
        }
        return redirect()->route('newrequestworker');
    }
}
