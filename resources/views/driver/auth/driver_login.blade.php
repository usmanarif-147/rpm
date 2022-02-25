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
                            <h1>Driver Login</h1>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="rpm-search-form">
                            <form method="POST" action="{{route('driver.submit.login')}}">
                                @csrf
                                <ul>
                                    <li>
                                        <label>Email</label>
                                        <input type="email" class="form-control" placeholder="" name="email" value="{{ old('email') }}">
                                    </li>
                                    <li>
                                        <label>Password</label>
                                        <input type="password" class="form-control" placeholder="" name="password">
                                    </li>
                                    <li>
                                        <a href="{{ route('driver.password.request') }}" style="color:
                                                dodgerblue">
                                            Forgot Password?
                                        </a>
                                    </li>
                                    <li>
                                        <button type="submit" class="submit-btn">
                                            Driver Login <i class="fas fa-long-arrow-alt-right"></i>
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
