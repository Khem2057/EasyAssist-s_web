<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $data['products'] = Products::all(); 
        return view('dashboard.products',$data);
    }

    public function addproduct(){
        return view('dashboard.addProduct');
    }

    // public function addproduct(Request $request){
    //     $service = new Products();
    //     $service->name = $request->name;
    //     $service->description = $request->description;
    //     $service->price = $request->price;
    //     $result = $service->save();
    //     if($result){
    //         Session::flash('success', 'Added service successfully');
    //     }
    //     else{
    //         Session::flash('error', 'Failed to add service');
    //     }
    //     return redirect()->route('addservicepage');
    // }
}
