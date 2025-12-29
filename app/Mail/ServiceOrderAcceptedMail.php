<?php
namespace App\Mail;

use App\Models\ServiceOrder;
use Illuminate\Mail\Mailable;

class ServiceOrderAcceptedMail extends Mailable
{
    public ServiceOrder $order;

    public function __construct(ServiceOrder $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('✅ Booking Servis Anda Diterima')
            ->view('emails.customer.booking-accepted');
    }
}
