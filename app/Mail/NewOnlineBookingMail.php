<?php

namespace App\Mail;

use App\Models\ServiceOrder;
use Illuminate\Mail\Mailable;

class NewOnlineBookingMail extends Mailable
{
    public ServiceOrder $order;

    public function __construct(ServiceOrder $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('🔔 Booking Online Baru Masuk')
            ->view('emails.mitra.new-booking');
    }
}
