<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>RPM Admin</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    <meta name="description" content="">

    <!-- Styles -->
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link rel="shortcut icon" href="{{asset('project/admin/assets/images/favicon.png')}}" type="image/png"/>
    <link href="{{asset('project/admin/assets/main.css')}}" rel="stylesheet">
    <link href="{{asset('project/admin/assets/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('project/admin/assets/file-input/fileinput.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('project/admin/assets/file-input/theme.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{asset('project/admin/assets/select/select2.min.css')}}">
    <link href="{{asset('project/admin/style.css')}}" rel="stylesheet">
    <link href="{{asset('project/admin/assets/responsive.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('dist/pagination.min.css')}}">
    @yield('css')
</head>

<body>
<div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
    @include('includes.admin.header')
    <div class="app-main">
        @include('includes.admin.sidebar')

        @yield('content')

    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>
<script type="text/javascript" src="{{asset('project/admin/assets/scripts/main.js')}}"></script>
<script type="text/javascript" src="{{asset('project/admin/assets/scripts/file-input/sortable.js')}}"></script>
<script type="text/javascript" src="{{asset('project/admin/assets/scripts/file-input/fileinput.js')}}"></script>
<script type="text/javascript" src="{{asset('project/admin/assets/scripts/file-input/theme.js')}}" ></script>
<script type="text/javascript" src="{{asset('project/admin/assets/scripts/jquery.tagsinput.min.js')}}"></script>
<script type="text/javascript" src="{{asset('project/admin/assets/scripts/functions.js')}}"></script>
<script type="text/javascript" src="{{asset('project/helper.js')}}"></script>
<!--plugins js-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.js"></script>
<script type="text/javascript" src="{{asset('project/admin/assets/scripts/select/select2.full.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.js"
        integrity="sha256-oQaw+JJuUcJQ9QVYMcFnPxICDT+hv8+kuxT2FNzTGhc=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{asset('dist/pagination.min.js')}}"></script>

@yield('script')
</body>

</html>