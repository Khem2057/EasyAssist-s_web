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
}
