<?php

namespace App\Mail;
namespace App\Mail;

use App\Models\Booking;
use App\Models\bookings;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Booking $booking
     */
    public function __construct(bookings $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Booking Reply Status Update')
                    ->view('emails.booking_reply') // You can create this email template
                    ->with([
                        'status' => $this->booking->status,
                        'reply' => $this->booking->reply,
                        'name'=>$this->booking->full_name,
                    ]);
    }
}
