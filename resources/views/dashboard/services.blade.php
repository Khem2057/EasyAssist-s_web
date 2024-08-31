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
                Our services
            </p><br>
        </div>
        <div style="margin-left:80%; ">
            <a class="addbtn" href="{{ route('addservicepage') }}">Add new</a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>SN</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Icon</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $srvs)
            <tr>
                <td>{{$srvs->id}}</td>
                <td>{{$srvs->name}}</td>
                <td>{{$srvs->description}}</td>
                <td>{{$srvs->price}}</td>
                <!-- <td>{{$srvs->icon}}</td> -->
                <td><img src="{{asset('storage/'.$srvs->icon)}}" alt="Icon" height="50px" width="50px" style="object-fit:cover"></td>
                <td><img src="{{asset('storage/'.$srvs->image)}}" alt="Images" height="50px" width="100px" style="object-fit:cover"></td>
                
                <td><a href="/services/delete/{{$srvs->id}}">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection