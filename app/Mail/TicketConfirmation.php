<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;
    public $event;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
        $this->event = $ticket->event;
    }

    public function build()
    {
        return $this->markdown('emails.ticket-confirmation')
            ->subject('Your Ticket Confirmation - ' . $this->event->title);
    }
}
