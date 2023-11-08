<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboard | Adminto - Responsive Bootstrap 4 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('back-end-assets/images/favicon.ico')}}">

    <!-- Bootstrap Css -->
    <link href="{{asset('back-end/assets/css/bootstrap.min.css')}}" id="bootstrap-stylesheet" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('back-end/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('back-end/assets/css/app.min.css') }}" id="app-stylesheet" rel="stylesheet" type="text/css" />
    @yield('styles')

</head>

<body>

    <!-- start wrapper page -->
    <div id="wrapper">
        @yield('header')
        @yield('left-sidebar')
        @yield('page-content')
    </div>
    <!-- END wrapper -->

    <!-- Vendor js -->
    <script src="{{asset('back-end/assets/js/vendor.min.js')}}"></script>

    <!-- knob plugin -->
    <script src="{{asset('back-end/assets/libs/jquery-knob/jquery.knob.min.js')}}"></script>

    <!--Morris Chart-->
    <script src="{{asset('back-end/assets/libs/morris-js/morris.min.js') }}"></script>
    <script src="{{asset('back-end/assets/libs/raphael/raphael.min.js') }}"></script>

    <!-- Dashboard init js-->
    <script src="{{asset('back-end/assets/js/pages/dashboard.init.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('back-end/assets/js/app.min.js')}}"></script>

    @yield('scripts')

</body>

</html>
