<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Berhasil</title>
</head>

<body>

    <h2>Halo, {{ $user->name }} </h2>
    <p>Selamat! akun anda berhasil dibuat</p>
    <p>Silahkan login dan mulai menggunakan aplikasi kami.</p>
    <br>
    <p>Terima kasih, <br> Tim {{ config('app.name') }}</p>

</body>

</html>
