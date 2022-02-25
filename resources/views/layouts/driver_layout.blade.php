
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
    <title>RPM Parking | Search</title>

    <!-- Css Files -->
    <link rel="shortcut icon" href="{{asset('project/user/images/favicon.png')}}" type="image/png" />
    <link href="{{asset('project/user/css/bootstrap.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link href="{{asset('project/user/style.css')}}" rel="stylesheet">
    <link href="{{asset('project/user/css/responsive.css')}}" rel="stylesheet">

</head>
<body>

<!--// Main Wrapper \\-->
<div class="rpm-main-wrapper">

    <!--// Header \\-->
    @include('includes.user.header')
    <!--// Header \\-->

    @yield('content')

    <!--// Footer \\-->
    @include('includes.user.footer')
    <!--// Footer \\-->

    <div class="clearfix"></div>
</div>
<!--// Main Wrapper \\-->


<!-- jQuery (necessary for JavaScript plugins) -->
<script type="text/javascript" src="{{asset('project/user/script/jquery.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{asset('project/user/script/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('project/user/script/functions.js')}}"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script>
    $('.open-detail').click(function() {
        $('.details-wrapper').addClass('active-pops');
    })
    $('.crossX').click(function() {
        $('.details-wrapper').removeClass('active-pops');
    });
</script>
<script>
    $( function() {
        var availableTags = [
            "ActionScript",
            "AppleScript",
            "Asp",
            "BASIC",
            "C",
            "C++",
            "Clojure",
            "COBOL",
            "ColdFusion",
            "Erlang",
            "Fortran",
            "Groovy",
            "Haskell",
            "Java",
            "JavaScript",
            "Lisp",
            "Perl",
            "PHP",
            "Python",
            "Ruby",
            "Scala",
            "Scheme"
        ];
        $( "#autofill" ).autocomplete({
            source: availableTags
        });
    });
</script>

</body>
</html>
