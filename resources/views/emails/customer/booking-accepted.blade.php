<!DOCTYPE html>
<html>

<body style="font-family:Arial,sans-serif;background:#f4f5f7;padding:24px;">
    <table width="100%" align="center">
        <tr>
            <td align="center">
                <table width="600" style="background:#ffffff;border-radius:8px;padding:24px;">
                    <tr>
                        <td>
                            <h2 style="color:#16a34a;">✅ Booking Servis Diterima</h2>

                            <p>Halo <strong>{{ $order->customer_name }}</strong>,</p>

                            <p>
                                Booking servis online Anda di
                                <strong>{{ $order->mitra->business_name }}</strong>
                                telah <strong>DITERIMA</strong>.
                            </p>

                            <ul>
                                <li>Keluhan: {{ $order->customer_complain }}</li>
                                <li>Status: {{ strtoupper($order->status) }}</li>
                            </ul>

                            <p>
                                Silakan datang sesuai jadwal atau pantau status servis Anda.
                            </p>

                            <p>
                                — {{ config('app.name') }}
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
