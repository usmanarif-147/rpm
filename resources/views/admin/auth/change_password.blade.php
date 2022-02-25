@extends('layouts.admin_layout')
@section('css')
    <style>
        .error {
            color: red;
        }
    </style>
@endsection
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="card-header-tab card-header">
                <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                            class="pe-7s-lock mr-3 text-muted opacity-6"
                            style="font-size: 35px; color: #be1b20 !important;"> </i>Change Password
                </div>
            </div>
            <div class="tabs-animation">
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <form id="change-password-form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="password" class="form-control"
                                                       name="old_password"
                                                       placeholder="Old Password" value="{{old('old_password')}}">
                                                @error('old_password')
                                                <label for="" class="error"> {{$message}} </label>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="password" class="form-control"
                                                       name="new_password"
                                                       placeholder="New Password" value="{{old('new_password')}}">
                                                @error('new_password')
                                                <label for="" class="error"> {{$message}} </label>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="password" class="form-control"
                                                       name="new_confirm_password"
                                                       placeholder="Confirm New Password">
                                                @error('new_confirm_password')
                                                <label for="" class="error"> {{$message}} </label>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary pull-right">Update</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('includes.admin.footer')
    </div>
@endsection

@section('script')
    <script>
        $(document).ajaxStop($.unblockUI);
        $(document).ready(function () {
            $("#change-password-form").validate({
                rules: {
                    old_password: {
                        required: true,
                        minlength: 5
                    },
                    new_password: {
                        required: true,
                        minlength: 5
                    },
                    new_confirm_password: {
                        required: true,
                        minlength: 5
                    },
                },
                messages: {
                    old_password: {
                        required: 'Password field is required',
                        minlength: 'Password length should be greater than or equal to 5'
                    },
                    new_password: {
                        required: 'Password field is required',
                        minlength: 'Password length should be greater than or equal to 5'
                    },
                    new_confirm_password: {
                        required: 'Password field is required',
                        minlength: 'Password length should be greater than or equal to 5'
                    },
                },
                submitHandler: function (form) {
                    let url = '{{route('admin.update.password')}}';
                    let type = 'POST';
                    let data = $(form).serialize();
                    $.ajax({
                        type: type,
                        url: url,
                        data: data,
                        success: function (res) {
                            let icon = 'error';
                            if (res.status) {
                                icon = 'success'
                            }
                            $("#change-password-form")[0].reset();
                            Swal.fire({
                                title: res.title,
                                text: res.text,
                                icon: icon,
                                confirmButtonColor: '#228B22',
                            });

                        },
                        beforeSend: function () {
                            $.blockUI({
                                message: '<div class="spinner-grow text-success"></div>' +
                                    '<div class="spinner-grow text-success"></div>' +
                                    '<div class="spinner-grow text-success"></div>',
                                css: {
                                    border: 'none',
                                    backgroundColor: 'transparent'
                                }
                            });
                        },
                    });
                }
            });
        });
    </script>
@endsection