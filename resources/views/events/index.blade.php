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
    <!-- Same head section as before -->
    <style>
        /* Add to existing styles */
        .event-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        .badge-free {
            background-color:green;
            color: #22543D;
        }
        .badge-paid {
            background-color:blue;
            color: #553C9A;
        }
        .date-picker {
            border-radius: 5px;
            padding: 0.375rem 0.75rem;
        }
    </style>
</head>
<body>
    <x-app-layout>
        <div class="container-fluid py-4" x-data="{
            searchQuery: '',
            all_events: [],
            filteredall_events: [],
            init() {
                this.all_events = Array.from(document.querySelectorAll('#eventTableBody tr'))
                    .map(row => {
                        return {
                            element: row,
                            title: row.querySelector('td:nth-child(1)').textContent.trim().toLowerCase(),
                            cardElement: document.querySelector(`.event-card[data-id='${row.getAttribute('data-id')}']`)
                        };
                    });
                this.filterall_events();
            },
            filterall_events() {
                this.filteredall_events = this.all_events.filter(event =>
                    event.title.includes(this.searchQuery.toLowerCase())
                );

                this.all_events.forEach(event => {
                    if (this.filteredall_events.includes(event)) {
                        if (event.element) event.element.style.display = '';
                        if (event.cardElement) event.cardElement.style.display = '';
                    } else {
                        if (event.element) event.element.style.display = 'none';
                        if (event.cardElement) event.cardElement.style.display = 'none';
                    }
                });

                // Update empty states
                const tableEmptyState = document.getElementById('tableEmptyState');
                const cardsEmptyState = document.getElementById('cardsEmptyState');

                if (this.filteredall_events.length === 0) {
                    if (tableEmptyState) tableEmptyState.style.display = 'block';
                    if (cardsEmptyState) cardsEmptyState.style.display = 'block';
                } else {
                    if (tableEmptyState) tableEmptyState.style.display = 'none';
                    if (cardsEmptyState) cardsEmptyState.style.display = 'none';
                }
            }
        }">
            <div class="card p-4">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert"
                    x-init="setTimeout(() => { document.getElementById('successAlert').remove() }, 4000)">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <!-- Header section -->
                <div class="d-flex justify-content-between align-items-center page-header mb-4">
                    <h1 class="text-2xl font-bold text-gray-800">
                        <i class="fas fa-calendar-alt me-2" style="color: var(--primary-color)"></i>Event Management
                    </h1>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEventModal">
                        <i class="fas fa-plus me-1"></i> Add New Event
                    </button>
                </div>


                <!-- Search section -->
                <div class="search-filter mb-4">
                    <div class="input-group">
                        <span class="input-group-text" style="background-color: var(--primary-color); color: white;">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" x-model="searchQuery" x-on:input="filterall_events()"
                            class="form-control" placeholder="Search by event title...">
                    </div>
                </div>

                <!-- all_events table -->
                <div class="all_events-table table-responsive">
                <table class="table table-hover align-middle">
    <thead>
        <tr>
            <th>Event Title</th>
            <th>Date</th>
            <th>Location</th>
            <th>Description</th>
            <th>Event Type</th>
            <th>Event Image</th>
            <th>Tickets</th>
            <th>Capacity</th>
            <th>Tickets Sold</th>
            <th>Remaining Tickets</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="eventTableBody">
        @foreach ($all_events as $event)
        <tr data-id="{{ $event->id }}">
            <td class="fw-medium">{{ $event->name }}</td>
            <td>{{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}</td>
            <td>{{ $event->location }}</td>
            <td>{{ $event->description }}</td>
            <td>
                <span class="badge {{ $event->is_paid ? 'badge-paid' : 'badge-free' }}">
                    {{ $event->is_paid ? 'Paid' : 'Free' }}
                </span>
            </td>
            <td>
                @if($event->event_image)
                    <img src="{{ asset('storage/' . $event->event_image) }}" alt="Event Image" width="60" height="60" class="rounded">
                @else
                    <span class="text-muted">No Image</span>
                @endif
            </td>
            <td>
    @php
        $ticketCategories = json_decode($event->ticket_categories, true) ?? [];
    @endphp
    @if(!empty($ticketCategories) && is_array($ticketCategories))
        @foreach($ticketCategories as $ticket)
            <span class="badge bg-secondary">
                {{ $ticket['category'] ?? 'Unknown' }} - Ksh {{ number_format($ticket['price'] ?? 0) }}
            </span>
        @endforeach
    @else
        <span class="text-muted">No Tickets</span>
    @endif
</td>


            <td>{{ $event->capacity ?? 'N/A' }}</td>
            <td>{{ $event->tickets_sold ?? 0 }}</td>
            <td>{{ ($event->capacity - $event->tickets_sold) > 0 ? ($event->capacity - $event->tickets_sold) : 0 }}</td>
            <td>
    <span class="badge
        @if($event->status == 'available') bg-success
        @elseif($event->status == 'fully booked') bg-danger
        @else bg-warning @endif">
        {{ ucfirst($event->status) }}
    </span>
</td>

            <td>
                <div class="d-flex gap-1">
                    <button class="btn btn-sm" style="background-color: var(--primary-color); color: white;"
                        data-bs-toggle="modal" data-bs-target="#editEvent{{ $event->id }}">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                        data-bs-target="#viewEventModal{{ $event->id }}">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                        data-bs-target="#deleteEventModal{{ $event->id }}">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


                    <div id="tableEmptyState" class="text-center py-5" style="display: none;">
                        <i class="fas fa-search mb-3" style="font-size: 2rem; color: var(--primary-color);"></i>
                        <h4>No matching all_events found</h4>
                        <p class="text-muted">Try changing your search query or add a new event</p>
                    </div>
                </div>

  <!-- Add Event Modal -->
<div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEventModalLabel">
                    <i class="fas fa-plus-circle me-2"></i> Create New Event
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('all_events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Event Name</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Event Date</label>
                                <input type="date" class="form-control" name="event_date" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Location</label>
                                <input type="text" class="form-control" name="location" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Event Type</label>
                                <select class="form-select" name="is_paid" id="eventType">
                                    <option value="0">Free Event</option>
                                    <option value="1">Paid Event</option>
                                </select>
                            </div>

                            <!-- Ticket Categories Table (Hidden by default) -->
                            <div id="ticketCategorySection" style="display: none;">
                                <label class="form-label">Ticket Categories</label>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Category Name</th>
                                            <th>Price (Ksh)</th>
                                            <th>Quantity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="ticketCategoriesTable">
                                        <!-- Dynamic rows will be added here -->
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-success btn-sm" id="addTicketCategory">
                                    <i class="fas fa-plus"></i> Add Category
                                </button>
                                <input type="hidden" name="ticket_categories" id="ticketCategoriesInput">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Total Tickets Available</label>
                                <input type="number" class="form-control" name="capacity" min="1" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Event Image</label>
                                <input type="file" class="form-control" name="event_image" accept="image/*">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" name="is_featured" value="1">
                                <label class="form-check-label">Feature this event</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="4"></textarea>
                    </div>

                    <div class="text-end mt-4">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Create Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@foreach ($all_events as $event)
<!-- View Event Modal -->
<div class="modal fade" id="viewEventModal{{ $event->id }}" tabindex="-1" aria-labelledby="viewEventModalLabel{{ $event->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewEventModalLabel{{ $event->id }}">
                    <i class="fas fa-eye me-2"></i> Event Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Event Name:</strong> {{ $event->name }}</p>
                        <p><strong>Event Date:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</p>
                        <p><strong>Location:</strong> {{ $event->location }}</p>
                        <p><strong>Event Type:</strong> {{ $event->is_paid ? 'Paid Event' : 'Free Event' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Total Tickets:</strong> {{ $event->capacity }}</p>
                        <p><strong>Featured:</strong> {{ $event->is_featured ? 'Yes' : 'No' }}</p>
                        @if(!empty($event->description))
                            <p><strong>Description:</strong> {{ $event->description }}</p>
                        @endif
                        @if($event->event_image)
                            <p><strong>Event Image:</strong></p>
                            <img src="{{ asset('storage/' . $event->event_image) }}" class="img-fluid rounded" alt="Event Image">
                        @endif
                    </div>
                </div>

                @if($event->is_paid && !empty($event->ticket_categories))
    @php
        $ticketCategories = json_decode($event->ticket_categories, true);
    @endphp

    @if(is_array($ticketCategories) && count($ticketCategories) > 0)
        <h5 class="mt-4"><i class="fas fa-ticket-alt me-2"></i> Ticket Categories</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Price (Ksh)</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>

                @foreach($ticketCategories as $ticket)
                    <tr>
                        <td>{{ $ticket['category'] ?? 'N/A' }}</td>
                        <td>Ksh {{ number_format($ticket['price'] ?? 0, 2) }}</td>
                        <td>{{ $ticket['quantity'] ?? 0 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endif

            </div>
        </div>
    </div>
</div>
@endforeach




@foreach ($all_events as $event)
<!-- Edit Event Modal -->
<div class="modal fade" id="editEvent{{ $event->id }}" tabindex="-1" aria-labelledby="editEventModalLabel{{ $event->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEventModalLabel{{ $event->id }}">
                    <i class="fas fa-edit me-2"></i> Edit Event
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('all_events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Event Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $event->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Event Date</label>
                                <input type="date" class="form-control" name="event_date" value="{{ \Carbon\Carbon::parse($event->event_date)->format('Y-m-d') }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Location</label>
                                <input type="text" class="form-control" name="location" value="{{ $event->location }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Event Type</label>
                                <select class="form-select" name="is_paid" id="editEventType{{ $event->id }}">
                                    <option value="0" {{ !$event->is_paid ? 'selected' : '' }}>Free Event</option>
                                    <option value="1" {{ $event->is_paid ? 'selected' : '' }}>Paid Event</option>
                                </select>
                            </div>

                            <!-- Ticket Categories (Shown if Paid Event) -->
                            <div id="editTicketCategorySection{{ $event->id }}" style="{{ $event->is_paid ? '' : 'display: none;' }}">
                                <label class="form-label">Ticket Categories</label>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Category Name</th>
                                            <th>Price (Ksh)</th>
                                            <th>Quantity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="editTicketCategoriesTable{{ $event->id }}">
                                        @php
                                            $ticketCategories = json_decode($event->ticket_categories, true) ?? [];
                                        @endphp
                                        @foreach ($ticketCategories as $index => $ticket)
                                            <tr>
                                                <td><input type="text" class="form-control" name="ticket_categories[{{ $index }}][category]" value="{{ $ticket['category'] }}"></td>
                                                <td><input type="number" class="form-control" name="ticket_categories[{{ $index }}][price]" value="{{ $ticket['price'] }}"></td>
                                                <td><input type="number" class="form-control" name="ticket_categories[{{ $index }}][quantity]" value="{{ $ticket['quantity'] }}"></td>
                                                <td><button type="button" class="btn btn-danger btn-sm remove-ticket"><i class="fas fa-trash"></i></button></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-success btn-sm add-edit-ticket" data-event-id="{{ $event->id }}">
                                    <i class="fas fa-plus"></i> Add Category
                                </button>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Total Tickets Available</label>
                                <input type="number" class="form-control" name="capacity" value="{{ $event->capacity }}" min="1" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Event Image</label>
                                <input type="file" class="form-control" name="event_image" accept="image/*">
                                @if($event->event_image)
                                    <img src="{{ asset('storage/' . $event->event_image) }}" class="img-fluid rounded mt-2" width="150" alt="Event Image">
                                @endif
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" name="is_featured" value="1" {{ $event->is_featured ? 'checked' : '' }}>
                                <label class="form-check-label">Feature this event</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="4">{{ $event->description }}</textarea>
                    </div>

                    <div class="text-end mt-4">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Update Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach




        <!-- Edit/View/Delete Modals -->
        @foreach ($all_events as $event)

<!-- Delete Event Modal -->
<div class="modal fade" id="deleteEventModal{{ $event->id }}" tabindex="-1" aria-labelledby="deleteEventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteEventModalLabel">
                    <i class="fas fa-trash-alt me-2"></i> Confirm Delete
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this event?</p>
                <form id="deleteEventForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="event_id" id="deleteEventId">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger" form="deleteEventForm">
                    <i class="fas fa-trash me-1"></i> Delete
                </button>
            </div>
        </div>
    </div>
</div>

        @endforeach

    </x-app-layout>

    <script>
        // Event type toggle
        document.getElementById('eventType').addEventListener('change', function() {
            document.getElementById('ticketPriceField').style.display =
                this.value === '0' ? 'block' : 'none';
        });
    </script>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const eventType = document.getElementById('eventType');
    const ticketSection = document.getElementById('ticketCategorySection');
    const addCategoryBtn = document.getElementById('addTicketCategory');
    const ticketTable = document.getElementById('ticketCategoriesTable');
    const ticketInput = document.getElementById('ticketCategoriesInput');

    eventType.addEventListener('change', function () {
        if (this.value == "1") {
            ticketSection.style.display = "block";
        } else {
            ticketSection.style.display = "none";
            ticketTable.innerHTML = "";
            updateCategories();
        }
    });

    addCategoryBtn.addEventListener('click', function () {
        const row = document.createElement('tr');

        row.innerHTML = `
            <td><input type="text" class="form-control category-name" required></td>
            <td><input type="number" class="form-control category-price" min="0" required></td>
            <td><input type="number" class="form-control category-quantity" min="1" required></td>
            <td><button type="button" class="btn btn-danger btn-sm remove-category"><i class="fas fa-trash"></i></button></td>
        `;

        ticketTable.appendChild(row);
        updateCategories();
    });

    ticketTable.addEventListener('click', function (e) {
        if (e.target.closest('.remove-category')) {
            e.target.closest('tr').remove();
            updateCategories();
        }
    });

    function updateCategories() {
        const categories = [];
        document.querySelectorAll('#ticketCategoriesTable tr').forEach(row => {
            const name = row.querySelector('.category-name').value;
            const price = row.querySelector('.category-price').value;
            const quantity = row.querySelector('.category-quantity').value;
            if (name && price && quantity) {
                categories.push({ name, price, quantity });
            }
        });
        ticketInput.value = JSON.stringify(categories);
    }

    ticketTable.addEventListener('input', updateCategories);
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Listen for clicks on "Add Category" buttons
    document.querySelectorAll(".add-edit-ticket").forEach(function (button) {
        button.addEventListener("click", function () {
            let eventId = this.getAttribute("data-event-id");
            let ticketTable = document.querySelector(`#editTicketCategoriesTable${eventId}`);

            if (!ticketTable) return;

            // Get current row count for indexing
            let rowCount = ticketTable.querySelectorAll("tr").length;

            // Create a new row
            let newRow = document.createElement("tr");
            newRow.innerHTML = `
                <td>
                    <input type="text" class="form-control" name="ticket_categories[${rowCount}][category]" placeholder="Category">
                </td>
                <td>
                    <input type="number" class="form-control" name="ticket_categories[${rowCount}][price]" placeholder="Price">
                </td>
                <td>
                    <input type="number" class="form-control" name="ticket_categories[${rowCount}][quantity]" placeholder="Quantity">
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-ticket">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            `;

            ticketTable.appendChild(newRow);
        });
    });

    // Handle removing ticket categories dynamically
    document.addEventListener("click", function (event) {
        if (event.target.classList.contains("remove-ticket") || event.target.closest(".remove-ticket")) {
            event.target.closest("tr").remove();
        }
    });

    // Show/Hide Ticket Category Section Based on Event Type Selection
    document.querySelectorAll("select[name='is_paid']").forEach(function (select) {
        select.addEventListener("change", function () {
            let eventId = this.id.replace("editEventType", "");
            let ticketSection = document.getElementById(`editTicketCategorySection${eventId}`);
            if (this.value == "1") {
                ticketSection.style.display = "block";
            } else {
                ticketSection.style.display = "none";
            }
        });
    });
});
</script>

</body>
</html>
