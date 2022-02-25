@extends('layouts.user_layout')
@section('css')
    <style>
        .rpm-search-form .error {
            color: red;
        }
        .select2-selection__rendered {
            line-height: 45px !important;
        }
        .select2-container .select2-selection--single {
            height: 45px !important;
        }
        .select2-selection__arrow {
            height: 45px !important;
        }
    </style>
@endsection
@section('content')
    <div class="rpm-main-content banner-wrapper">
        <div class="rpm-main-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="rpm-title">
                            <h1>RPM PARKING MANAGEMENT</h1>
                            <p>Multi-Family, Businesses, Commercial properties</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="rpm-search-form">
                            <form id="vehicle_registration">
                                @csrf
                                <ul>
                                    <li>
                                        <label>Property Name</label>
                                        <select name="property_id" class="form-control select-dropdown" id="property">
                                            <option></option>
                                            @foreach($properties as $property)
                                                <option value="{{$property->id}}"
                                                    {{old('property') == $property->id ? 'selected' : ''}}>
                                                    {{$property->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label id="property-error" class="error" for="property"></label>
                                    </li>
                                    <li>
                                        <label>Vehicle Make</label>
                                        <input type="text" class="form-control" placeholder="" name="make"
                                               value="{{old('make')}}" id="make">
                                        @error('make')
                                        <label id="make-error" class="error" for="make">{{$message}}</label>
                                        @enderror
                                    </li>
                                    <li>
                                        <label>Vehicle Model</label>
                                        <input type="text" class="form-control" placeholder="" name="model"
                                               value="{{old('model')}}">
                                        @error('model')
                                        <label id="model-error" class="error" for="model">{{$message}}</label>
                                        @enderror
                                    </li>
                                    <li>
                                        <label>License Plate (PAPER OR TEMP TAGS MUST ENTER PLATE#)</label>
                                        <input type="text" class="form-control" placeholder="" name="license"
                                               value="{{old('license')}}">
                                        @error('license')
                                        <label id="license-error" class="error" for="license">{{$message}}</label>
                                        @enderror
                                    </li>
                                    <li>
                                        <label>Resident Name</label>
                                        <input type="text" class="form-control" placeholder="" name="resident_name"
                                               value="{{old('resident_name')}}">
                                        @error('resident_name')
                                        <label id="resident_name-error" class="error"
                                               for="resident_name">{{$message}}</label>
                                        @enderror
                                    </li>
                                    <li>
                                        <label>Apartment #</label>
                                        <input type="text" class="form-control" placeholder="" name="apartment_no"
                                               value="{{old('apartment_no')}}">
                                        @error('apartment_no')
                                        <label id="apartment_no-error" class="error"
                                               for="apartment_no">{{$message}}</label>
                                        @enderror
                                    </li>
                                    <li>
                                        <label>E-mail My Confirmation</label>
                                        <input type="text" class="form-control" placeholder="" name="email"
                                               value="{{old('email')}}">
                                        @error('email')
                                        <label id="email-error" class="error" for="email">{{$message}}</label>
                                        @enderror
                                    </li>
                                    <li>
                                        <button type="submit" class="submit-btn">
                                            Register My Vehicle <i class="fas fa-long-arrow-alt-right"></i>
                                        </button>
                                    </li>
                                </ul>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="banner-text">
                            <img src="{{asset('project/user/images/parked-car.png')}}" alt="car-park">
                            <h2>RPM Parking Management is a company that puts the customer first.</h2>
                            <p>We provide clarity in the process and personalize service to our customers. When you
                                choose a service provider, you want to make sure that you are going with the best
                                service provider that you can find. Well, look no further! We offer the very best towing
                                service in the industry!</p>
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

            $('.select-dropdown').select2({
                placeholder: "Select Property",
                allowClear: true
            });
            $("#vehicle_registration").validate({
                rules: {
                    property_id: {
                        required: true,
                    },
                    make: {
                        required: true,
                    },
                    model: {
                        required: true,
                    },
                    license: {
                        required: true,
                    },
                    resident_name: {
                        required: true,
                    },
                    apartment_no: {
                        required: true,
                    },
                    email: {
                        required: true,
                    },
                },
                messages: {
                    property_id: {
                        required: 'Please select valid property',
                    },
                    make: {
                        required: 'Please enter vehicle make',
                    },
                    model: {
                        required: 'Please enter vehicle model',
                    },
                    license: {
                        required: 'Please enter vehicle license number',
                    },
                    resident_name: {
                        required: 'Please enter resident name',
                    },
                    apartment_no: {
                        required: 'Please enter apartment no',
                    },
                    email: {
                        required: 'Please enter email address',
                    },
                },
                submitHandler: function (form) {
                    $.ajax({
                        type: "POST",
                        url: "{{route('store.vehicle')}}",
                        data: $(form).serialize(),
                        success: function (res) {
                            console.log(res)
                            $("#vehicle_registration")[0].reset();
                            Swal.fire({
                                title: 'Vehicle Registration!',
                                text: 'Vehicle is registered for next 24 hours.',
                                icon: 'success',
                                confirmButtonColor: '#228B22',
                            });
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

