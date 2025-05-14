<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $all_events = Event::all();

        return view('events.index', compact('all_events'));
    }

    public function EventPage()
    {
        $events = Event::all();
        $ticketCategories = [];

        foreach ($events as $event) {
            $decodedTickets = json_decode($event->ticket_categories, true);
            if (is_array($decodedTickets)) {
                $ticketCategories = array_merge($ticketCategories, $decodedTickets);
            }
        }

        return view('Events', compact('events', 'ticketCategories'));
    }


    public function update(Request $request, Event $event)
{
    // Debugging: Check if the event exists
    if (!$event) {
        return redirect()->back()->with('error', 'Event not found!');
    }

    // Log incoming request data
    Log::info('Updating Event:', ['event' => $event->id, 'request_data' => $request->all()]);

    // Validate request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'event_date' => 'required|date',
        'location' => 'required|string|max:255',
        'is_paid' => 'required|boolean',
        'event_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        'description' => 'nullable|string',
        'is_featured' => 'nullable|boolean',
        'ticket_categories' => 'nullable|array',
        'ticket_categories.*.category' => 'required|string|max:255',
        'ticket_categories.*.price' => 'required|numeric|min:0',
        'ticket_categories.*.quantity' => 'required|integer|min:1',
        'capacity' => 'required|integer|min:1',
    ]);

    // Prepare data for update
    $data = $request->only([
        'name', 'event_date', 'location', 'is_paid', 'description', 'capacity'
    ]);
    $data['is_featured'] = $request->has('is_featured') ? (bool) $request->is_featured : false;
    $data['user_id'] = Auth::id();

    if ($request->has('ticket_categories') && is_array($request->ticket_categories)) {
        $ticketCategories = array_values($request->ticket_categories); // Ensure it's indexed properly
        Log::info('Received Ticket Categories:', ['ticket_categories' => $ticketCategories]);
        $data['ticket_categories'] = json_encode($ticketCategories);
    } else {
        Log::warning('No valid ticket categories received, keeping existing ones.');
    }


    // Handle event image upload
    if ($request->hasFile('event_image')) {
        // Delete old image if exists
        if ($event->event_image) {
            Storage::disk('public')->delete($event->event_image);
        }
        // Store new image
        $data['event_image'] = $request->file('event_image')->store('events', 'public');
    }

    // Log before updating
    Log::info('Before Update:', ['old_ticket_categories' => $event->ticket_categories]);

    // Perform update
    $updated = $event->update($data);

    // Log after updating
    Log::info('After Update:', ['new_ticket_categories' => $event->ticket_categories]);

    if (!$updated) {
        return redirect()->back()->with('error', 'Failed to update event!');
    }

    return redirect()->route('all_events.index')->with('success', 'Event updated successfully.');
}
public function destroy(Event $event)
{
    // Delete event image if exists
    if ($event->event_image) {
        Storage::disk('public')->delete($event->event_image);
    }

    // Delete the event
    $event->delete();

    return redirect()->route('all_events.index')->with('success', 'Event deleted successfully.');
}

}
