@extends('layouts.admin_layout')

@section('css')
    <style>

    </style>
@endsection
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="tabs-animation">
                <div class="row">
                    <div class="col-md-12 dash-boxes">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="dash-box">
                                            <a href="{{route('admin.properties')}}">
                                                <i class="pe-7s-way"></i>
                                                <section>
                                                    <h2>{{$totalProperties}}</h2>
                                                    <span>Total Properties</span>
                                                </section>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="dash-box">
                                            <a href="{{route('admin.managers')}}">
                                                <i class="pe-7s-users"></i>
                                                <section>
                                                    <h2>{{$totalManagers}}</h2>
                                                    <span>Total Managers</span>
                                                </section>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="dash-box">
                                            <a href="{{route('admin.drivers')}}">
                                                <i class="pe-7s-car"></i>
                                                <section>
                                                    <h2>{{$totalDrivers}}</h2>
                                                    <span>Total Drivers</span>
                                                </section>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="dash-box">
                                            <a href="#">
                                                <i class="pe-7s-id"></i>
                                                <section>
                                                    <h2>{{$totalPermits}}</h2>
                                                    <span>Total Permits</span>
                                                </section>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-header-tab card-header">
                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                                            class="pe-7s-search mr-3 text-muted opacity-6"
                                            style="font-size: 35px;"> </i>Search
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="search-form">
                                    <ul>
                                        <li>
                                            <input type="text" class="form-control" placeholder="Make" id="make">
                                        </li>
                                        <li>
                                            <input type="text" class="form-control" placeholder="Modal" id="modal">
                                        </li>
                                        <li>
                                            <input type="text" class="form-control" placeholder="Lic Plate" id="license">
                                        </li>
                                        <li>
                                            <input type="date" class="form-control" placeholder="Date" id="date">
                                        </li>
                                        <li>
                                            <input type="text" class="form-control" placeholder="Apartment" id="apartment">
                                        </li>
                                        <li>
                                            <input type="text" class="form-control" placeholder="Resident Name" id="resident_name">
                                        </li>
                                        <li>
                                            <button type="submit" class="submit-btn" onclick="loadData(10)">Search <i
                                                    class="fas fa-long-arrow-alt-right"></i></button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-header-tab card-header">
                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                                            class="pe-7s-portfolio mr-3 text-muted opacity-6"
                                            style="font-size: 35px;"> </i>Search Results
                                </div>
                            </div>
                            <div class="card-header-tab card-header">
                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                    Total Results:  <span id="total"></span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Registration Time</th>
                                            <th>Resident Name</th>
                                            <th>Make</th>
                                            <th>Modal</th>
                                            <th>Plate #</th>
                                            <th>Apartment</th>
                                            <th>Time On-side (Hours)</th>
                                            <th>Check Details</th>
                                        </tr>
                                        </thead>
                                        <tbody class="showVehicles">
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
            // $('.multiple-select').select2();
            // $('.select-dropdown').select2({
            //     placeholder: "Select Property",
            //     allowClear: true
            // });
        });

        function loadData(length) {
            $('#pagination-data').pagination({
                total: 1,
                current: 1,
                length: length,
                size: 1,
                ajax: function (options, refresh, $target) {
                    let html = '';
                    let make = $('#make').val();
                    let modal = $('#modal').val();
                    let license = $('#license').val();
                    let date = $('#date').val();
                    let apartment = $('#apartment').val();
                    let resident_name = $('#resident_name').val();

                    console.log(make + '---' + modal + '---' + license + '---' + date + '---' + apartment + '---' + resident_name)

                    $.ajax({
                        url: "{{route('admin.vehicles.ajax')}}",
                        type: 'post',
                        data: {
                            current: options.current,
                            length: options.length,
                            "_token": "{{ csrf_token() }}",
                            "make": make,
                            "modal": modal,
                            "license": license,
                            "date": date,
                            "apartment": apartment,
                            "resident_name": resident_name,
                        },
                        success: function (response) {
                            $('#total').text(response.total);
                            for (let i = 0; i < response.vehicles.length; i++) {
                                html +=
                                    '<tr>\n' +
                                    '<td>' + response.vehicles[i].date + '</td>\n' +
                                    '<td>' + response.vehicles[i].time + '</td>\n' +
                                    '<td>' + response.vehicles[i].resident_name + '</td>\n' +
                                    '<td>' + response.vehicles[i].make + '</td>\n' +
                                    '<td>' + response.vehicles[i].model + '</td>\n' +
                                    '<td>' + response.vehicles[i].license + '</td>\n' +
                                    '<td>' + response.vehicles[i].apartment_no + '</td>\n' +
                                    '<td>' + response.vehicles[i].time_left + '</td>\n' +
                                    '<td>\n' +
                                    '<a href="javascript:void(0)"\n' +
                                    'class="table-btn" ' +
                                    'onclick="viewVehicle(' + response.vehicles[i].id + ')">\n' +
                                    'Details\n' +
                                    '</a>\n' +
                                    '</td>\n' +
                                    '</tr>'
                            }
                            if (html === '') {
                                $('.showVehicles').html('<tr> ' +
                                    '<td></td> ' +
                                    '<td></td> ' +
                                    '<td>  No manager found!  </td> ' +
                                    '<td></td> ' +
                                    '<td></td> ' +
                                    '</tr>');
                            } else {
                                $('.showVehicles').html(html);
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
