<?php

namespace App\Mail;

use App\Models\ServiceOrder;
use Illuminate\Mail\Mailable;

class ServiceOrderRejectedMail extends Mailable
{
    public ServiceOrder $order;

    public function __construct(ServiceOrder $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('❌ Booking Servis Anda Ditolak')
            ->view('emails.customer.booking-rejected');
    }
}
