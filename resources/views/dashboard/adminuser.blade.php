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
                Admin users
            </p><br>
        </div>
        <div style="margin-left:80%; ">
            <a class="addbtn" href="{{ route('addadminpage') }}">Add Admin</a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>SN</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($adminuser as $admin)
            <tr>
                <td>{{$admin->id}}</td>
                <td>{{$admin->name}}</td>
                <td>{{$admin->email}}</td>
                <td><a href="/adminuser/delete/{{$admin->id}}">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection