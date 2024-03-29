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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/2495b99d21.js" crossorigin="anonymous"></script>
    <!-- This css use for brands page -->
    <link rel="stylesheet" href="{{ asset('back-end/assets/css/style.css') }}">
    <link href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" id="app-stylesheet" rel="stylesheet" type="text/css" />

    <!-- css for summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

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

    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    
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

    <!-- js for summernote -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    @yield('scripts')

</body>

</html>
