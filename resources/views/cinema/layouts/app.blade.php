<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('cinema.layouts.head')

<body>
    @include('cinema.layouts.preloader')

    @include('cinema.layouts.overlay')

    @include('cinema.layouts.header')

    @yield('content')

    @include('cinema.layouts.footer')

    @include('cinema.layouts.scripts')
</body>

</html>
