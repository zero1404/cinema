<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('dashboard.layouts.head')

<body>
  <main class="py-4">
    @yield('content')
  </main>
</body>

</html>