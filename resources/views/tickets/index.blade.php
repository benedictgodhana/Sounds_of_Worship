<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<!-- jQuery (Required for Toastr) -->
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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

.pagination {
    display: flex;
    justify-content: center;
    padding: 10px 0;
}

.pagination .page-item .page-link {
    color: #fff; /* Text color */
    background-color: #007bff; /* Primary button color */
    border: 1px solid #007bff; 
    padding: 8px 12px;
    border-radius: 5px;
    margin: 0 3px;
    transition: all 0.3s ease;
}

.pagination .page-item.active .page-link {
    background-color: #0056b3; /* Darker blue for active page */
    border-color: #0056b3;
}

.pagination .page-item .page-link:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}

.pagination .page-item.disabled .page-link {
    background-color: #ddd;
    color: #666;
}


    </style>
</head>
<body>
    <x-app-layout>
        <div class="container-fluid py-4" x-data="{
            searchQuery: '',
            tickets: [],
            filteredtickets: [],
            init() {
                this.tickets = Array.from(document.querySelectorAll('#ticketsTableBody tr'))
                    .map(row => {
                        return {
                            element: row,
                            name: row.querySelector('td:nth-child(1)').textContent.trim().toLowerCase(),
                            sku: row.querySelector('td:nth-child(2)').textContent.trim().toLowerCase(),
                            cardElement: document.querySelector(`.tickets-card[data-id='${row.getAttribute('data-id')}']`)
                        };
                    });
                this.filtertickets();
            },
            filtertickets() {
                const query = this.searchQuery.toLowerCase();
                this.filteredtickets = this.tickets.filter(tickets =>
                    tickets.name.includes(query) || tickets.sku.includes(query)
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
                        <i class="fas fa-cube me-2" style="color: var(--primary-color)"></i>tickets Management
                    </h1>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addticketsModal">
                        <i class="fas fa-plus me-1"></i> Add tickets
                    </button>
                </div>
                <div class="flex justify-between items-center mb-6">
    <!-- Search and Filter Form -->
    <form method="GET" action="{{ route('all_tickets.index') }}" class="flex space-x-3">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search tickets..."
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
<a href="{{ route('all_tickets.index') }}" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 flex items-center space-x-2" 
   style="text-decoration: none;">
    <i class="fas fa-sync-alt"></i>
    <span>Reset</span>
</a>

    </form>
</div>



                <!-- Table Structure -->
                <div class="tickets-table table-responsive">
                <table class="table table-hover align-middle">
    <thead>
        <tr>
            <th>Event</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Ticket Type</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Payment Status</th>
            <th>Ticket Number</th>
            <th>Transaction ID</th>
            <th>Actions</th> <!-- Action Buttons -->
        </tr>
    </thead>
    <tbody id="ticketsTableBody">
        @foreach ($tickets as $ticket)
        <tr data-id="{{ $ticket->id }}">
            <td>{{ $ticket->event->name ?? 'N/A' }}</td>
            <td>{{ $ticket->full_name ?? 'N/A' }}</td>
            <td>{{ $ticket->email }}</td>
            <td>{{ $ticket->phone }}</td>
            <td>{{ $ticket->ticket_type }}</td>
            <td>{{ $ticket->quantity }}</td>
            <td>Ksh {{ number_format($ticket->total_price, 2) }}</td>
            <td>{{ $ticket->payment_status }}</td>
            <td>{{ $ticket->ticket_number }}</td>
            <td>{{ $ticket->transaction_id }}</td>
            <td>
                <!-- Edit Button -->
                <a href="" class="btn btn-sm btn-primary">
                    <i class="fas fa-edit"></i>
                </a>

                <!-- Delete Button -->
                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteTicketModal{{ $ticket->id }}">
                    <i class="fas fa-trash-alt"></i>
                </button>

                <!-- Delete Confirmation Modal -->
                <div class="modal fade" id="deleteTicketModal{{ $ticket->id }}" tabindex="-1" aria-labelledby="deleteTicketModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteTicketModalLabel">Confirm Deletion</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete the ticket for <strong>{{ $ticket->full_name }}</strong>?
                            </div>
                            <div class="modal-footer">
                                <form action="" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
    
</table>
<div class="d-flex justify-content-center mt-3">
    <nav aria-label="Page navigation">
        {{ $tickets->links('pagination::bootstrap-5') }}
    </nav>
</div>


                </div>

<!-- Add Free Tickets Modal -->
<div class="modal fade" id="addticketsModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-ticket-alt me-2"></i>Register for Free Tickets</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="freeTicketForm">
                    @csrf
                    <div class="row g-3">
                        <!-- Event Selection -->
                        <div class="col-md-12">
                            <label for="event_id">Select Event</label>
                            <select class="form-select" id="event_id" name="event_id" required>
                                <option value="" selected>-- Select Event --</option>
                                @foreach($events as $event)
                                    <option value="{{ $event->id }}">{{ $event->name }} (Capacity: {{ $event->capacity - $event->tickets_sold }} left)</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Full Name -->
                        <div class="col-md-6">
                            <label for="full_name">Full Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" required>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <!-- Phone Number -->
                        <div class="col-md-6">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>

                        <!-- Ticket Quantity -->
                        <div class="col-md-6">
                            <label for="quantity">Ticket Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary">Register for Free Ticket</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



    </x-app-layout>

    <!-- Scripts remain same -->
    <script>
        // Initialize CKEditor for tickets description
        document.querySelectorAll('.rich-text-editor').forEach(editor => {
            CKEDITOR.replace(editor);
        });
    </script>
</body>
</html>
