<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="RPM Parking">
    <meta name="keywords" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>RPM Parking | Home Page</title>

    <!-- Css Files -->
    <link rel="shortcut icon" href="{{asset('project/user/images/favicon.png')}}" type="image/png"/>
    <link href="{{asset('project/user/css/bootstrap.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
          integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link href="{{asset('project/user/style.css')}}" rel="stylesheet">
    <link href="{{asset('project/user/css/responsive.css')}}" rel="stylesheet">

    {{--plugins css--}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @yield('css')
</head>
<body>

<!--// Main Wrapper \\-->
<div class="rpm-main-wrapper">

    <!--// Header \\-->
@include('includes.user.header')
<!--// Header \\-->


    <!--// Main Content \\-->
    @yield('content')
    <!--// Main Content \\-->

    <!--// Footer \\-->
@include('includes.user.footer')
<!--// Footer \\-->

    <div class="clearfix"></div>
</div>
<!--// Main Wrapper \\-->


<!-- jQuery (necessary for JavaScript plugins) -->
<script type="text/javascript" src="{{asset('project/user/script/jquery.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script type="text/javascript" src="{{asset('project/user/script/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('project/user/script/functions.js')}}"></script>

<!--plugins js-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.js"
        integrity="sha256-oQaw+JJuUcJQ9QVYMcFnPxICDT+hv8+kuxT2FNzTGhc=" crossorigin="anonymous"></script>

@yield('script')

</body>
</html>
