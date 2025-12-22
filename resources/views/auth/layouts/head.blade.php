<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ServiCycle </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />

    <style>
        :root {
            --sc-primary: #4f46e5;
            --sc-primary-dark: #4338ca;
        }

        /* override bootstrap primary */
        .bg-primary {
            background-color: var(--sc-primary) !important;
        }

        .btn-primary {
            background-color: var(--sc-primary);
            border-color: var(--sc-primary);
        }

        .btn-primary:hover {
            background-color: var(--sc-primary-dark);
            border-color: var(--sc-primary-dark);
        }

        .text-primary {
            color: var(--sc-primary) !important;
        }

        .nav-pills .nav-link.active {
            background-color: var(--sc-primary);
        }
    </style>
</head>
