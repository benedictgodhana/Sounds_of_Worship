<?php
namespace App\Jobs;

use App\Mail\NewsletterMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewsletterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $subscriber;
    public $content;

    public function __construct($subscriber, $content)
    {
        $this->subscriber = $subscriber;
        $this->content = $content;
    }

    public function handle()
    {
        Mail::to($this->subscriber->email)->send(new NewsletterMail($this->content));
    }
}
