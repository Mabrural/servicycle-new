<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Booking Online Baru</title>
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
                            <img src="{{ asset('assets/images/logo-servicycle-purple.png') }}" alt="ServiCycle"
                                width="160" style="display:block;">

                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding:32px;">
                            <h2
                                style="margin:0 0 16px 0;
                                       font-size:22px;
                                       color:#111827;">
                                🔔 Booking Online Baru
                            </h2>

                            <p style="margin:0 0 16px 0;color:#374151;font-size:14px;">
                                Halo <strong>{{ $order->mitra->business_name }}</strong>,
                            </p>

                            <p style="margin:0 0 24px 0;color:#374151;font-size:14px;">
                                Anda menerima <strong>booking servis online baru</strong>
                                dengan detail berikut:
                            </p>

                            <!-- Info Table -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="font-size:14px;color:#374151;">
                                <tr>
                                    <td style="padding:10px 0;width:160px;color:#6b7280;">
                                        Nama Pelanggan
                                    </td>
                                    <td style="padding:10px 0;font-weight:600;">
                                        {{ $order->customer_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 0;color:#6b7280;">
                                        No HP
                                    </td>
                                    <td style="padding:10px 0;font-weight:600;">
                                        {{ $order->customer_phone }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 0;color:#6b7280;">
                                        Keluhan
                                    </td>
                                    <td style="padding:10px 0;font-weight:600;">
                                        {{ $order->customer_complain }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 0;color:#6b7280;">
                                        Status
                                    </td>
                                    <td style="padding:10px 0;font-weight:600;text-transform:uppercase;">
                                        {{ $order->status }}
                                    </td>
                                </tr>
                            </table>

                            <!-- CTA -->
                            <div style="margin-top:32px;text-align:center;">
                                <a href="{{ url('/mitra/service-orders') }}"
                                    style="display:inline-block;
                                          background:#6d28d9;
                                          color:#ffffff;
                                          text-decoration:none;
                                          padding:12px 24px;
                                          font-size:14px;
                                          font-weight:600;
                                          border-radius:8px;">
                                    Lihat Booking Masuk
                                </a>
                            </div>

                            <!-- Fallback -->
                            <p
                                style="margin-top:24px;
                                      font-size:12px;
                                      color:#6b7280;
                                      text-align:center;">
                                Atau salin link berikut ke browser Anda:<br>
                                <span style="color:#6d28d9;">
                                    {{ url('/mitra/service-orders') }}
                                </span>
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td
                            style="padding:20px 32px;
                                   background:#f9fafb;
                                   border-top:1px solid #e5e7eb;
                                   font-size:12px;
                                   color:#6b7280;
                                   text-align:center;">
                            © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>
