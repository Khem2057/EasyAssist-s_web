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




<div style="padding:20px;">
    <div style="display: flex; width:100%">
        <div>
            <p style="font-weight: bold;">
                Client Mobile user
            </p><br>
        </div>
       
    </div>

        <table>
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clientMobileUser as $cmu)
                <tr>
                    <td>{{$cmu->id}}</td>
                    <td>{{$cmu->name}}</td>
                    <td>{{$cmu->address}}</td>
                    <td>{{$cmu->contact}}</td>
                    <td>{{$cmu->email}}</td>
                    <td><img src="{{asset('storage/'.$cmu->image)}}" alt="Images" height="50px" width="100px" style="object-fit:cover"></td>
                    <td><a href="/mobileuser/delete/{{$cmu->id}}'">Delete</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

