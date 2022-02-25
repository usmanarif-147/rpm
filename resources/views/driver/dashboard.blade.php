@extends('layouts.driver_layout')

@section('content')
    <!--// Main Content \\-->
    <div class="rpm-main-content banner-wrapper">

        <!--// Main Section \\-->
        <div class="rpm-main-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="rpm-title">
                            <h1>RPM PARKING MANAGEMENT</h1>
                            <p>Multi-Family,  Businesses,  Commercial properties</p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="search-form">
                            <form>
                                <h2>Search a plate #</h2>
                                <div class="clearfix"></div>
                                <ul>
                                    <li>
                                        <input type="text" class="form-control" id="autofill" placeholder="Property Name">
                                    </li>
                                    <li>
                                        <input type="text" class="form-control" placeholder="Lic Plate">
                                    </li>
                                    <li><button type="submit" class="submit-btn">Search <i class="fas fa-long-arrow-alt-right"></i></button></li>
                                </ul>
                            </form>
                        </div>
                        <div class="search-list">
                            <h2>Search Result</h2>
                            <table class="table">
                                <tr>
                                    <th>Property Name</th>
                                    <th>Make</th>
                                    <th>Modal</th>
                                    <th>LC Plate</th>
                                    <th>Check Details</th>
                                </tr>
                                <tr>
                                    <td>Cedar Point</td>
                                    <td>Honda</td>
                                    <td>Cxred12</td>
                                    <td>020K4A</td>
                                    <td><a href="javascript:void(0)" class="table-btn open-detail">View Details</a></td>
                                </tr>
                                <tr>
                                    <td>Cedar Point</td>
                                    <td>Honda</td>
                                    <td>Cxred12</td>
                                    <td>020K4A</td>
                                    <td><a href="javascript:void(0)" class="table-btn open-detail">View Details</a></td>
                                </tr>
                                <tr>
                                    <td>Cedar Point</td>
                                    <td>Honda</td>
                                    <td>Cxred12</td>
                                    <td>020K4A</td>
                                    <td><a href="javascript:void(0)" class="table-btn open-detail">View Details</a></td>
                                </tr>
                            </table>
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
        <a href="javascript:void(0)" class="crossX fa fa-times"></a>
        <div class="details-content">

        </div>
    </div>
    <!-- Flight Details END -->
@endsection
