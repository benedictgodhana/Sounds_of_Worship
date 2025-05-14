<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the blogs.
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('blog.index',compact('blogs')); // Ensure this view file exists

    }

    /**
     * Store a newly created blog.
     */
    public function store(Request $request)
    {
        try {
            // Validate request data
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'category' => 'required|string|max:100',
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
                'slug' => 'required|string|unique:blogs,slug',
                'reading_time' => 'required|integer',
            ]);

            // Handle image upload if present
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('blog_images', 'public');
            }

            // Manually assign and create the blog
            $blog = Blog::create([
                'title' => $validatedData['title'],
                'category' => $validatedData['category'],
                'description' => $validatedData['description'],
                'slug' => $validatedData['slug'],
                'reading_time' => $validatedData['reading_time'],
                'created_by' => Auth::id(),
                'image' => $imagePath, // Assign image path if uploaded
            ]);

            Log::info('Blog created successfully', ['blog' => $blog]);

            // Redirect back with success message
            return redirect()->route('blogs.index')->with('success', 'Blog created successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation errors
            Log::error('Validation failed', ['errors' => $e->errors()]);

            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log unexpected errors
            Log::error('An error occurred while creating the blog', ['error' => $e->getMessage()]);

            return redirect()->back()->with('error', 'An error occurred. Please try again.');
        }
    }



    /**
     * Display the specified blog.
     */
    public function show(Blog $blog)
    {
        return response()->json($blog);
    }

    /**
     * Update the specified blog.
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'sometimes|string|max:255',
            'category' => 'sometimes|string|max:100',
            'description' => 'sometimes|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120', // Updated validation
            'slug' => 'sometimes|string|unique:blogs,slug,' . $blog->id,
            'reading_time' => 'sometimes|integer',
            'created_by' => 'sometimes|exists:users,id',
        ]);

        $data = $request->except('image'); // Exclude image for now

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($blog->image) {
                Storage::delete('public/' . $blog->image); // Adjust if using storage
            }

            // Save new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('uploads', $imageName, 'public'); // Save in storage/app/public/uploads

            $data['image'] = $imagePath; // Store image path in the database
        }

        $blog->update($data);

        return redirect()->back()->with('success', 'Blog updated successfully');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->back()->with('success', 'Blog deleted successfully');
    }


    public function showBlog($id)
{
    $blog = Blog::findOrFail($id);
    return view('blog.showBlog', compact('blog'));
}

}
