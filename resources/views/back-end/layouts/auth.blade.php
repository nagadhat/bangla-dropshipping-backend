<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Log in | Adminto - Responsive Bootstrap 4 Admin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('back-end/assets/images/favicon.ico')}}">

        <!-- Bootstrap Css -->
        <link href="{{asset('back-end/assets/css/bootstrap.min.css')}}" id="bootstrap-stylesheet" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('back-end/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('assets/css/app.min.css')}}" id="app-stylesheet" rel="stylesheet" type="text/css" />

    </head>

    <body class="authentication-bg">

        @yield('login')
        @yield('registration')

        <!-- Vendor js -->
        <script src="{{asset('assets/js/vendor.min.js')}}"></script>

        <!-- App js -->
        <script src="{{asset('assets/js/app.min.js')}}"></script>
        
    </body>
</html>