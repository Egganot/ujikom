<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ujikom | @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/img/BaseImage.jpg') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/adminLTE/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatables/datatable.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="wrapper d-flex flex-column min-vh-100">
        @if (!Request::is('login', 'register'))
            @include('components.navbar.head-navbar')

            <div class="body-wrapper">
                <div class="row justify-content-center">
                    <div class="col-md-12 px-5 mb-5">
        @endif

        @yield('konten')


        @if (!Request::is('login', 'register'))
    </div>
    </div>
    </div>

    <div class="footer-wrapper">
        @include('components.navbar.foot-navbar')
    </div>
    @endif
    </div>
</body>

<script src="{{ asset('assets/js/script.js') }}"></script>
<script src="{{ asset('assets/datatables/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/datatables/datatable.js') }}"></script>
<script src="{{ asset('assets/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/adminLTE/js/adminlte.min.js') }}"></script>
<script src="{{ asset('assets/fontawesome/js/all.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stack('scripts')

</html>
