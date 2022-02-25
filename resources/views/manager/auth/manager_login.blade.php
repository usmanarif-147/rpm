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
                                    <h1>Manager Login</h1>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="rpm-search-form">
                                    <form id="manager-login-form">
                                        @csrf
                                        <ul>
                                            <li>
                                                <label>Email</label>
                                                <input type="email" class="form-control" placeholder="" name="email"
                                                       value="{{ old('email') }}">
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
                                                <a href="{{ route('manager.password.request') }}" style="color:
                                                dodgerblue">
                                                    Forgot Password?
                                                </a>
                                            </li>
                                            <li>
                                                <button type="submit" class="submit-btn">
                                                    Manager Login <i class="fas fa-long-arrow-alt-right"></i>
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
        $(document).ajaxStop($.unblockUI);
        $(document).ready(function () {
            $("#manager-login-form").validate({
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
                submitHandler: function (form) {
                    $.ajax({
                        type: "POST",
                        url: "{{route('manager.submit.login')}}",
                        data: $(form).serialize(),
                        success: function (res) {
                            if(res.status){
                                window.location.href = '{{route('manager.dashboard')}}'
                            }
                            else{
                                Swal.fire({
                                    title: res.title,
                                    text: res.text,
                                    icon: 'error',
                                    confirmButtonColor: '#228B22',
                                });
                            }
                        },
                        beforeSend: function () {
                            $.blockUI({
                                message: '<div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div><div class="spinner-grow text-success"></div>',
                                css: {
                                    border: 'none',
                                    backgroundColor: 'transparent'
                                }
                            });
                        },
                    })
                }
            });
        })
    </script>
@endsection

