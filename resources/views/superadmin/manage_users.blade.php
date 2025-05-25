
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - Camaligtas Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar-brand {
            font-family: 'Lobster', cursive;
            font-size: 1.8rem;
            font-weight: bold;
        }
        .navbar-brand .camalig {
            color: #e53935;
        }
        .navbar-brand .tas {
            color: #43a047;
        }
        .main-content {
            padding: 2rem 0;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
        }
        .card-header {
            background: linear-gradient(135deg, #e53935, #c62828);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            border: none;
            padding: 1.5rem 2rem;
        }
        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            transition: transform 0.2s ease;
            border: 1px solid #e9ecef;
        }
        .stats-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        }
        .stats-number {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        .stats-label {
            color: #6c757d;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .btn-action {
            padding: 0.4rem 0.8rem;
            margin: 0 0.1rem;
            border-radius: 8px;
            font-size: 0.85rem;
            border: none;
            transition: all 0.2s ease;
        }
        .btn-approve {
            background: #43a047;
            color: white;
        }
        .btn-approve:hover {
            background: #2e7d32;
            color: white;
        }
        .btn-reject {
            background: #e53935;
            color: white;
        }
        .btn-reject:hover {
            background: #c62828;
            color: white;
        }
        .btn-suspend {
            background: #ff9800;
            color: white;
        }
        .btn-suspend:hover {
            background: #f57c00;
            color: white;
        }
        .btn-activate {
            background: #2196f3;
            color: white;
        }
        .btn-activate:hover {
            background: #1976d2;
            color: white;
        }
        .table-responsive {
            border-radius: 12px;
            overflow: hidden;
        }
        .table th {
            background: #f8f9fa;
            border: none;
            font-weight: 600;
            color: #495057;
            padding: 1rem;
        }
        .table td {
            padding: 1rem;
            vertical-align: middle;
            border-color: #f1f3f4;
        }
        .filter-section {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }
        .badge {
            font-size: 0.75rem;
            padding: 0.5rem 0.75rem;
            border-radius: 20px;
        }
        .search-box {
            border-radius: 25px;
            border: 2px solid #e9ecef;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
        }
        .search-box:focus {
            border-color: #e53935;
            box-shadow: 0 0 0 0.2rem rgba(229,57,53,0.1);
        }
        .pagination .page-link {
            border: none;
            color: #e53935;
            border-radius: 8px;
            margin: 0 2px;
        }
        .pagination .page-item.active .page-link {
            background: #e53935;
            border-color: #e53935;
        }
        .alert {
            border: none;
            border-radius: 12px;
            margin-bottom: 1.5rem;
        }
        .user-photo {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #e9ecef;
            margin-right: 12px;
        }
        .position-label {
            font-size: 0.95rem;
            color: #1976d2;
            font-weight: 500;
        }
        .id-label {
            font-size: 0.85rem;
            color: #888;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="#">
            <span class="camalig">Camalig</span><span class="tas">tas</span>
        </a>
        <div class="navbar-nav ms-auto">
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-user-shield me-2"></i>Super Administrator
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('login') }}" class="dropdown-item">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

    <div class="container main-content">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col">
                <h1 class="h2 mb-0"><i class="fas fa-users-cog me-3"></i>User Management</h1>
                <p class="text-muted">Manage admin accounts and approval requests</p>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <div class="stats-number text-primary">4</div>
                    <div class="stats-label">Total Admins</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <div class="stats-number text-warning">3</div>
                    <div class="stats-label">Pending Approval</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <div class="stats-number text-success">1</div>
                    <div class="stats-label">Active Admins</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card">
                    <div class="stats-number text-danger">0</div>
                    <div class="stats-label">Suspended</div>
                </div>
            </div>
        </div>

        <!-- Success/Error Messages -->
        <div id="alertContainer"></div>

        <!-- Filters -->
        <div class="filter-section">
            <form class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control search-box" 
                           placeholder="Search by full name, email, or Official ID..." 
                           value="">
                </div>
                <div class="col-md-4">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="inactive">Inactive</option>
                        <option value="on_leave">On Leave</option>
                        <option value="suspended">Suspended</option>
                        <option value="terminated">Terminated</option>
                        <option value="retired">Retired</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="fas fa-search me-2"></i>Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Admins Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>Admin Accounts</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Full Name & Position</th>
                                <th>Contact</th>
                                <th>Official ID</th>
                                <th>Household ID</th>
                                <th>Status</th>
                                <th>Registered</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Example Admin Account -->
                            <tr data-user-id="2">
                                <td>
                                    <img src="{{ asset('images/admin_photos/admin2.jpg') }}" alt="Admin Photo" class="user-photo">
                                </td>
                                <td>
                                    <div>
                                        <strong>Juan Dela Cruz</strong>
                                        <div class="position-label">Barangay Secretary</div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <i class="fas fa-envelope me-1 text-muted"></i>admin@gmail.com
                                        <br>
                                        <small><i class="fas fa-phone me-1 text-muted"></i>09123456789</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="id-label">OFF-2025-0001</span>
                                </td>
                                <td>
                                    <span class="id-label">HH-2025-0001</span>
                                </td>
                                <td>
                                    <span class="badge bg-warning" id="status-2">
                                        Pending
                                    </span>
                                </td>
                                <td>
                                    <small>May 20, 2025 02:30 PM</small>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group-vertical btn-group-sm">
                                        <button class="btn btn-approve btn-action" 
                                                onclick="updateUserStatus(2, 'approve')">
                                            <i class="fas fa-check me-1"></i>Approve
                                        </button>
                                        <button class="btn btn-reject btn-action" 
                                                onclick="updateUserStatus(2, 'reject')">
                                            <i class="fas fa-times me-1"></i>Reject
                                        </button>
                                        <button class="btn btn-outline-danger btn-action" 
                                                onclick="deleteUser(2)">
                                            <i class="fas fa-trash me-1"></i>Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Add more admin rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalTitle">Confirm Action</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="confirmModalBody">
                    Are you sure you want to perform this action?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmButton">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let confirmModal;
        let pendingAction = null;

        document.addEventListener('DOMContentLoaded', function() {
            confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
        });

        function showAlert(type, message) {
            const alertContainer = document.getElementById('alertContainer');
            const alertHtml = `
                <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} me-2"></i>
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;
            alertContainer.innerHTML = alertHtml;
            
            // Auto dismiss after 5 seconds
            setTimeout(() => {
                const alert = alertContainer.querySelector('.alert');
                if (alert) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }
            }, 5000);
        }

        function updateUserStatus(userId, action) {
            const actionTexts = {
                'approve': { title: 'Approve Admin', body: 'Are you sure you want to approve this admin account?', btn: 'Approve' },
                'reject': { title: 'Reject Admin', body: 'Are you sure you want to reject this admin account?', btn: 'Reject' },
                'suspend': { title: 'Suspend Admin', body: 'Are you sure you want to suspend this admin account?', btn: 'Suspend' },
                'activate': { title: 'Activate Admin', body: 'Are you sure you want to activate this admin account?', btn: 'Activate' }
            };

            const actionText = actionTexts[action];
            document.getElementById('confirmModalTitle').textContent = actionText.title;
            document.getElementById('confirmModalBody').textContent = actionText.body;
            document.getElementById('confirmButton').textContent = actionText.btn;

            pendingAction = () => {
                const url = `/superadmin/users/${userId}/${action}`;
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showAlert('success', data.message);
                        updateRowStatus(userId, action);
                    } else {
                        showAlert('danger', data.message);
                    }
                })
                .catch(error => {
                    showAlert('danger', 'An error occurred. Please try again.');
                });
            };

            confirmModal.show();
        }

        function deleteUser(userId) {
            document.getElementById('confirmModalTitle').textContent = 'Delete Admin';
            document.getElementById('confirmModalBody').textContent = 'Are you sure you want to permanently delete this admin account? This action cannot be undone.';
            document.getElementById('confirmButton').textContent = 'Delete';

            pendingAction = () => {
                fetch(`/superadmin/users/${userId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showAlert('success', data.message);
                        // Remove the row from table
                        const row = document.querySelector(`tr[data-user-id="${userId}"]`);
                        if (row) {
                            row.remove();
                        }
                    } else {
                        showAlert('danger', data.message);
                    }
                })
                .catch(error => {
                    showAlert('danger', 'An error occurred. Please try again.');
                });
            };

            confirmModal.show();
        }

        function updateRowStatus(userId, action) {
            const statusElement = document.getElementById(`status-${userId}`);
            const row = document.querySelector(`tr[data-user-id="${userId}"]`);
            
            if (statusElement && row) {
                let newStatus, newClass;
                
                switch (action) {
                    case 'approve':
                        newStatus = 'Active';
                        newClass = 'bg-success';
                        break;
                    case 'reject':
                        newStatus = 'Rejected';
                        newClass = 'bg-dark';
                        break;
                    case 'suspend':
                        newStatus = 'Suspended';
                        newClass = 'bg-danger';
                        break;
                    case 'activate':
                        newStatus = 'Active';
                        newClass = 'bg-success';
                        break;
                }
                
                statusElement.textContent = newStatus;
                statusElement.className = `badge ${newClass}`;
                
                // Update action buttons
                setTimeout(() => {
                    location.reload();
                }, 1500);
            }
        }

        // Handle confirm button click
        document.getElementById('confirmButton').addEventListener('click', function() {
            if (pendingAction) {
                pendingAction();
                pendingAction = null;
                confirmModal.hide();
            }
        });
    </script>
</body>
</html>