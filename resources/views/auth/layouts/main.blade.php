<!DOCTYPE html>
<html lang="en">
@include('auth.layouts.head')
@stack('styles')

<body>
    @yield('container')
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('auth.layouts.script')
    <!-- endinject -->
    @stack('scripts')
</body>

</html>
