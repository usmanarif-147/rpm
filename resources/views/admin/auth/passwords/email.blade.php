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
                                {{--{{ Auth::guard('admin')->user()->name }}--}}
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
                        {{--<div class="card-header">Admin Reset Password Password Link</div>--}}

                        {{--<div class="card-body">--}}
                            {{--@if (session('status'))--}}
                                {{--<div class="alert alert-success" role="alert">--}}
                                    {{--{{ session('status') }}--}}
                                {{--</div>--}}
                            {{--@endif--}}

                            {{--<form method="POST" action="{{ route('admin.password.email') }}">--}}
                                {{--@csrf--}}

                                {{--<div class="row mb-3">--}}
                                    {{--<label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>--}}

                                    {{--<div class="col-md-6">--}}
                                        {{--<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

                                        {{--@error('email')--}}
                                        {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $message }}</strong>--}}
                                    {{--</span>--}}
                                        {{--@enderror--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                {{--<div class="row mb-0">--}}
                                    {{--<div class="col-md-6 offset-md-4">--}}
                                        {{--<button type="submit" class="btn btn-primary">--}}
                                            {{--{{ __('Send Password Reset Link') }}--}}
                                        {{--</button>--}}
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
@section('content')
    <div class="rpm-main-content banner-wrapper" style="height: 100vh">
        <div class="rpm-table">
            <div class="rpm-table-cell">
                <div class="rpm-main-section">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="rpm-title">
                                    <h1>Admin Reset Password Email Link</h1>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="rpm-search-form">
                                    <form method="POST" action="{{ route('admin.password.email') }}">
                                        @csrf
                                        <ul>
                                            <li>
                                                <label>Email Address</label>
                                                <input type="email" class="form-control" placeholder="Email address"
                                                       name="email" value="{{ old('email') }}">
                                            </li>
                                            <li>
                                                <button type="submit" class="submit-btn">
                                                    Send Password Reset Link
                                                    <i class="fas fa-long-arrow-alt-right"></i>
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