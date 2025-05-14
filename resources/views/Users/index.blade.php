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

        .user-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .user-card:hover {
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
        .user-card .card-title {
            color: var(--text-color);
            font-weight: 600;
        }

        .user-card .card-header {
            background-color: rgba(255, 69, 0, 0.1);
            border-bottom: 2px solid var(--primary-color);
        }

        .user-card .card-footer {
            background-color: transparent;
            border-top: 1px solid rgba(0,0,0,0.1);
        }

        .user-card .thumbnail {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
        }

        /* Hide table on small screens, show cards instead */
        @media (max-width: 991.98px) {
            .users-table {
                display: none;
            }
            .users-cards {
                display: block;
            }
        }

        /* Hide cards on large screens, show table instead */
        @media (min-width: 992px) {
            .users-table {
                display: block;
            }
            .users-cards {
                display: none;
            }
        }
    </style>
</head>
<body>
    <x-app-layout>
        <div>


        @if(session('success'))
    <div class="alert alert-success" id="successMessage">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(function() {
            let successMessage = document.getElementById('successMessage');
            if (successMessage) {
                successMessage.style.transition = "opacity 0.5s";
                successMessage.style.opacity = "0";
                setTimeout(() => successMessage.remove(), 500); // Remove after fade-out
            }
        }, 4000);
    </script>
@endif
            <div class="card p-4">
                <div class="d-flex justify-content-between align-items-center page-header">
                <h1 class="text-2xl font-bold text-gray-800">
                        <i class="fas fa-users me-2" style="color: var(--primary-color)"></i>Users Management</h1>

                    <button class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#addModal">Add User</button>
                </div>

                <form method="GET" action="{{ route('users.index') }}" class="mb-3 d-flex gap-2">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search by name or email" value="{{ request('search') }}" >
                <select name="status" class="form-select" >
                    <option value="">All Status</option>
                    <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Inactive" {{ request('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                <button type="submit" class="btn btn-primary btn-sm">Search</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm">Reset</a>
            </form>


                <table class="table mt-3">



                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Registered Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="usersTableBody">
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                <td>
                                <button class="btn btn-primary btn-sm" onclick="viewUser('{{ $user->name }}', '{{ $user->email }}', '{{ $user->status }}')">View</button>
                                    <button class="btn btn-success btn-sm" onclick="editUser({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}')">Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteUser({{ $user->id }})">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </x-app-layout>

    <!-- Add User Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.store') }}" method="POST" id="addUserForm">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" id="addUserName" name="name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="addUserEmail" name="email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" id="addUserPassword" name="password">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confrim Password</label>
                            <input type="password" class="form-control" id="addUserPassword" name="confirm_password">
                        </div>
                        <button type="submit" class="btn btn-success">Add User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                <form id="editUserForm" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" id="editUserId" name="id">
    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" class="form-control" id="editUserName" name="name">
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" id="editUserEmail" name="email">
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" id="editUserPassword" name="password" placeholder="Leave blank to keep current password">
    </div>
    <button type="submit" class="btn btn-success">Save Changes</button>
</form>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="viewUserBody"></div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this user?</p>
            </div>
            <div class="modal-footer">
                <form id="deleteUserForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <script>
 function viewUser(name, email, status) {
            document.getElementById('viewUserBody').innerHTML = `<p><strong>Name:</strong> ${name}</p><p><strong>Email:</strong> ${email}</p><p><strong>Status:</strong> ${status ? 'Active' : 'Inactive'}</p>`;
            new bootstrap.Modal(document.getElementById('viewModal')).show();
        }

        function editUser(id, name, email) {
            document.getElementById('editUserId').value = id;
            document.getElementById('editUserName').value = name;
            document.getElementById('editUserEmail').value = email;
            document.getElementById('editUserPassword').value = '';
            document.getElementById('editUserForm').action = `/users/${id}`;

            new bootstrap.Modal(document.getElementById('editModal')).show();

        }

        function deleteUser(userId) {
    let form = document.getElementById('deleteUserForm');
    form.action = `/users/${userId}`; // Ensure this matches your route
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}


    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
