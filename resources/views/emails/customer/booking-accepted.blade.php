<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Booking Servis Diterima</title>
</head>

<body style="margin:0;padding:0;background-color:#f4f5f7;font-family:Arial,Helvetica,sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="padding:30px 0;">
        <tr>
            <td align="center">

                <!-- Card -->
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background:#ffffff;border-radius:10px;
                       box-shadow:0 8px 24px rgba(0,0,0,0.06);
                       overflow:hidden;">

                    <!-- Header -->
                    <tr>
                        <td style="padding:24px 32px;border-bottom:1px solid #e5e7eb;">
                            <img src="{{ config('app.url') }}/assets/images/logo-servicycle-purple.png" alt="ServiCycle"
                                width="160" style="display:block;">
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding:32px;">
                            <h2 style="margin:0 0 16px 0;font-size:22px;color:#111827;">
                                ✅ Booking Servis Diterima
                            </h2>

                            <p style="margin:0 0 16px 0;color:#374151;font-size:14px;">
                                Halo <strong>{{ $order->customer_name }}</strong>,
                            </p>

                            <p style="margin:0 0 24px 0;color:#374151;font-size:14px;">
                                Kabar baik! Booking servis online Anda telah
                                <strong>diterima oleh bengkel</strong>.
                            </p>

                            <!-- Info -->
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
                                <tr>
                                    <td style="padding:10px 0;color:#6b7280;">Batas Check-in</td>
                                    <td style="padding:10px 0;font-weight:600;">
                                        {{ optional($order->check_in_deadline)->format('d M Y H:i') }} WIB
                                    </td>
                                </tr>
                            </table>

                            <!-- CTA -->
                            <div style="margin-top:32px;text-align:center;">
                                <a href="{{ url('/customer/bookings') }}"
                                    style="display:inline-block;
                                      background:#16a34a;
                                      color:#ffffff;
                                      text-decoration:none;
                                      padding:12px 24px;
                                      font-size:14px;
                                      font-weight:600;
                                      border-radius:8px;">
                                    Lihat Detail Booking
                                </a>
                            </div>

                            <p style="margin-top:24px;font-size:12px;color:#6b7280;text-align:center;">
                                Jika tombol tidak berfungsi, salin link berikut:<br>
                                <span style="color:#16a34a;">
                                    {{ url('/customer/bookings') }}
                                </span>
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
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
