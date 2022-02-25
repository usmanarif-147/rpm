
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
                                    <h1>Manager Reset Password Email Link</h1>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="rpm-search-form">
                                    <form method="POST" action="{{ route('manager.password.email') }}">
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