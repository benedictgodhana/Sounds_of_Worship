<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketConfirmation;

class TicketController extends Controller
{

    public function index(Request $request)
    {
        $query = Ticket::query();
        
        // Search by full name, email, phone, or ticket number
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%")
                    ->orWhere('ticket_number', 'like', "%$search%");
            });
        }
    
        // Filter by event
        if ($request->filled('event_id')) {
            $query->where('event_id', $request->event_id);
        }
    
        // Filter by payment status
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }
    
        $tickets = $query->paginate(5); // Paginate results
        $events = Event::all();
    
        return view('tickets.index', compact('tickets', 'events'));
    }
    

    public function storeFree(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'quantity' => 'required|integer|min:1'
        ]);

        // Get the event with a lock to prevent overbooking
        $event = Event::where('id', $validated['event_id'])
            ->lockForUpdate()
            ->first();

        // Check available capacity
        if (($event->capacity - $event->tickets_sold) < $validated['quantity']) {
            return response()->json([
                'success' => false,
                'message' => 'Not enough tickets available'
            ], 400);
        }

        // Create ticket
        $ticket = Ticket::create([
            'event_id' => $validated['event_id'],
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'ticket_type' => 'free',
            'quantity' => $validated['quantity'],
            'total_price' => 0,
            'payment_status' => 'completed'
        ]);

        // Update event capacity
        $event->increment('tickets_sold', $validated['quantity']);

        // **Explicitly fetch updated tickets_sold and update status**
        $event->refresh(); // Ensure we get the latest `tickets_sold`
        if ($event->tickets_sold >= $event->capacity) {
            $event->update(['status' => 'fully_booked']);
        }

        // Send confirmation email
        Mail::to($validated['email'])->send(new TicketConfirmation($ticket));

        return response()->json([
            'success' => true,
            'message' => 'Free tickets registered successfully!'
        ]);
    }

    public function storePaid(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'ticket_type' => 'required|in:standard,vip,family',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric'
        ]);

        // Get the event with a lock to prevent overbooking
        $event = Event::where('id', $validated['event_id'])
            ->lockForUpdate()
            ->first();

        // Check available capacity
        if (($event->capacity - $event->tickets_sold) < $validated['quantity']) {
            return response()->json([
                'success' => false,
                'message' => 'Not enough tickets available'
            ], 400);
        }

        // Create ticket
        $ticket = Ticket::create([
            'event_id' => $validated['event_id'],
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'ticket_type' => $validated['ticket_type'],
            'quantity' => $validated['quantity'],
            'total_price' => $validated['total_price'],
            'payment_status' => 'pending'
        ]);

        // Update event capacity
        $event->increment('tickets_sold', $validated['quantity']);

        // **Explicitly fetch updated tickets_sold and update status**
        $event->refresh(); // Ensure we get the latest `tickets_sold`
        if ($event->tickets_sold >= $event->capacity) {
            $event->update(['status' => 'fully_booked']);
        }

        // Send confirmation email
        Mail::to($validated['email'])->send(new TicketConfirmation($ticket));

        return response()->json([
            'success' => true,
            'message' => 'Paid ticket order created!',
            'ticket_id' => $ticket->id
        ]);
    }

    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('tickets.show', compact('ticket'));
    }
}
