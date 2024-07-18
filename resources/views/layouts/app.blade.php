<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])


        <style>
            .sidebar {
            height: 100vh;
            /* max-width: 300px; */
            /* min-width: 210px; */
            width: 20%;
            position: fixed;
            border-right: rgb(243 244 246) solid 1px;
            background-color: #EBFFEF;
            margin-top: 110px;
            }

            .sidebar a {
                padding: 10px 30px;
                text-align: center;
                text-decoration: none;
                font-size: 16px;
                color: black;
                display: block;
                border-bottom: #E1E1E1 solid 1px;
            }

            .sidebar a:hover {
                background-color: #575757;
                color: white;
            }

            .content {
                /* margin-left: 210px; */
                /* padding: 20px; */
                width: auto;
                padding-top: 110px;
                width: 100%;
                padding-left: 20%;
                margin-bottom: 40px;
            }
            /* .row{
                width: 100%;
            } */
            footer{
                position:fixed;
                bottom: 0;
                z-index: 5;
                background-color: white;
                width: 100%;
                font-size: 14px;
                border-top: rgb(243 244 246) solid 1px;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen ">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <!-- @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif -->

            <!-- Page Content -->
            <main>
            
                        <div class="sidebar">
                            <a href="{{ route('dashboard') }}">Dashboard</a>
                            <a href="{{ route('products') }}">Products</a>
                            <a href="{{ route('services') }}">Services</a>
                            <a href="{{ route('booking') }}">Bookings</a>
                            <a href="{{ route('workers') }}">Workers</a>
                            <a href="{{ route('newrequestworker') }}">New Request Workers</a>
                            <a href="{{ route('mobileuser') }}">Mobile users</a>
                            <a href="{{ route('adminuser')}}">Admin user</a>
                         </div>
                   
                        <div class="content">
                            @yield('content')
                        </div>
            </main>
            <footer>
                <div>
                    <p style="text-align: center; padding:10px;">Copyright © 2024 KKS Technologies Pvt. Ltd. | All Rights Reserved.</p>
                </div>
            </footer>
        </div>
    </body>
</html>
