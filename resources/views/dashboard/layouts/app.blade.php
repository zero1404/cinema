<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('dashboard.layouts.head')

<body>
    <!-- Start sidebar -->
    @include('dashboard.layouts.sidebar')
    <!-- End sidebar -->

    <main class="content">
        <!-- Start header -->
        @include('dashboard.layouts.header')
        <!-- End header -->

        <!-- Start content -->
        @yield('content')
        <!-- End content -->

        <!-- Start footer -->
        @include('dashboard.layouts.footer')
        <!-- End footer -->
    </main>

    @include('dashboard.layouts.scripts')
</body>

</html>