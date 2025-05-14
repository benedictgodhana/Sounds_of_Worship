<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.10.3/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <style>
        :root {
            --primary-color: #FF4500; /* orangered */
            --primary-hover: #E03E00;
            --text-color: #333333;
            --bg-color: #FFFFFF;
            --light-gray: #F5F5F5;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            width: 100%;
        }

        .btn-primary {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
        }

        .btn-primary:hover, .btn-primary:focus {
            background-color: var(--primary-hover) !important;
            border-color: var(--primary-hover) !important;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: none;
            width: 100%;
            margin-bottom: 1rem;
        }

        .blog-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .blog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .btn {
            border-radius: 5px;
            font-weight: 500;
        }

        .btn-success {
            background-color: #38B2AC !important;
            border-color: #38B2AC !important;
        }

        .btn-danger {
            background-color: #F56565 !important;
            border-color: #F56565 !important;
        }

        .btn-info {
            background-color: #4299E1 !important;
            border-color: #4299E1 !important;
            color: white !important;
        }

        .table thead th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 500;
            border: none;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(255, 69, 0, 0.25);
        }

        .page-header {
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: #C6F6D5;
            border-color: #9AE6B4;
            color: #22543D;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(255, 69, 0, 0.05);
        }

        .modal-header {
            background-color: var(--primary-color);
            color: white;
            border-bottom: none;
        }

        .modal-header .btn-close {
            color: white;
            filter: brightness(0) invert(1);
        }

        .badge-status {
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 12px;
        }

        .badge-published {
            background-color: #C6F6D5;
            color: #22543D;
        }

        .badge-draft {
            background-color: #E9D8FD;
            color: #553C9A;
        }

        .badge-archived {
            background-color: #E2E8F0;
            color: #4A5568;
        }

        /* Card view for mobile styling */
        .blog-card .card-title {
            color: var(--text-color);
            font-weight: 600;
        }

        .blog-card .card-header {
            background-color: rgba(255, 69, 0, 0.1);
            border-bottom: 2px solid var(--primary-color);
        }

        .blog-card .card-footer {
            background-color: transparent;
            border-top: 1px solid rgba(0,0,0,0.1);
        }

        .blog-card .thumbnail {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
        }

        /* Hide table on small screens, show cards instead */
        @media (max-width: 991.98px) {
            .blogs-table {
                display: none;
            }
            .blogs-cards {
                display: block;
            }
        }

        /* Hide cards on large screens, show table instead */
        @media (min-width: 992px) {
            .blogs-table {
                display: block;
            }
            .blogs-cards {
                display: none;
            }
        }
    </style>
