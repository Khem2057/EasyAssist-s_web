@extends('layouts.app')

@section('content')


<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

.addbtn{
    background-color: #33D657;
    color:white; 
    padding:10px; 
    border-radius:5px;
}
.addbtn:hover{
    background-color: white;
    color: #33D657;
    font-weight: bold;
    transition: ease-in-out 0.3s;
}
</style>

<!-- session start -->

@if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-danger">
        {{ Session::get('error') }}
    </div>
@endif

<!-- session end  -->


<div style="padding: 20px;">

    <div style="display: flex; width:100%">
        <div>
            <p style="font-weight: bold;">
                Our Products
            </p><br>
        </div>
        <div style="margin-left:80%; ">
            <a class="addbtn" href="{{ route('addproductpage') }}">Add new</a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>SN</th>
                <th>Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->category}}</td>
                <td>{{$product->image}}</td>
                <td><a href="/services/delete/{{$product->id}}">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection