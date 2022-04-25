<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('shop.layouts.head')

<body class="goto-here">
    @include('shop.layouts.header')

    @yield('content')

    @include('shop.layouts.footer')
</body>

</html>
