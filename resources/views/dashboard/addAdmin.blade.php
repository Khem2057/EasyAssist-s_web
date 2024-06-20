@extends('layouts.app')

@section('content')


<style>
    form{
        width: 60%;
        margin-left: 20%;
        margin-right: 20%;
    }
    h1{
        text-align: center;
        font-size: 25px;
    }
</style>

<!-- session start  -->

@if(Session::has('success'))
    <div class="alert alert-success">
        {{Session::get('success')}}
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-danger">
        {{ Session::get('error') }}
    </div>
@endif

<!-- session end  -->

    
<div class="container">
    <h1 >Add New Admin</h1><br>
<form action="{{url('/addadmin')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-2">
        <label class="form-label">Name</label>
        <input type="text" class="form-control" name="name" placeholder="Enter Your name" required>
    </div>
    <div class="mb-2">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
    </div>
    <div class="mb-2">
        <label class="form-label">Password</label>
        <input type="text" class="form-control" name="password"  placeholder="Enter your password" required>
    </div>
    <div class="mb-2">
        <label class="form-label">Confirm Password</label>
        <input type="text" class="form-control" name="confirm-password"  placeholder="Re-enter your password" required>
    </div><br>
   
    <button type="submit" class="btn btn-primary" style=" width:30%; margin-left:35%; margin-right:35%;">Submit</button>
    </form>
    </div>

@endsection
