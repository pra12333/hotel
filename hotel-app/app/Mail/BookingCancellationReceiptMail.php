<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingCancellationReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $refundAmount;
    public $retainedAmount;

    public function __construct($booking, $refundAmount, $retainedAmount)
    {
        $this->booking = $booking;
        $this->refundAmount = $refundAmount;
        $this->retainedAmount = $retainedAmount;
    }

    public function build()
    {
        return $this->subject('Booking Cancellation Receipt')
            ->view('emails.cancellation_receipt')
            ->with([
                'booking' => $this->booking,
                'refundAmount' => $this->refundAmount,
                'retainedAmount' => $this->retainedAmount,
            ]);
    }
}
