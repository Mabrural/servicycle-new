<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title') | ServiCycle</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ServiCycle - Platform manajemen dan langganan layanan servis kendaraan">

    <link rel="stylesheet" href="{{ asset('css/static-pages.css') }}">
</head>

<body>

    <main class="container">
        @yield('content')
    </main>

    <footer class="footer">
        © {{ date('Y') }} ServiCycle. All rights reserved.
    </footer>

</body>

</html>
