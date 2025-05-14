<?php

namespace App\Http\Controllers;

use App\Mail\NewsletterMail;
use App\Mail\NewsletterWelcome;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ], [
            'email.unique' => 'You are already subscribed to our newsletter!',
        ]);

        // Save the subscriber
        Subscriber::create(['email' => $request->email]);

        // Send a welcome email
        Mail::to($request->email)->send(new NewsletterWelcome("Welcome to our travel newsletter!"));

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Subscription successful! Check your email.');
    }

}
