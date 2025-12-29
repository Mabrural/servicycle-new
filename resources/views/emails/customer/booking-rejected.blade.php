<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Booking Servis Ditolak</title>
</head>

<body style="margin:0;padding:0;background-color:#f4f5f7;font-family:Arial,Helvetica,sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="padding:30px 0;">
        <tr>
            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0"
                    style="background:#ffffff;border-radius:10px;
                       box-shadow:0 8px 24px rgba(0,0,0,0.06);
                       overflow:hidden;">

                    <tr>
                        <td style="padding:24px 32px;border-bottom:1px solid #e5e7eb;">
                            <img src="{{ config('app.url') }}/assets/images/logo-servicycle-purple.png" alt="ServiCycle"
                                width="160" style="display:block;">
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:32px;">
                            <h2 style="margin:0 0 16px 0;font-size:22px;color:#991b1b;">
                                ❌ Booking Servis Ditolak
                            </h2>

                            <p style="margin:0 0 16px 0;color:#374151;font-size:14px;">
                                Halo <strong>{{ $order->customer_name }}</strong>,
                            </p>

                            <p style="margin:0 0 24px 0;color:#374151;font-size:14px;">
                                Mohon maaf, booking servis online Anda
                                <strong>tidak dapat diproses oleh bengkel</strong>.
                            </p>

                            <table width="100%" cellpadding="0" cellspacing="0" style="font-size:14px;color:#374151;">
                                <tr>
                                    <td style="padding:10px 0;width:180px;color:#6b7280;">Bengkel</td>
                                    <td style="padding:10px 0;font-weight:600;">
                                        {{ $order->mitra->business_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 0;color:#6b7280;">Keluhan</td>
                                    <td style="padding:10px 0;font-weight:600;">
                                        {{ $order->customer_complain }}
                                    </td>
                                </tr>
                            </table>

                            <p style="margin-top:24px;font-size:13px;color:#6b7280;">
                                Anda dapat mencoba melakukan booking ulang atau memilih bengkel lain.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td
                            style="padding:20px 32px;background:#f9fafb;
                               border-top:1px solid #e5e7eb;
                               font-size:12px;color:#6b7280;text-align:center;">
                            © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>
</body>

</html>
