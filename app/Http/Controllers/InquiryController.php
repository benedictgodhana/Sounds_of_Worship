<?php

namespace App\Http\Controllers;

use App\Mail\InquiryReplyMail;
use App\Models\inquiry;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InquiryController extends Controller
{
    public function index(Request $request)
    {
        $query = Inquiry::with('trip'); // Eager load trip relationship

        // Search by name or email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                  ->orWhere('email', 'LIKE', "%$search%");
            });
        }

        // Filter by trip_id
        if ($request->filled('trip_id')) {
            $query->where('trip_id', $request->trip_id);
        }

        // Fetch inquiries
        $inquiries = $query->get();

        // Get distinct trips with their titles
        $tripIds = Trip::select('id', 'title')->distinct()->get();

        return view('inquiries.index', compact('inquiries', 'tripIds'));
    }


    public function reply(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'message' => 'required|string',
        'contact_id' => 'required|exists:inquiries,id',  // Make sure the inquiry exists in the database
        'email' => 'required|email',
    ]);

    // Find the inquiry by its ID
    $inquiry = Inquiry::findOrFail($request->contact_id);

    // Update the inquiry with the reply message
    $inquiry->reply = $request->message;
    $inquiry->save();

    // Send an email to the enquirer with the reply
    Mail::to($inquiry->email)->send(new InquiryReplyMail($inquiry));

    return redirect()->back()->with('success', 'Reply sent successfully!');
}


}
