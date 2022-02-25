@extends('layouts.user_layout')
@section('content')
    <div class="rpm-main-content banner-wrapper">
        <div class="rpm-main-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="rpm-title">
                            <h1>get in touch with us</h1>
                            <p>Multi-Family, Businesses, Commercial properties</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="rpm-search-form">
                            <form>
                                <ul>
                                    <li>
                                        <label>Full Name</label>
                                        <input type="text" class="form-control" placeholder="">
                                    </li>
                                    <li>
                                        <label>Email Address</label>
                                        <input type="text" class="form-control" placeholder="">
                                    </li>
                                    <li>
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control" placeholder="">
                                    </li>
                                    <li>
                                        <label>Company</label>
                                        <input type="text" class="form-control" placeholder="">
                                    </li>
                                    <li>
                                        <label>Your Message</label>
                                        <textarea class="form-control"></textarea>
                                    </li>
                                    <li>
                                        <button type="submit" class="submit-btn">SUBMIT <i
                                                class="fas fa-long-arrow-alt-right"></i></button>
                                    </li>
                                </ul>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-info">
                            <ul>
                                <li>
                                    <i class="fa fa-globe"></i>
                                    <span><strong>Office Location:</strong> 1701 W Northwest Highway, Suite 100 Grapevine, Texas, 76051</span>
                                </li>
                                <li>
                                    <i class="fa fa-phone"></i>
                                    <span><strong>Phone:</strong> <a href="tel:972-215-9328">972-215-9328</a></span>
                                </li>
                                <li>
                                    <i class="fa fa-envelope"></i>
                                    <span><strong>Email:</strong> <a href="mailto:info@rpmparkingmanagement.com">info@rpmparkingmanagement.com</a></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            alert("contact page")
        })
    </script>
@endsection
