<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Head content remains same as original -->
    <style>
        :root {
            --primary-color: #4F46E5; /* Indigo */
            --primary-hover: #4338CA;
            --text-color: #333333;
            --bg-color: #FFFFFF;
            --light-gray: #F5F5F5;
        }

        /* Rest of styles remain similar with status badge adjustments */
        .badge-published { background-color: #C6F6D5; color: #22543D; }
        .badge-draft { background-color: #E9D8FD; color: #553C9A; }
        .badge-archived { background-color: #E2E8F0; color: #4A5568; }
        /* Add new status colors */
              .badge-discontinued { background-color: #E2E8F0; color: #4A5568; }

        .badge-instock {
    background-color: #28a745; /* Green */
    color: white;
    font-weight: bold;
}

.badge-outofstock {
    background-color: #dc3545; /* Red */
    color: white;
    font-weight: bold;
}

    </style>
</head>
<body>
    <x-app-layout>
        <div class="container-fluid py-4" x-data="{
            searchQuery: '',
            products: [],
            filteredProducts: [],
            init() {
                this.products = Array.from(document.querySelectorAll('#productTableBody tr'))
                    .map(row => {
                        return {
                            element: row,
                            name: row.querySelector('td:nth-child(1)').textContent.trim().toLowerCase(),
                            sku: row.querySelector('td:nth-child(2)').textContent.trim().toLowerCase(),
                            cardElement: document.querySelector(`.product-card[data-id='${row.getAttribute('data-id')}']`)
                        };
                    });
                this.filterProducts();
            },
            filterProducts() {
                const query = this.searchQuery.toLowerCase();
                this.filteredProducts = this.products.filter(product =>
                    product.name.includes(query) || product.sku.includes(query)
                );
                // Rest of filter logic remains same
            }
        }">
            <div class="card p-4">


            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert"
                    x-init="setTimeout(() => { document.getElementById('successAlert').remove() }, 4000)">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <!-- Header section -->
                <div class="d-flex justify-content-between align-items-center page-header">
                    <h1 class="text-2xl font-bold text-gray-800">
                        <i class="fas fa-cube me-2" style="color: var(--primary-color)"></i>Product Management
                    </h1>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                        <i class="fas fa-plus me-1"></i> Add Product
                    </button>
                </div>
                <div class="flex justify-between items-center mb-6">
    <!-- Search and Filter Form -->
    <form method="GET" action="{{ route('products.index') }}" class="flex space-x-3">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..."
            class="border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">

        <!-- Event Filter Dropdown -->
        <select name="event_id" class="border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
            <option value="">-- Filter by Event --</option>
            @foreach($events as $event)
                <option value="{{ $event->id }}" {{ request('event_id') == $event->id ? 'selected' : '' }}>
                    {{ $event->name }}
                </option>
            @endforeach
        </select>

      <!-- Search Button -->
<button type="submit" class="bg-primary text-white px-4 py-2 rounded-md hover:bg-opacity-90 flex items-center space-x-2">
    <i class="fas fa-search"></i>
    <span>Search</span>
</button>

<!-- Reset Button -->
<a href="{{ route('products.index') }}" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 flex items-center space-x-2" 
   style="text-decoration: none;">
    <i class="fas fa-sync-alt"></i>
    <span>Reset</span>
</a>

    </form>
</div>



                <!-- Table Structure -->
                <div class="products-table table-responsive">
                <table class="table table-hover align-middle">
    <thead>
        <tr>
            <th>User</th>
            <th>Event</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Image</th>
            <th>Stock Quantity</th>
            <th>Metadata</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Actions</th> <!-- For Edit/Delete buttons -->
        </tr>
    </thead>
    <tbody id="productTableBody">
        @foreach ($products as $product)
        <tr data-id="{{ $product->id }}">
            <td>{{ $product->user->name ?? 'N/A' }}</td>
            <td>{{ $product->event->name ?? 'N/A' }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->description }}</td>
            <td>Ksh {{ number_format($product->price, 2) }}</td>
            <td>
                @if ($product->image_url)
                    <img src="{{ asset('storage/' . $product->image_url) }}" alt="Product Image"
                        class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                @else
                    <span>No Image</span>
                @endif
            </td>
            <td>{{ $product->stock_quantity }}</td>
            <td>
    @php
        $metadata = json_decode($product->metadata, true);
        $colorCode = $metadata['color'] ?? null;
    @endphp

    @if ($metadata)
        <div>
            <strong>Color:</strong> 
            @if ($colorCode)
                <span class="color-box" style="display: inline-block; width: 20px; height: 20px; background-color: {{ $colorCode }}; border: 1px solid #000; margin-left: 5px;"></span>
            @else
                N/A
            @endif
            <br>
            <strong>Size:</strong> {{ $metadata['size'] ?? 'N/A' }}
        </div>
    @else
        <span>No metadata</span>
    @endif
</td>

            <td>
    <span class="badge
        @if($product->is_available)
            badge-instock
        @else
            badge-outofstock
        @endif">
        {{ $product->is_available ? 'In Stock' : 'Out of Stock' }}
    </span>
</td>

            <td>{{ $product->created_at->format('Y-m-d') }}</td>
            <td>{{ $product->updated_at->format('Y-m-d') }}</td>
            <td>
                <!-- Edit/Delete buttons can go here -->
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editProductModal{{ $product->id }}">
        Edit
    </button>

    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteProductModal{{ $product->id }}">
        <i class="fas fa-trash-alt"></i>
    </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

                </div>


<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-cube me-2"></i>Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name">Product Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="price">Price</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                        </div>

                        <div class="col-md-6">
                            <label for="event_id">Event</label>
                            <select class="form-select" id="event_id" name="event_id">
                                <option value="" selected>-- Select Event --</option>
                                @foreach($events as $event)
                                    <option value="{{ $event->id }}">{{ $event->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="stock_quantity">Stock Quantity</label>
                            <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" required>
                        </div>
                        <div class="col-md-6">
                            <label for="is_available">Status</label>
                            <select class="form-select" id="is_available" name="is_available" required>
                                <option value="1">Available</option>
                                <option value="0">Not Available</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="color">Color</label>
                            <input type="color" class="form-control" id="color" name="color" required>
                        </div>
                        <div class="col-md-6">
                            <label for="size">Size</label>
                            <select class="form-select" id="size" name="size" required>
                                <option value="" selected>-- Select Size --</option>
                                <option value="S">Small</option>
                                <option value="M">Medium</option>
                                <option value="L">Large</option>
                                <option value="XL">X-Large</option>
                                <option value="XXL">XX-Large</option>
                                <!-- Add more size options as needed -->
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="image_url">Product Image</label>
                            <input type="file" class="form-control" id="image_url" name="image_url" accept="image/*">
                        </div>
                    </div>
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary">Save Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Product Modal -->
@foreach ($products as $product)
<div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1" aria-labelledby="editProductModalLabel{{ $product->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel{{ $product->id }}"><i class="fas fa-cube me-2"></i>Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name">Product Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="price">Price</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="event_id">Event</label>
                            <select class="form-select" id="event_id" name="event_id">
                                <option value="" selected>-- Select Event --</option>
                                @foreach($events as $event)
                                    <option value="{{ $event->id }}" @if($event->id == $product->event_id) selected @endif>
                                        {{ $event->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="stock_quantity">Stock Quantity</label>
                            <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" value="{{ $product->stock_quantity }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="is_available">Status</label>
                            <select class="form-select" id="is_available" name="is_available" required>
                                <option value="1" @if($product->is_available) selected @endif>Available</option>
                                <option value="0" @if(!$product->is_available) selected @endif>Not Available</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description">{{ $product->description }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="color">Color</label>
                            <input type="color" class="form-control" id="color" name="color" value="{{ $product->color }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="size">Size</label>
                            <select class="form-select" id="size" name="size" required>
                                <option value="" selected>-- Select Size --</option>
                                <option value="S" @if($product->size == 'S') selected @endif>Small</option>
                                <option value="M" @if($product->size == 'M') selected @endif>Medium</option>
                                <option value="L" @if($product->size == 'L') selected @endif>Large</option>
                                <option value="XL" @if($product->size == 'XL') selected @endif>X-Large</option>
                                <option value="XXL" @if($product->size == 'XXL') selected @endif>XX-Large</option>
                            </select>
                        </div>
                        <div class="col-12">
    <label for="image_url">Product Image</label>

    <!-- Display existing image if it exists -->
    @if($product->image_url)
        <div class="mb-3">
            <img src="{{ asset('storage/' . $product->image_url) }}" alt="Product Image" class="img-thumbnail" style="max-width: 200px;">
        </div>
    @endif

    <!-- File Input to Upload a New Image -->
    <input type="file" class="form-control" id="image_url" name="image_url" accept="image/*">
</div>

                    </div>
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary">Update Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach



@foreach ($products as $product)
<div class="modal fade" id="deleteProductModal{{ $product->id }}" tabindex="-1" aria-labelledby="deleteProductModalLabel{{ $product->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteProductModalLabel{{ $product->id }}">
                    <i class="fas fa-trash-alt me-2"></i>Confirm Delete
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <strong>{{ $product->name }}</strong>? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

    </x-app-layout>

    <!-- Scripts remain same -->
    <script>
        // Initialize CKEditor for product description
        document.querySelectorAll('.rich-text-editor').forEach(editor => {
            CKEDITOR.replace(editor);
        });
    </script>
</body>
</html>
