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
                Bookings
            </p><br>
        </div>
        
    </div>

        <table>
            <thead>
                <tr>
                    <th>SN</th>
                    <th>User</th>
                    <th>Service</th>
                    <th>Address</th>
                    <th>Description</th>
                    <th>Service Time</th>
                    <th>Image</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $bkng)
                <tr>
                    <td>{{$bkng->id}}</td>
                    <td>{{$bkng->mobile_user_id}}</td>
                    <td>{{$bkng->service_id}}</td>
                    <td>{{$bkng->address}}</td>
                    <td>{{$bkng->description}}</td>
                    <td>{{$bkng->service_time}}</td>
                    <td>{{$bkng->image}}</td>
                    <td>{{$bkng->latitude}}</td>
                    <td>{{$bkng->longitude}}</td>
                    <td><a href="/mobileuser/delete/{{$bkng->id}}">Delete</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>

@endsection