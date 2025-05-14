<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <x-app-layout>
        <div class="card p-4">

        @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <script>
        setTimeout(function() {
            let successAlert = document.getElementById('successAlert');
            if (successAlert) {
                let alertInstance = new bootstrap.Alert(successAlert);
                alertInstance.close();
            }
        }, 4000); // 4 seconds
    </script>
@endif

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1>Trips Management</h1>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTripModal">Add Trip</button>
            </div>

            <form method="GET" action="{{ route('trips.index') }}" class="mb-3 d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search by trip title..." value="{{ request('search') }}">
                <select name="filter" class="form-control me-2">
                    <option value="">All Status</option>
                    <option value="Upcoming" {{ request('filter') == 'Upcoming' ? 'selected' : '' }}>Upcoming</option>
                    <option value="Ongoing" {{ request('filter') == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                    <option value="Completed" {{ request('filter') == 'Completed' ? 'selected' : '' }}>Completed</option>
                </select>
                <button type="submit" class="btn btn-primary">Search</button>
                <a href="{{ route('trips.index') }}" class="btn btn-secondary ms-2">Reset</a>
            </form>

            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>Trip Title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Created By</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trips as $trip)
                        <tr>
                            <td>{{ $trip->title }}</td>
                            <td>{{$trip->description}}</td>
                            <td>
                                @if ($trip->image)
                                    <img src="{{ asset('storage/' . $trip->image) }}" alt="Trip Image" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>{{ $trip->start_date }}</td>
                            <td>{{ $trip->end_date }}</td>
                            <td>{{ $trip->creator->name ?? 'Unknown' }}</td>
                            <td>
    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal{{ $trip->id }}">
        <i class="fas fa-eye"></i> View
    </button>
    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $trip->id }}">
        <i class="fas fa-edit"></i> Edit
    </button>
    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $trip->id }}">
        <i class="fas fa-trash"></i> Delete
    </button>
</td>

                        </tr>

                       <!-- View Modal -->
<div class="modal fade" id="viewModal{{ $trip->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $trip->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel{{ $trip->id }}">Trip Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Title:</strong> {{ $trip->title }}</p>
                <p><strong>Destination:</strong> {{ $trip->destination }}</p>
                <p><strong>Start Date:</strong> {{ $trip->start_date }}</p>
                <p><strong>End Date:</strong> {{ $trip->end_date }}</p>
                <p><strong>Status:</strong> {{ $trip->status }}</p>
                <p><strong>Image:</strong></p>
                <img src="{{ $trip->image_url }}" class="img-fluid" alt="Trip Image">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal{{ $trip->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $trip->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $trip->id }}">Edit Trip</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('trips.update', $trip->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Trip Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $trip->title }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <input type="text" name="description" class="form-control" value="{{ $trip->description }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Start Date</label>
                        <input type="date" name="start_date" class="form-control" value="{{ $trip->start_date }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">End Date</label>
                        <input type="date" name="end_date" class="form-control" value="{{ $trip->end_date }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Trip Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Update Trip</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal{{ $trip->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $trip->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $trip->id }}">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete <strong>{{ $trip->title }}</strong>?
            </div>
            <div class="modal-footer">
                <form action="{{ route('trips.destroy', $trip->id) }}" method="POST">
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
                </tbody>
            </table>
        </div>
    </x-app-layout>

    <!-- Add Trip Modal -->
    <div class="modal fade" id="addTripModal" tabindex="-1" aria-labelledby="addTripModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTripModalLabel">Add New Trip</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('trips.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Trip Title</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" name="description" id="description" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Trip Image</label>
                            <input type="file" name="image" id="image" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Trip</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
