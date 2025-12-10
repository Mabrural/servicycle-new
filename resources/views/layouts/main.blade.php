<!DOCTYPE html>
<html lang="en">

@include('layouts.head')

<body class="with-welcome-text">
    <div class="container-scroller">
        
        @include('layouts.navbar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            @include('layouts.sidebar')
            <!-- partial -->
            @yield('container')
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('layouts.script')
</body>

</html>
