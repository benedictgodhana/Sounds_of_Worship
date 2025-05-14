<?php
namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // List all products
    public function index(Request $request)
    {
        $events = Event::all(); // Fetch all events

        // Get filters from request
        $search = $request->input('search');
        $event_id = $request->input('event_id');

        // Query products with filtering
        $query = Product::query();

        if ($search) {
            $query->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
        }

        if ($event_id) {
            $query->where('event_id', $event_id);
        }

        $products = $query->get();

        return view('products.index', compact('products', 'events', 'search', 'event_id'));
    }

    // Show a single product
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }
    public function store(Request $request)
    {
        // Log incoming request data
        Log::info('Product creation request received', ['data' => $request->all()]);

        // Validate the incoming data
        $request->validate([
            'event_id' => 'nullable|exists:events,id',
            'name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'stock_quantity' => 'required|integer|min:0',
            'color' => 'required|string|max:255', // Color validation
            'size' => 'required|string|max:255',  // Size validation
            'is_available' => 'boolean',
        ]);

        // Store image and log the path
        $imagePath = $request->file('image_url')->store('products', 'public');
        Log::info('Product image stored at path:', ['imagePath' => $imagePath]);

        // Prepare metadata for color and size
        $metadata = [
            'color' => $request->color,
            'size' => $request->size,
        ];

        // Log metadata before storing
        Log::info('Product metadata:', ['metadata' => json_encode($metadata)]);

        // Create a new product
        try {
            $product = Product::create([
                'user_id' => Auth::id(),  // Use Auth::id() for the currently authenticated user
                'event_id' => $request->event_id,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'image_url' => $imagePath,
                'stock_quantity' => $request->stock_quantity,
                'metadata' => json_encode($metadata),  // Store color and size as JSON
                'is_available' => $request->is_available ?? true,
            ]);

            // Log success message
            Log::info('Product created successfully', ['product' => $product]);

            // Redirect back with success message
            return redirect()->route('products.index')->with('success', 'Product created successfully!');
        } catch (\Exception $e) {
            // Log any error that occurs
            Log::error('Error creating product', ['error' => $e->getMessage()]);
            return redirect()->route('products.index')->with('error', 'Failed to create product.');
        }
    }
    // Update product
    public function update(Request $request, $id)
    {
        // Log incoming request data
        Log::info('Product update request received', ['data' => $request->all()]);

        // Validate the incoming data
        $request->validate([
            'event_id' => 'nullable|exists:events,id',
            'name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',  // Image is optional for update
            'stock_quantity' => 'required|integer|min:0',
            'color' => 'required|string|max:255', // Color validation
            'size' => 'required|string|max:255',  // Size validation
            'is_available' => 'boolean',
        ]);

        // Find the existing product to update
        $product = Product::find($id);

        // If the product does not exist, return with an error
        if (!$product) {
            Log::error('Product not found', ['product_id' => $id]);
            return redirect()->route('products.index')->with('error', 'Product not found.');
        }

        // Handle image update (if a new image is uploaded)
        $imagePath = $product->image_url;  // Default to the current image path

        if ($request->hasFile('image_url')) {
            // Delete the old image if it's being replaced
            if ($product->image_url) {
                Storage::disk('public')->delete($product->image_url);
            }

            // Store the new image
            $imagePath = $request->file('image_url')->store('products', 'public');
            Log::info('Product image updated at path:', ['imagePath' => $imagePath]);
        }

        // Prepare metadata for color and size
        $metadata = [
            'color' => $request->color,
            'size' => $request->size,
        ];

        // Log metadata before updating
        Log::info('Product metadata:', ['metadata' => json_encode($metadata)]);

        // Update the product
        try {
            $product->update([
                'user_id' => Auth::id(),  // Use Auth::id() for the currently authenticated user
                'event_id' => $request->event_id,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'image_url' => $imagePath,
                'stock_quantity' => $request->stock_quantity,
                'metadata' => json_encode($metadata),  // Update color and size as JSON
                'is_available' => $request->is_available ?? true,
            ]);

            // Log success message
            Log::info('Product updated successfully', ['product' => $product]);

            // Redirect back with success message
            return redirect()->route('products.index')->with('success', 'Product updated successfully!');
        } catch (\Exception $e) {
            // Log any error that occurs
            Log::error('Error updating product', ['error' => $e->getMessage()]);
            return redirect()->route('products.index')->with('error', 'Failed to update product.');
        }
    }


    // Delete product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        Storage::disk('public')->delete($product->image_url);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
