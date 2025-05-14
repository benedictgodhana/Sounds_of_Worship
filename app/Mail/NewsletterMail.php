<?php
namespace App\Mail;
use Illuminate\Mail\Mailable;

class NewsletterMail extends Mailable
{
    public $content;
    public $trips;

    public function __construct($content, $trips)
    {
        $this->content = $content;
        $this->trips = $trips;
    }

    public function build()
    {
        return $this->subject('Globestitch Newsletter')
                    ->view('emails.newsletter')
                    ->with([
                        'content' => $this->content,
                        'trips' => $this->trips,
                    ]);
    }
}
