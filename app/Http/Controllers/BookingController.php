<?php

namespace App\Http\Controllers;

use App\Mail\BookingReplyMail;
use App\Models\bookings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function index()
    {
        $bookings=bookings::all();
        return view('bookings.index',compact('bookings')); // Ensure this view file exists
    }



public function update(Request $request, $bookingId)
{
    // Validate the input data
    $validatedData = $request->validate([
        'status' => 'required|string|in:Pending,Confirmed,Cancelled',
        'reply' => 'nullable|string',
    ]);

    // Find the booking by ID
    $booking = bookings::findOrFail($bookingId);

    // Update the status of the booking
    $booking->status = $validatedData['status'];

    // If there is a reply, update the reply field
    if ($request->has('reply')) {
        $booking->reply = $validatedData['reply'];

        // Send email with the reply
        Mail::to($booking->email)->send(new BookingReplyMail($booking));
    }

    // Save the booking
    $booking->save();

    // Redirect back with success message
    return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
}


}
