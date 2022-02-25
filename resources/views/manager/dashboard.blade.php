@extends('layouts.manager_layout')

@section('content')
    <!--// Main Content \\-->
    <div class="rpm-main-content">

        <!--// Main Section \\-->
        <div class="rpm-main-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard-box">
                            <ul>
                                <li>
                                    <a href="javascript:void(0)" onclick="loadData(10,'active')">
                                        <div class="box">
                                            <img src="{{asset('project/user/images/car.png')}}" alt="">
                                            <section>
                                                <h2>Active Permits</h2>
                                                <span>20+</span>
                                            </section>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" onclick="loadData(10, 'expired')">
                                        <div class="box">
                                            <img src="{{asset('project/user/images/car.png')}}" alt="">
                                            <section>
                                                <h2>Expired Permits</h2>
                                                <span>10+</span>
                                            </section>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="search-form">
                            <h2>Search</h2>
                            <p><strong>TIP:</strong> To view ALL visitor entries click "SEARCH" at the bottom for
                                your page</p>
                            <div class="clearfix"></div>
                            <ul>
                                <li>
                                    <select id="property" class="form-control">
                                        <option value="0"> Select Property</option>
                                        @foreach($properties as $property)
                                            <option value="{{$property->id}}"> {{$property->name}} </option>
                                        @endforeach
                                    </select>
                                </li>
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
                                    <input type="text" class="form-control" placeholder="Resident Name"
                                           id="resident_name">
                                </li>
                                <li>
                                    <button type="submit" class="btn submit-btn" onclick="loadData(10,0)">Search <i
                                            class="fas fa-long-arrow-alt-right"></i></button>
                                </li>
                            </ul>
                        </div>
                        <div class="search-list">
                            <h2>Search Result: <span id="total"></span></h2>

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

                                <tbody class="showManagerVehicles">
                                </tbody>
                            </table>
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
        <!--// Main Section \\-->

    </div>
    <!--// Main Content \\-->

    <!-- Flight Details START -->
    <div class="details-wrapper">
        <a href="javascript:void(0)" class="crossX fa fa-times" onclick="hideDetails()"></a>
        <div class="details-content">
            <div class="search-list">
                <table class="table detail-table">
                    <tr>
                        <th>Date</th>
                        <td id="v-date">2/1/22</td>
                    </tr>
                    <tr>
                        <th>Property Name</th>
                        <td id="v-property-address">Property Address</td>
                    </tr>
                    <tr>
                        <th>Registration Time</th>
                        <td id="v-registration-time">09:00 AM</td>
                    </tr>
                    <tr>
                        <th>Resident Name</th>
                        <td id="v-resident-name">John Doe</td>
                    </tr>
                    <tr>
                        <th>Make</th>
                        <td id="v-make">Honda</td>
                    </tr>
                    <tr>
                        <th>Modal</th>
                        <td id="v-modal">C300</td>
                    </tr>
                    <tr>
                        <th>Plate #</th>
                        <td id="v-license">020K4A</td>
                    </tr>
                    <tr>
                        <th>Apartment</th>
                        <td id="v-apartment">2022</td>
                    </tr>
                    <tr>
                        <th>Time On-side (Hours)</th>
                        <td id="v-time-left">10</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <!-- Flight Details END -->
@endsection
@section('script')
    <script>
        $(document).ajaxStop($.unblockUI);
        $(document).ready(function () {
            loadData(10, 0);
            // $('.multiple-select').select2();
            // $('.select-dropdown').select2({
            //     placeholder: "Select Property",
            //     allowClear: true
            // });
        });

        function viewVehicle(id) {

            $.ajax({
                url: '{{route('manager.vehicle.details.ajax')}}',
                type: 'post',
                data: {
                    'id': id,
                    '_token': '{{csrf_token()}}'
                },
                success: function (response) {
                    $('#v-date').text(response.vehicle[0].date);
                    $('#v-property-address').text(response.vehicle[0].property.address);
                    $('#v-registration-time').text(response.vehicle[0].time);
                    $('#v-resident-name').text(response.vehicle[0].resident_name);
                    $('#v-make').text(response.vehicle[0].make);
                    $('#v-modal').text(response.vehicle[0].model);
                    $('#v-license').text(response.vehicle[0].license);
                    $('#v-apartment').text(response.vehicle[0].apartment_no);
                    $('#v-time-left').text(response.vehicle[0].time_left);
                }
            })

            $('.details-wrapper').addClass('active-pops');
        }

        function hideDetails() {
            $('.details-wrapper').removeClass('active-pops');
        }

        function loadData(length, val) {
            $('#pagination-data').pagination({
                total: 1,
                current: 1,
                length: length,
                size: 1,
                ajax: function (options, refresh, $target) {
                    let html = '';
                    let property = $('#property').val();
                    let make = $('#make').val();
                    let modal = $('#modal').val();
                    let license = $('#license').val();
                    let date = $('#date').val();
                    let apartment = $('#apartment').val();
                    let resident_name = $('#resident_name').val();
                    $.ajax({
                        url: "{{route('manager.vehicles.ajax')}}",
                        type: 'post',
                        data: {
                            current: options.current,
                            length: options.length,
                            "_token": "{{ csrf_token() }}",
                            "property": property,
                            "make": make,
                            "modal": modal,
                            "license": license,
                            "date": date,
                            "apartment": apartment,
                            "resident_name": resident_name,
                            "type": val
                        },
                        success: function (response) {
                            console.log(response.vehicles[0]);
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
                                    'onclick="viewVehicle('+ response.vehicles[i].id +')">\n' +
                                    'Details\n' +
                                    '</a>\n' +
                                    '</td>\n' +
                                    '</tr>'
                            }
                            if (html === '') {
                                $('.showManagerVehicles').html('<tr> ' +
                                    '<td></td> ' +
                                    '<td></td> ' +
                                    '<td>  No manager found!  </td> ' +
                                    '<td></td> ' +
                                    '<td></td> ' +
                                    '</tr>');
                            } else {
                                $('.showManagerVehicles').html(html);
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
