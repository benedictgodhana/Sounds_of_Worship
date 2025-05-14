<?php
namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUserMail;
use App\Mail\ContactAdminMail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $contact = Contact::create($request->all());

        // Send email to user
        Mail::to($contact->email)->send(new ContactUserMail($contact));

        // Send email to admin
        Mail::to('admin@example.com')->send(new ContactAdminMail($contact));

        return back()->with('success', 'Your message has been sent successfully!');
    }

    public function index()
    {
        $contacts = Contact::all();
        return view('contacts.index', compact('contacts'));
    }



    public function reply(Request $request)
{
    $request->validate([
        'contact_id' => 'required|exists:contacts,id',
        'email' => 'required|email',
        'message' => 'required|string',
    ]);

    $contact = Contact::findOrFail($request->contact_id);

    // Send email (you need to configure Laravel Mail)
    Mail::raw($request->message, function ($message) use ($request, $contact) {
        $message->to($request->email)
                ->subject('Reply to your inquiry');
    });

    return back()->with('success', 'Reply sent successfully.');
}
}