</head>
<body>
    <x-app-layout>
        <div class="container-fluid py-4" x-data="{
            searchQuery: '',
            blogs: [],
            filteredBlogs: [],
            init() {
                // Initialize blogs from PHP data
                this.blogs = Array.from(document.querySelectorAll('#blogTableBody tr'))
                    .map(row => {
                        return {
                            element: row,
                            title: row.querySelector('td:nth-child(1)').textContent.trim().toLowerCase(),
                            cardElement: document.querySelector(`.blog-card[data-id='${row.getAttribute('data-id')}']`)
                        };
                    });
                this.filterBlogs();
            },
            filterBlogs() {
                this.filteredBlogs = this.blogs.filter(blog =>
                    blog.title.includes(this.searchQuery.toLowerCase())
                );

                this.blogs.forEach(blog => {
                    if (this.filteredBlogs.includes(blog)) {
                        if (blog.element) blog.element.style.display = '';
                        if (blog.cardElement) blog.cardElement.style.display = '';
                    } else {
                        if (blog.element) blog.element.style.display = 'none';
                        if (blog.cardElement) blog.cardElement.style.display = 'none';
                    }
                });

                // Update empty states
                const tableEmptyState = document.getElementById('tableEmptyState');
                const cardsEmptyState = document.getElementById('cardsEmptyState');

                if (this.filteredBlogs.length === 0) {
                    if (tableEmptyState) tableEmptyState.style.display = 'block';
                    if (cardsEmptyState) cardsEmptyState.style.display = 'block';
                } else {
                    if (tableEmptyState) tableEmptyState.style.display = 'none';
                    if (cardsEmptyState) cardsEmptyState.style.display = 'none';
                }
            }
        }">
            <div class="card p-4">
                <!-- Alert for success messages -->
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
                        <i class="fas fa-blog me-2" style="color: var(--primary-color)"></i>Blog Management
                    </h1>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBlogModal">
                        <i class="fas fa-plus me-1"></i> Add Blog Post
                    </button>
                </div>

                <!-- Search and filter section -->
                <div class="search-filter mb-4">
                    <div class="input-group">
                        <span class="input-group-text" style="background-color: var(--primary-color); color: white;">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" x-model="searchQuery" x-on:input="filterBlogs()"
                            class="form-control" placeholder="Search by title...">
                    </div>
                </div>

                <!-- Blog posts table (visible on larger screens) -->
                <div class="blogs-table table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Author</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="blogTableBody">
                            @foreach ($blogs as $blog)
                            <tr data-id="{{ $blog->id }}">
                                <td class="fw-medium">{{ $blog->title }}</td>
                                <td><span class="badge bg-light text-dark">{{ $blog->category }}</span></td>
                                <td>{!! Str::limit($blog->description, 50) !!}</td>
                                    <td>
                                    @if ($blog->image)
                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image"
                                        class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                    <div class="text-center text-muted"><i class="fas fa-image"></i></div>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-status
                                        @if($blog->status == 'published') badge-published
                                        @elseif($blog->status == 'draft') badge-draft
                                        @else badge-archived @endif">
                                        {{ ucfirst($blog->status) }}
                                    </span>
                                </td>
                                <td>{{ $blog->author->name ?? 'Unknown' }}</td>
                                <td>{{ $blog->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <!-- Edit Button -->
                                        <button class="btn btn-sm" style="background-color: var(--primary-color); color: white;"
                                            data-bs-toggle="modal" data-bs-target="#editBlog{{ $blog->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <!-- View Button -->
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                            data-bs-target="#viewBlogModal{{ $blog->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        <!-- Delete Button -->
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteBlogModal{{ $blog->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Empty state for table -->
                    <div id="tableEmptyState" class="text-center py-5" style="display: none;">
                        <i class="fas fa-search mb-3" style="font-size: 2rem; color: var(--primary-color);"></i>
                        <h4>No matching blog posts found</h4>
                        <p class="text-muted">Try changing your search query or add a new blog post</p>
                    </div>
                </div>

                <!-- Blog posts cards (visible on smaller screens) -->
                <div class="blogs-cards">
                    <div class="row">
                        @foreach ($blogs as $blog)
                        <div class="col-12 col-md-6 col-lg-4" data-id="{{ $blog->id }}">
                            <div class="card blog-card" data-id="{{ $blog->id }}">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <span class="badge badge-status
                                        @if($blog->status == 'published') badge-published
                                        @elseif($blog->status == 'draft') badge-draft
                                        @else badge-archived @endif">
                                        {{ ucfirst($blog->status) }}
                                    </span>
                                    <span class="badge bg-light text-dark">{{ $blog->category }}</span>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex">
                                        @if ($blog->image)
                                        <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image"
                                            class="thumbnail me-3">
                                        @else
                                        <div class="thumbnail me-3 d-flex align-items-center justify-content-center"
                                            style="background-color: var(--light-gray);">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                        @endif
                                        <div>
                                            <h5 class="card-title">{{ $blog->title }}</h5>
                                            <p class="card-text text-muted small">
                                                <i class="fas fa-user me-1"></i> {{ $blog->author->name ?? 'Unknown' }}
                                                <span class="mx-1">|</span>
                                                <i class="far fa-calendar-alt me-1"></i> {{ $blog->created_at->format('d M Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    <p class="card-text mt-3">{!! Str::limit($blog->description, 100) !!}</p>
                                </div>
                                <div class="card-footer d-flex justify-content-end">
                                    <!-- Edit Button -->
                                    <button class="btn btn-sm me-1" style="background-color: var(--primary-color); color: white;"
                                        data-bs-toggle="modal" data-bs-target="#editBlog{{ $blog->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <!-- View Button -->
                                    <button class="btn btn-sm btn-info me-1" data-bs-toggle="modal"
                                        data-bs-target="#viewBlogModal{{ $blog->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    <!-- Delete Button -->
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteBlogModal{{ $blog->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- Empty state for cards -->
                    <div id="cardsEmptyState" class="text-center py-5" style="display: none;">
                        <i class="fas fa-search mb-3" style="font-size: 2rem; color: var(--primary-color);"></i>
                        <h4>No matching blog posts found</h4>
                        <p class="text-muted">Try changing your search query or add a new blog post</p>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
<!-- Add Blog Modal -->
<div class="modal fade" id="addBlogModal" tabindex="-1" aria-labelledby="addBlogModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl"> <!-- Extra-wide modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBlogModalLabel">
                    <i class="fas fa-plus-circle me-2"></i>Add New Blog Post
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data"
                    x-data="{
                        title: '',
                        slug: '',
                        generateSlug() {
                            this.slug = this.title.toLowerCase()
                                .replace(/[^\w\s-]/g, '')
                                .replace(/\s+/g, '-')
                                .replace(/-+/g, '-');
                        }
                    }">
                    @csrf
                    <div class="row g-3">
                        <!-- Title -->
                        <div class="col-md-4">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" x-model="title"
                                x-on:input="generateSlug()" required>
                        </div>

                        <!-- Category -->
                        <div class="col-md-4">
                            <label class="form-label">Category</label>
                            <input type="text" class="form-control" name="category" required>
                        </div>

                        <!-- Slug -->
                        <div class="col-md-4">
                            <label class="form-label">Slug</label>
                            <input type="text" class="form-control" name="slug" x-model="slug" required>
                            <small class="text-muted">Auto-generated from title, but you can edit it</small>
                        </div>

                        <!-- Reading Time -->
                        <div class="col-md-4">
                            <label class="form-label">Reading Time (in minutes)</label>
                            <input type="number" class="form-control" name="reading_time" required>
                        </div>

                        <!-- Status -->
                        <div class="col-md-4">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="published">Published</option>
                                <option value="draft">Draft</option>
                                <option value="archived">Archived</option>
                            </select>
                        </div>

                        <!-- Description (Full Width) -->
                        <div class="col-md-12">
                            <label class="form-label">Description</label>
                            <textarea class="form-control rich-text-editor" name="description" id="editor" rows="6" required></textarea>
                        </div>

                        <!-- Image Upload (Full Width) -->
                        <div class="col-md-12">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" name="image" id="image" accept="image/*" class="form-control" onchange="previewImage(event)">

                            <!-- Image Preview -->
                            <div class="mt-3">
                                <small class="text-muted">Image Preview:</small>
                                <img id="imagePreview" class="mt-2 img-fluid img-thumbnail d-none" style="width: 100%; height: auto;">
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="text-end mt-4">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Save Blog Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Blog Modal -->
@foreach ($blogs as $blog)
<div class="modal fade" id="editBlog{{ $blog->id }}" tabindex="-1"
    aria-labelledby="editBlogModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl"> <!-- Made modal extra-large -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBlogModalLabel">
                    <i class="fas fa-edit me-2"></i>Edit Blog Post
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('blogs.update', $blog->id) }}" method="POST"
                    enctype="multipart/form-data" id="editBlogForm{{ $blog->id }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <!-- Title -->
                        <div class="col-md-4">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title"
                                id="editTitle{{ $blog->id }}" value="{{ $blog->title }}" required>
                        </div>

                        <!-- Category -->
                        <div class="col-md-4">
                            <label class="form-label">Category</label>
                            <input type="text" class="form-control" name="category"
                                id="editCategory{{ $blog->id }}" value="{{ $blog->category }}" required>
                        </div>

                        <!-- Slug -->
                        <div class="col-md-4">
                            <label class="form-label">Slug</label>
                            <input type="text" class="form-control" name="slug"
                                id="editSlug{{ $blog->id }}" value="{{ $blog->slug }}" required>
                        </div>

                        <!-- Status -->
                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select name="status" id="editStatus{{ $blog->id }}" class="form-select" required>
                                <option value="published" {{ $blog->status == 'published' ? 'selected' : '' }}>
                                    Published</option>
                                <option value="draft" {{ $blog->status == 'draft' ? 'selected' : '' }}>
                                    Draft</option>
                                <option value="archived" {{ $blog->status == 'archived' ? 'selected' : '' }}>
                                    Archived</option>
                            </select>
                        </div>

                        <!-- Image Upload -->
                        <div class="col-md-8">
                            <label for="editImage{{ $blog->id }}" class="form-label">Image</label>
                            <input type="file" name="image" id="editImage{{ $blog->id }}"
                                accept="image/*" class="form-control">
                            @if ($blog->image)
                            <div class="mt-2">
                                <small class="text-muted">Current image:</small>
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image"
                                    class="mt-1 img-thumbnail fluid" style="height: 80px;">
                            </div>
                            @endif
                        </div>

                        <!-- Description (Full Width) -->
                        <div class="col-md-12">
                            <label class="form-label">Description</label>
                            <textarea class="form-control rich-text-editor" name="description"
                                id="editDescription{{ $blog->id }}" rows="6" required>{{ $blog->description }}</textarea>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="text-end mt-4">
                        <button type="button" class="btn btn-secondary me-2"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Save Changes
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

    <!-- View Blog Modals -->
    @foreach ($blogs as $blog)
    <div class="modal fade" id="viewBlogModal{{ $blog->id }}" tabindex="-1"
        aria-labelledby="viewBlogModalLabel{{ $blog->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewBlogModalLabel{{ $blog->id }}">
                        <i class="fas fa-eye me-2"></i>{{ $blog->title }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="blog-preview">
                        @if ($blog->image)
                        <div class="text-center mb-3">
                            <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image"
                                class="img-fluid rounded" style="max-height: 200px;">
                        </div>
                        @endif
                        <div class="d-flex justify-content-between mb-3">
                            <span class="badge" style="background-color: var(--primary-color);">
                                {{ $blog->category }}
                            </span>
                            <span class="badge badge-status
                                @if($blog->status == 'published') badge-published
                                @elseif($blog->status == 'draft') badge-draft
                                @else badge-archived @endif">
                                {{ ucfirst($blog->status) }}
                            </span>
                        </div>
                        <h4 class="mt-2 mb-3">{{ $blog->title }}</h4>
                        <div class="mb-3">
                            <p class="text-muted">
                                <small>
                                    <i class="fas fa-user me-1"></i> {{ $blog->author->name ?? 'Unknown' }}
                                    <span class="mx-2">|</span>
                                    <i class="far fa-calendar-alt me-1"></i> {{ $blog->created_at->format('d M Y') }}
                                </small>
                            </p>
                        </div>
                        <div class="blog-content mb-3">
                            <p>{!! $blog->description !!}</p>
                        </div>
                        <div class="blog-meta border-top pt-3 mt-3">
                            <p><strong>Slug:</strong> {{ $blog->slug }}</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Delete Blog Modals -->
    @foreach ($blogs as $blog)
    <div class="modal fade" id="deleteBlogModal{{ $blog->id }}" tabindex="-1"
        aria-labelledby="deleteBlogModalLabel{{ $blog->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteBlogModalLabel{{ $blog->id }}">
                        <i class="fas fa-trash me-2"></i>Delete Blog Post
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <i class="fas fa-exclamation-triangle text-warning" style="font-size: 3rem;"></i>
                        <h5 class="mt-3">Are you sure?</h5>
                        <p class="text-muted">Do you really want to delete the blog post "<strong>{{ $blog->title }}</strong>"?<br>This action cannot be undone.</p>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <form method="POST" action="{{ route('blogs.destroy', $blog->id) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i> Yes, Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "timeOut": "3000"
                };
                toastr.success("{{ session('success') }}");
            @endif

            @if (session('error'))
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "timeOut": "3000"
                };
                toastr.error("{{ session('error') }}");
            @endif
        });
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize CKEditor when modals are shown
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('shown.bs.modal', function(e) {
                const textarea = this.querySelector('textarea.rich-text-editor');
                if (textarea && !CKEDITOR.instances[textarea.id]) {
                    CKEDITOR.replace(textarea.id);
                }
            });

            // Destroy CKEditor when modals are hidden
            modal.addEventListener('hidden.bs.modal', function(e) {
                const textarea = this.querySelector('textarea.rich-text-editor');
                if (textarea && CKEDITOR.instances[textarea.id]) {
                    CKEDITOR.instances[textarea.id].destroy();
                }
            });
        });
    });
</script>
<script>
    function previewImage(event) {
        const preview = document.getElementById('imagePreview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none'); // Show preview
            };
            reader.readAsDataURL(file);
        }
    }
</script>
</body>
</html>
