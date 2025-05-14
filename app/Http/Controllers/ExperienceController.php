<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experience; // Import the Experience model
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all experiences from the database
        $experiences = Experience::paginate(5);

        // Return the view with the experiences data
        return view('experiences.index', compact('experiences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createExperience()
    {
        // Return the view for creating a new experience
        return view('experiences.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image upload
            'cta_text' => 'nullable|string|max:255',
            'cta_link' => 'nullable|url',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('experiences', 'public');
        }

        // Create a new experience with the authenticated user as the creator
        Experience::create([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'image' => $imagePath,
            'cta_text' => $request->cta_text ?? 'Default', // Default cta_text if not provided
            'cta_link' => $request->cta_link,
            'created_by' => Auth::id(), // Store the authenticated user's ID
        ]);

        // Redirect to the experiences index page with a success message
        return redirect()->route('experiences.index')->with('success', 'Experience created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the experience by ID
        $experience = Experience::findOrFail($id);

        // Return the view with the experience data
        return view('experiences.show', compact('experience'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Find the experience by ID
        $experience = Experience::findOrFail($id);

        // Return the view for editing the experience
        return view('experiences.edit', compact('experience'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image upload
            'cta_text' => 'nullable|string|max:255',
            'cta_link' => 'nullable|url',
        ]);

        // Find the experience by ID
        $experience = Experience::findOrFail($id);

        // Handle image upload
        $imagePath = $experience->image; // Keep the existing image by default
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($experience->image) {
                Storage::disk('public')->delete($experience->image);
            }
            // Store the new image
            $imagePath = $request->file('image')->store('experiences', 'public');
        }

        // Update the experience
        $experience->update([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'image' => $imagePath,
            'cta_text' => $request->cta_text ?? 'Default', // Default cta_text if not provided
            'cta_link' => $request->cta_link,
            'created_by' => Auth::id(), // Store the authenticated user's ID

        ]);

        // Redirect to the experiences index page with a success message
        return redirect()->route('experiences.index')->with('success', 'Experience updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the experience by ID
        $experience = Experience::findOrFail($id);

        // Delete the associated image if it exists
        if ($experience->image) {
            Storage::disk('public')->delete($experience->image);
        }

        // Delete the experience
        $experience->delete();

        // Redirect to the experiences index page with a success message
        return redirect()->route('experiences.index')->with('success', 'Experience deleted successfully!');
    }


    public function showExperience($id)
    {
        $experience = Experience::findOrFail($id);
        return view('Experiences.ShowExperience', compact('experience'));
    }
}
