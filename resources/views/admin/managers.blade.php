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
                        class="pe-7s-users mr-3 text-muted opacity-6"
                        style="font-size: 35px; color: #be1b20 !important;"> </i>
                    <span id="page-title">Add New Manager</span>
                </div>
            </div>
            <div class="tabs-animation">
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <form id="manager-form">
                                    @csrf
                                    <input type="hidden" id="manager_id" name="id" value="">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Manager Name</label>
                                                <input type="text" class="form-control"
                                                       placeholder="Manager Name"
                                                       value="{{old('name')}}"
                                                       name="name" id="name">
                                                @error('name')
                                                <label class="error" for="name">{{$message}}</label>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <input type="text" class="form-control"
                                                       placeholder="Phone Number"
                                                       value="{{old('number')}}"
                                                       name="number" id="number">
                                                @error('number')
                                                <label class="error" for="number">{{$message}}</label>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control"
                                                       placeholder="Email Address"
                                                       value="{{old('email')}}"
                                                       name="email" id="email">
                                                @error('email')
                                                <label class="error" for="email">{{$message}}</label>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control"
                                                       placeholder="Password"
                                                       value="{{old('password')}}"
                                                       name="password" id="password" autocomplete="new-password">
                                                @error('password')
                                                <label class="error" for="password">{{$message}}</label>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="password" class="form-control"
                                                       placeholder="Confirm Password"
                                                       name="password_confirmation"
                                                       id="password_confirmation"
                                                       autocomplete="new-password">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Select Properties</label>
                                                <select class="form-control multiple-select"
                                                        name="properties[]" multiple="multiple" id="properties">
                                                    @foreach($properties as $property)
                                                        <option value="{{$property->id}}">
                                                            {{$property->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('properties')
                                                <label class="error" for="name">{{$message}}</label>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary pull-right action">Add New Manager</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-header-tab card-header">
                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                    <i class="pe-7s-users mr-3 text-muted opacity-6" style="font-size: 35px;"> </i>
                                    Managers List
                                </div>
                            </div>
                            <div class="card-header-tab card-header">
                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                    <p class="h5">Total Results: <span id="total"> </span></p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="search-list">
                                    <ul>
                                        <li>
                                            <input type="text" placeholder="Manager Name" class="form-control"
                                                   id="manager">
                                        </li>
                                        <li>
                                            <select class="form-control select-dropdown" id="property">
                                                <option></option>
                                                @foreach($properties as $property)
                                                    <option value="{{$property->id}}">
                                                        {{$property->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </li>
                                        <li><input type="submit" value="Search" onclick="loadData(10)"></li>
                                    </ul>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Manager Name</th>
                                            <th>Phone Number</th>
                                            <th>Email</th>
                                            <th>Properties</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="showManagers">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="box">
                                    <ul id="pagination-data" class="pagination"></ul>
                                    <div class="show"></div>
                                </div>
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
            loadData(10);
            $('.multiple-select').select2();
            $('.select-dropdown').select2({
                placeholder: "Select Property",
                allowClear: true
            });
            $("#manager-form").validate({
                rules: {
                    name: {
                        required: true,
                    },
                    number: {
                        required: true,
                    },
                    email: {
                        required: true,
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    password_confirmation: {
                        required: true,
                        minlength: 5,
                        equalTo: "#password"
                    }
                },
                messages: {
                    name: {
                        required: 'Name is required',
                    },
                    number: {
                        required: 'Number is required',
                    },
                    email: {
                        required: 'Email is manager',
                    },
                    password: {
                        required: 'Password is required',
                        minlength: 'Password length should be equal to or greater than 5 characters',

                    },
                    password_confirmation: {
                        equalTo: 'Password does not match',
                    }
                },
                submitHandler: function (form) {
                    let url,type,data = '';
                    if ($('.action').hasClass('edit')) {
                        url = "{{route('admin.update.manager')}}";
                        type = 'PUT';
                        data = $(form).serialize();
                    } else {
                        url = "{{route('admin.create.manager')}}";
                        type = 'POST';
                        data = $(form).serialize();
                    }
                    $.ajax({
                        type: type,
                        url: url,
                        data: data,
                        success: function (res) {
                            $("#manager-form")[0].reset();
                            $('.action').removeClass('edit btn-warning').addClass('btn-primary').text('Add New Manager');
                            $('#page-title').text('Add New Manager');
                            $('.multiple-select').val(null).trigger('change');
                            $('#password').prop('disabled', false);
                            $('#password_confirmation').prop('disabled', false);
                            loadData(10);
                            Swal.fire({
                                title: res.title,
                                text: res.text,
                                icon: 'success',
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

        function editManager(id) {
            let url = '{{route('admin.edit.manager',[":id"])}}';
            url = url.replace(':id', id);
            $('#password').prop('disabled', true)
            $('#password_confirmation').prop('disabled', true)
            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    let data = response.manager[0];
                    let properties_ids = [];
                    if (data.properties.length > 0) {
                        for (let i = 0; i < data.properties.length; i++) {
                            properties_ids.push(data.properties[i].id);
                        }
                    }
                    $('#manager_id').val(data.id);
                    $('#name').val(data.name);
                    $('#number').val(data.number);
                    $('#email').val(data.email);

                    $('.multiple-select').val(properties_ids).trigger('change');
                    $('.action').text('Edit Manager').removeClass('btn-primary').addClass('btn-warning edit');
                    $('#page-title').text('Edit Manager');
                }, beforeSend: function () {
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
            })
        }

        function deleteManager(id) {

            Swal.fire(
                'Are you sure?',
                'You want to delete manager!',
                'question'
            ).then(function () {
                let url = '{{route('admin.delete.manager',[":id"])}}';
                url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        "_token": "{{csrf_token()}}"
                    },
                    success: function (res) {
                        Swal.fire({
                            title: res.title,
                            text: res.text,
                            icon: 'success',
                            confirmButtonColor: '#228B22',
                        });
                        loadData(10)
                    }, beforeSend: function () {
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
                })
            });


        }

        function loadData(length) {
            $('#pagination-data').pagination({
                total: 1,
                current: 1,
                length: length,
                size: 1,
                ajax: function (options, refresh, $target) {
                    let html = '';
                    let property = $('#property').val();
                    let manager = $('#manager').val();
                    $.ajax({
                        url: "{{route('admin.managers.ajax')}}",
                        type: 'post',
                        data: {
                            current: options.current,
                            length: options.length,
                            "_token": "{{ csrf_token() }}",
                            "property": property,
                            "managerName": manager
                        },
                        success: function (response) {
                            $('#total').text(response.total);
                            for (let i = 0; i < response.managers.length; i++) {
                                html +=
                                    '<tr>\n' +
                                    '<td>' + response.managers[i].name + '</td>\n' +
                                    '<td>' + response.managers[i].number + '</td>\n' +
                                    '<td>' + response.managers[i].email + '</td>\n' +
                                    '<td>' + checkArray(response.managers[i].properties) + '</td>\n' +
                                    '<td>\n' +
                                    '<a href="javascript:void(0)"\n' +
                                    'onclick="editManager(' + response.managers[i].id + ')" ' +
                                    'class="table-btn">\n' +
                                    'Edit\n' +
                                    '</a>\n' +
                                    '<a href="javascript:void(0)"\n' +
                                    'class="table-btn" ' +
                                    'onclick="deleteManager(' + response.managers[i].id + ')">\n' +
                                    'Delete\n' +
                                    '</a>\n' +
                                    '</td>\n' +
                                    '</tr>'
                            }
                            if (html === '') {
                                $('.showManagers').html('<tr> ' +
                                    '<td></td> ' +
                                    '<td></td> ' +
                                    '<td>  No manager found!  </td> ' +
                                    '<td></td> ' +
                                    '<td></td> ' +
                                    '</tr>');
                            } else {
                                $('.showManagers').html(html);
                            }
                            refresh({
                                total: response.total,
                                length: length
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
                    })
                }
            });
        }
    </script>
@endsection
