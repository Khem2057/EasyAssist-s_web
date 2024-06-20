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

    .fm{
        float: left;
    }
    .fm:hover{
        color: #628BE9;
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
                New Request Workers
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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($workerMobileUser as $wmu)
                <tr>
                    <td>{{$wmu->id}}</td>
                    <td>{{$wmu->name}}</td>
                    <td>{{$wmu->address}}</td>
                    <td>{{$wmu->contact}}</td>
                    <td>{{$wmu->email}}</td>
                    <td><a href="/workers/deleterequest/{{$wmu->id}}" > &nbsp;Delete</a> 
                            <form class="fm" action="{{url('/approveworker',$wmu->id)}}" method="post">
                                @csrf
                                <button type="submit">
                                    Approve | 
                                </button>
                            </form>
                            <!-- <a href="/makeclient/{{$wmu->id}}">Make Client</a> -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection