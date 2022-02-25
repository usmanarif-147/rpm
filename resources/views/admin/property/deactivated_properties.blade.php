@extends('layouts.admin_layout')
@section('css')
    <style>
        .select2-selection__rendered {
            line-height: 35px !important;
        }
        .select2-container .select2-selection--single {
            height: 35px !important;
        }
        .select2-selection__arrow {
            height: 35px !important;
        }
    </style>
@endsection
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="card-header-tab card-header">
                <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="pe-7s-way mr-3 text-muted opacity-6" style="font-size: 35px; color: #be1b20 !important;"> </i>Deactivate Properties</div>
            </div>
            <div class="tabs-animation">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="search-list">
                                    <ul>
                                        <li>
                                            <input type="text" id="property" placeholder="Property Name" class="form-control">
                                        </li>
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
                                        <li>
                                            <input type="submit" onclick="loadData(10)" value="Search">
                                        </li>
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
            $('.select-dropdown').select2({
                placeholder: "Select Manager",
                allowClear: true
            });
        });

        function activateProperty(id) {

            Swal.fire(
                'Are you sure?',
                'You want to activate this property!',
                'question'
            ).then(function () {
                let url = '{{route('admin.activate.property',[":id"])}}';
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
                        url: "{{route('admin.deactivated.properties.ajax')}}",
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
                                    'class="table-btn" ' +
                                    'onclick="activateProperty(' + response.properties[i].id + ')">\n' +
                                    'Activate\n' +
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
