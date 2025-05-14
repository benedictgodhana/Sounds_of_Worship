<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.10.3/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

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

        .inquiry-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .inquiry-card:hover {
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
        .inquiry-card .card-title {
            color: var(--text-color);
            font-weight: 600;
        }

        .inquiry-card .card-header {
            background-color: rgba(255, 69, 0, 0.1);
            border-bottom: 2px solid var(--primary-color);
        }

        .inquiry-card .card-footer {
            background-color: transparent;
            border-top: 1px solid rgba(0,0,0,0.1);
        }

        .inquiry-card .thumbnail {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
        }

        /* Hide table on small screens, show cards instead */
        @media (max-width: 991.98px) {
            .inquiries-table {
                display: none;
            }
            .inquiries-cards {
                display: block;
            }
        }

        /* Hide cards on large screens, show table instead */
        @media (min-width: 992px) {
            .inquiries-table {
                display: block;
            }
            .inquiries-cards {
                display: none;
            }
        }
    </style>
</head>
<body>
    <x-app-layout>
        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center page-header">
                <h1 class="text-2xl font-bold text-gray-800">
                        <i class="fas fa-question-circle me-2" style="color: var(--primary-color)"></i>Inquiries Management</h1>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <!-- Search and Filter Form -->
            <form method="GET" action="{{ route('inquiries.index') }}" class="mb-3 d-flex gap-2">
                <input type="text" name="search" class="form-control" placeholder="Search by name or email" value="{{ request('search') }}">
                <select name="trip_id" class="form-select">
                    <option value="">Filter by Trip</option>
                    @foreach ($tripIds as $trip)
                        <option value="{{ $trip->id }}" {{ request('trip_id') == $trip->id ? 'selected' : '' }}>{{ $trip->title }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Search</button>
                <a href="{{ route('inquiries.index') }}" class="btn btn-secondary">Reset</a>
            </form>

            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Trip</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inquiries as $inquiry)
                        <tr>
                            <td>{{ $inquiry->name }}</td>
                            <td>{{ $inquiry->email }}</td>
                            <td>{{ $inquiry->phone }}</td>
                            <td>{{ $inquiry->trip->title ?? 'N/A' }}</td>
                            <td>{{ $inquiry->message }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#replyModal{{ $inquiry->id }}">
                                    <i class="fas fa-reply"></i> Reply
                                </button>
                            </td>
                        </tr>

                        <!-- Reply Modal -->
                        <div class="modal fade" id="replyModal{{ $inquiry->id }}" tabindex="-1" aria-labelledby="replyModalLabel{{ $inquiry->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="replyModalLabel{{ $inquiry->id }}">Reply to {{ $inquiry->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('inquiries.reply') }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="replyMessage" class="form-label">Message</label>
                                                <textarea class="form-control" name="message" id="replyMessage" rows="3" required></textarea>
                                            </div>
                                            <input type="hidden" name="contact_id" value="{{ $inquiry->id }}">
                                            <input type="hidden" name="email" value="{{ $inquiry->email }}">

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Send Reply</button>
                                            </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
