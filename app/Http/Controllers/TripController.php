<?php

namespace App\Http\Controllers;

use App\Models\bookings;
use App\Models\inquiry;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trips = Trip::all();
        return view('trips.index', compact('trips'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the view for creating a new experience
        return view('trips.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('trip_images', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Create trip with authenticated user
        Trip::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'] ?? null,
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('trips.index')->with('success', 'Trip created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip)
    {
        return response()->json($trip);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trip $trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trip $trip)
{
    $validated = $request->validate([
        'title' => 'sometimes|string|max:255',
        'description' => 'sometimes|string',
        'image' => 'nullable|string',
        'start_date' => 'sometimes|date',
        'end_date' => 'sometimes|date|after_or_equal:start_date',
    ]);

    // Update the trip with the validated data
    $trip->update($validated);

    return redirect()->route('trips.index')->with('success', 'Trip updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        $trip->delete();

        return redirect()->route('trips.index')->with('success', 'Trip deleted successfully.');
    }




    public function book(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'trip_id' => 'required|exists:trips,id',
            'number_of_travelers' => 'required|integer|min:1',
            'special_requests' => 'nullable|string',
        ]);

        $booking = bookings::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'trip_id' => $request->trip_id,
            'number_of_travelers' => $request->number_of_travelers,
            'special_requests' => $request->special_requests,
            'status' => 'pending', // Default status
        ]);


        return redirect()->back()->with('success', 'Your booking has been successfully submitted!');

    }

    /**
     * Handle trip inquiries.
     */
    public function inquire(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string|max:1000',
            'trip_id' => 'required|exists:trips,id',

        ]);

        $inquiry = inquiry::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'trip_id' => $request->trip_id,

        ]);

      return redirect()->back()->with('success', 'Your inquiry has been successfully submitted!');

    }
}
