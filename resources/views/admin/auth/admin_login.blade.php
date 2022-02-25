{{--<!doctype html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--<head>--}}
{{--<meta charset="utf-8">--}}
{{--<meta name="viewport" content="width=device-width, initial-scale=1">--}}

{{--<!-- CSRF Token -->--}}
{{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}

{{--<title>{{ config('app.name', 'Laravel') }}</title>--}}

{{--<!-- Scripts -->--}}
{{--<script src="{{ asset('js/app.js') }}" defer></script>--}}
{{--<script src="https://js.pusher.com/7.0/pusher.min.js"></script>--}}

{{--<!-- Fonts -->--}}
{{--<link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}

{{--<!-- Styles -->--}}
{{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
{{--</head>--}}
{{--<body>--}}
{{--<div id="app">--}}
{{--<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">--}}
{{--<div class="container">--}}
{{--<a class="navbar-brand" href="{{ url('/') }}">--}}
{{--Admin Layout--}}
{{--</a>--}}
{{--<button class="navbar-toggler" type="button" data-bs-toggle="collapse"--}}
{{--data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"--}}
{{--aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
{{--<span class="navbar-toggler-icon"></span>--}}
{{--</button>--}}

{{--<div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
{{--<!-- Left Side Of Navbar -->--}}
{{--<ul class="navbar-nav me-auto">--}}

{{--</ul>--}}

{{--<!-- Right Side Of Navbar -->--}}
{{--<ul class="navbar-nav ms-auto">--}}
{{--<!-- Authentication Links -->--}}
{{--@guest('admin')--}}
{{--@if (Route::has('admin.login.form'))--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link" href="{{ route('admin.login.form') }}">{{ __('Admin Login') }}</a>--}}
{{--</li>--}}
{{--@endif--}}
{{--@else--}}
{{--<li class="nav-item dropdown">--}}
{{--<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"--}}
{{--data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
{{--{{ Auth::user()->name }}--}}
{{--</a>--}}

{{--<div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">--}}
{{--<a class="dropdown-item" href="{{ route('admin.logout') }}"--}}
{{--onclick="event.preventDefault();--}}
{{--document.getElementById('logout-form').submit();">--}}
{{--{{ __('Admin Logout') }}--}}
{{--</a>--}}

{{--<form id="logout-form" action="{{ route('admin.logout') }}" method="POST"--}}
{{--class="d-none">--}}
{{--@csrf--}}
{{--</form>--}}
{{--</div>--}}
{{--</li>--}}
{{--@endguest--}}
{{--</ul>--}}
{{--</div>--}}
{{--</div>--}}
{{--</nav>--}}

{{--<main class="py-4">--}}

{{--<div class="container">--}}
{{--<div class="row justify-content-center">--}}
{{--<div class="col-md-8">--}}
{{--<div class="card">--}}
{{--<div class="card-header">{{ __('Admin Login') }}</div>--}}

{{--<div class="card-body">--}}
{{--<form method="POST" action="{{route('admin.submit.login')}}">--}}
{{--@csrf--}}
{{--<div class="row mb-3">--}}
{{--<label for="email"--}}
{{--class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>--}}

{{--<div class="col-md-6">--}}
{{--<input id="email" type="email"--}}
{{--class="form-control @error('email') is-invalid @enderror" name="email"--}}
{{--value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

{{--@error('email')--}}
{{--<span class="invalid-feedback" role="alert">--}}
{{--<strong>{{ $message }}</strong>--}}
{{--</span>--}}
{{--@enderror--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="row mb-3">--}}
{{--<label for="password"--}}
{{--class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>--}}

{{--<div class="col-md-6">--}}
{{--<input id="password" type="password"--}}
{{--class="form-control @error('password') is-invalid @enderror"--}}
{{--name="password"--}}
{{--required autocomplete="current-password">--}}

{{--@error('password')--}}
{{--<span class="invalid-feedback" role="alert">--}}
{{--<strong>{{ $message }}</strong>--}}
{{--</span>--}}
{{--@enderror--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="row mb-3">--}}
{{--<div class="col-md-6 offset-md-4">--}}
{{--<div class="form-check">--}}
{{--<input class="form-check-input" type="checkbox" name="remember"--}}
{{--id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--<label class="form-check-label" for="remember">--}}
{{--{{ __('Remember Me') }}--}}
{{--</label>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="row mb-0">--}}
{{--<div class="col-md-8 offset-md-4">--}}
{{--<button type="submit" class="btn btn-primary">--}}
{{--{{ __('Login') }}--}}
{{--</button>--}}

{{--@if (Route::has('password.request'))--}}
{{--<a class="btn btn-link" href="{{ route('admin.password.request') }}">--}}
{{--{{ __('Forgot Your Password?') }}--}}
{{--</a>--}}
{{--@endif--}}
{{--</div>--}}
{{--</div>--}}
{{--</form>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}

{{--</main>--}}
{{--</div>--}}

{{--@yield('script')--}}
{{--</body>--}}
{{--</html>--}}


@extends('layouts.user_layout')
@section('css')
    <style>
        .rpm-search-form .error {
            color: red;
        }
    </style>
@endsection
@section('content')
    <div class="rpm-main-content banner-wrapper" style="height: 100vh">
        <div class="rpm-table">
            <div class="rpm-table-cell">
                <div class="rpm-main-section">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="rpm-title">
                                    <h1>Admin Login</h1>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="rpm-search-form">
                                    <form method="POST" action="{{route('admin.submit.login')}}" id="login-form">
                                        @csrf
                                        <ul>
                                            @if(session()->has('failed'))
                                                <li>
                                                    <label class="error"> {{session()->get('failed')}} </label>
                                                </li>
                                            @endif
                                            <li>
                                                <label>Email</label>
                                                <input type="email" class="form-control"
                                                       placeholder=""
                                                       name="email" value="{{ old('email') }}">
                                                @error('email')
                                                <label class="error">
                                                    {{ $message }}
                                                </label>
                                                @enderror
                                            </li>

                                            <li>
                                                <label>Password</label>
                                                <input type="password" class="form-control" placeholder=""
                                                       name="password">
                                                @error('password')
                                                <label class="error">
                                                    {{ $message }}
                                                </label>
                                                @enderror
                                            </li>
                                            <li>
                                                <a href="{{ route('admin.password.request') }}" style="color:
                                                dodgerblue">
                                                    Forgot Password?
                                                </a>
                                                @error('password')
                                                <label for="password" class="invalid-feedback"> {{$message}} </label>
                                                @enderror
                                            </li>
                                            <li>
                                                <button type="submit" class="submit-btn">
                                                    Admin Login <i class="fas fa-long-arrow-alt-right"></i>
                                                </button>
                                            </li>
                                        </ul>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {

            $("#login-form").validate({
                rules: {
                    email: {
                        required: true,
                    },
                    password: {
                        required: true,
                    },
                },
                messages: {
                    email: {
                        required: 'Please enter email address',
                    },
                    password: {
                        required: 'Please enter password',
                    },
                },
                {{--submitHandler: function (form) {--}}
                {{--$.ajax({--}}
                {{--type: "POST",--}}
                {{--url: "{{route('store.vehicle')}}",--}}
                {{--data: $(form).serialize(),--}}
                {{--success: function (res) {--}}
                {{--console.log(res)--}}
                {{--$("#vehicle_registration")[0].reset();--}}
                {{--Swal.fire({--}}
                {{--title: 'Vehicle Registration!',--}}
                {{--text: 'Vehicle is registered for next 24 hours.',--}}
                {{--icon: 'success',--}}
                {{--confirmButtonColor: '#228B22',--}}
                {{--});--}}
                {{--},--}}
                {{--beforeSend: function () {--}}
                {{--$.blockUI({--}}
                {{--message: '<div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div>',--}}
                {{--css: {--}}
                {{--border: 'none',--}}
                {{--backgroundColor: 'transparent'--}}
                {{--}--}}
                {{--});--}}
                {{--},--}}
                {{--})--}}
                {{--}--}}
            });
        })
    </script>
@endsection

