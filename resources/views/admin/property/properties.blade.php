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
                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                    <i class="pe-7s-way mr-3 text-muted opacity-6"
                       style="font-size: 35px; color: #be1b20 !important;">
                    </i>
                    <span id="page-title">Add New Property</span>
                </div>
            </div>
            <div class="tabs-animation">
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body">

                                <form id="property-form">
                                    @csrf
                                    <input type="hidden" id="property_id" name="id" value="">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Property Name</label>
                                                <input type="text" class="form-control"
                                                       placeholder="Property Name" name="name"
                                                       value="{{old('name')}}" id="name">
                                                @error('name')
                                                <label class="error" for="name">{{$message}}</label>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Property Address</label>
                                                <input type="text" class="form-control"
                                                       placeholder="Property Address" name="address"
                                                       value="{{old('address')}}" id="address">
                                                @error('address')
                                                <label class="error" for="address">{{$message}}</label>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Manager Name</label>
                                                <select class="form-control multiple-select"
                                                        name="managers[]" multiple="multiple" id="managers">
                                                    @foreach($managers as $manager)
                                                        <option value="{{$manager->id}}">
                                                            {{$manager->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('managers')
                                                <label class="error" for="managers">{{$message}}</label>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Property Status</label>
                                                <select name="status" class="form-control" id="status">
                                                    <option value="1" {{old('status') == "1" ? 'selected' : ''}}>
                                                        Activate
                                                    </option>
                                                    <option value="0" {{old('status') == "0" ? 'selected' : ''}}>
                                                        Deactivate
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn pull-right btn-primary action">Add Property
                                    </button>
                                    <div class="clearfix"></div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-header-tab card-header">
                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                                            class="pe-7s-portfolio mr-3 text-muted opacity-6"
                                            style="font-size: 35px;"> </i>Active Properties
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
                                            <input type="text" placeholder="Property Name"
                                                   id="property" class="form-control">
                                        </li>
                                        {{--<li>--}}
                                        {{--<input type="text" placeholder="Manager Name"--}}
                                        {{--id="manager" class="form-control">--}}
                                        {{--</li>--}}
                                        <li>
                                            <select class="form-control select-dropdown" id="manager">
                                                <option></option>
                                                @foreach($managers as $manager)
                                                    <option value="{{$manager->id}}">
                                                        {{$manager->name}}
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
                                            <th>Property Name</th>
                                            <th>Property Address</th>
                                            <th>Manager</th>
                                            <th>Driver</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>

                                        <tbody class="showProperties">
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
                placeholder: "Select Manager",
                allowClear: true
            });
            $("#property-form").validate({
                rules: {
                    name: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                    managers: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: 'Property name is required',
                    },
                    address: {
                        required: 'Property address is required',
                    },
                    managers: {
                        required: 'Please select at least one manager',
                    },
                },
                submitHandler: function (form) {
                    let url = '';
                    let formData = $(form).serialize();
                    if ($('.action').hasClass('edit')) {
                        url = "{{route('admin.update.property')}}";
                    }
                    else {
                        url = "{{route('admin.create.property')}}";
                    }
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: formData,
                        success: function (res) {
                            $("#property-form")[0].reset();
                            $('.action').removeClass('edit btn-warning').addClass('btn-primary').text('Add Property');
                            $('#page-title').text('Add New Property');
                            $('.multiple-select').val(null).trigger('change');
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

        function editProperty(id) {
            let url = '{{route('admin.edit.property',[":id"])}}';
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    let data = response.property[0];
                    let managers_ids = [];
                    if(data.managers.length > 0){
                        for (let i=0; i<data.managers.length; i++){
                            managers_ids.push(data.managers[i].id);
                        }
                    }

                    $('#name').val(data.name);
                    $('#address').val(data.address);
                    $('#status').val(data.status);


                    $('.multiple-select').val(managers_ids).trigger('change');

                    $('#property_id').val(data.id);
                    $('.action').text('Edit Property').removeClass('btn-primary').addClass('btn-warning edit');
                    $('#page-title').text('Edit Property');
                },beforeSend: function () {
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

        function deactivateProperty(id) {

            Swal.fire(
                'Are you sure?',
                'You want to deactivate this property!',
                'question'
            ).then(function () {
                let url = '{{route('admin.deactivate.property',[":id"])}}';
                url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    type: "POST",
                    data:{
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
                    },beforeSend: function () {
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
                        url: "{{route('admin.active.properties.ajax')}}",
                        type: 'post',
                        data: {
                            current: options.current,
                            length: options.length,
                            "_token": "{{ csrf_token() }}",
                            "propertyName": property,
                            "manager": manager
                        },
                        success: function (response) {
                            $('#total').text(response.total);
                            for (let i = 0; i < response.properties.length; i++) {
                                html +=
                                    '<tr>\n' +
                                    '<td>' + response.properties[i].name + '</td>\n' +
                                    '<td>' + response.properties[i].address + '</td>\n' +
                                    '<td>' + checkArray(response.properties[i].managers) + '</td>\n' +
                                    '<td>' + checkArray(response.properties[i].drivers) + '</td>\n' +
                                    '<td>\n' +
                                    '<a href="javascript:void(0)"\n' +
                                    'onclick="editProperty(' + response.properties[i].id + ')" ' +
                                    'class="table-btn">\n' +
                                    'Edit\n' +
                                    '</a>\n' +
                                    '<a href="javascript:void(0)"\n' +
                                    'class="table-btn" ' +
                                    'onclick="deactivateProperty(' + response.properties[i].id + ')">\n' +
                                    'Deactive\n' +
                                    '</a>\n' +
                                    '</td>\n' +
                                    '</tr>'
                            }
                            if (html === '') {
                                $('.showProperties').html('<tr class="text-center"> ' +
                                    '<td></td> ' +
                                    '<td> No property found! </td> ' +
                                    '<td></td> ' +
                                    '<td></td> ' +
                                    '</tr>');
                            } else {
                                $('.showProperties').html(html);
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
