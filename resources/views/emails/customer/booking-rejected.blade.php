<!DOCTYPE html>
<html>

<body style="font-family:Arial,sans-serif;background:#f4f5f7;padding:24px;">
    <table width="100%" align="center">
        <tr>
            <td align="center">
                <table width="600" style="background:#ffffff;border-radius:8px;padding:24px;">
                    <tr>
                        <td>
                            <h2 style="color:#dc2626;">❌ Booking Servis Ditolak</h2>

                            <p>Halo <strong>{{ $order->customer_name }}</strong>,</p>

                            <p>
                                Mohon maaf, booking servis online Anda di
                                <strong>{{ $order->mitra->business_name }}</strong>
                                <strong>DITOLAK</strong>.
                            </p>

                            <p>
                                Silakan mencoba bengkel lain atau mengatur ulang jadwal.
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
