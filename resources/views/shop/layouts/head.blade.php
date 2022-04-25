<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('shop/images/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('shop/images/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('shop/images/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('shop/images/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('shop/images/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('shop/images/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('shop/images/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('shop/images/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('shop/images/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"
        href="{{ asset('shop/images/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('shop/images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('shop/images/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('shop/images/favicon/favicon-16x16.png') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('shop/images/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="{{ asset('shop/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('shop/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('shop/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('shop/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('shop/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('shop/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('shop/css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('shop/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('shop/css/jquery.timepicker.css') }}">


    <link rel="stylesheet" href="{{ asset('shop/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('shop/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('shop/css/notyf.min.css') }}">
    <link rel="stylesheet" href="{{ asset('shop/scss/style.css') }}">
    <link rel="stylesheet" href="{{ asset('shop/css/custom.css') }}">
    @stack('styles')
</head>
