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
            background: rgb(255, 255, 255);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }

        /* Responsive Navbar Styles */
        .navbar {
            padding: 0.5rem 1rem;
        }
        
        .navbar-brand {
            font-family: 'Lobster', cursive;
            font-size: 1.8rem;
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            width: 40px;
            height: auto;
            margin-right: 0.5rem;
        }

        /* Main Content Styles */
        .main-content {
            padding: 1rem;
            margin-top: 1rem;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #e53935, #c62828);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            border: none;
            padding: 1rem 1.5rem;
        }

        /* Stats Cards */
        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 1.25rem;
            height: 100%;
            text-align: center;
            transition: transform 0.2s ease;
            border: 1px solid #e9ecef;
        }

        .stats-number {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        /* Table Responsive */
        .table-responsive {
            margin: 0;
            padding: 0;
            width: 100%;
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            white-space: nowrap;
            background: #f8f9fa;
        }

        /* Action Buttons */
        .btn-action {
            padding: 0.4rem 0.8rem;
            margin: 0.2rem;
            white-space: nowrap;
        }

        /* Search and Filter Section */
        .filter-section {
            background: white;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .search-box {
            border-radius: 25px;
            padding: 0.5rem 1rem;
        }

        /* Responsive Breakpoints */
        @media (max-width: 1200px) {
            .stats-number {
                font-size: 1.75rem;
            }
        }

        @media (max-width: 992px) {
            .navbar-brand {
                font-size: 1.5rem;
            }
            .stats-card {
                margin-bottom: 1rem;
            }
            .btn-action {
                padding: 0.3rem 0.6rem;
                font-size: 0.8rem;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 0.5rem;
            }
            .navbar-brand {
                font-size: 1.3rem;
            }
            .navbar-brand img {
                width: 30px;
            }
            .stats-number {
                font-size: 1.5rem;
            }
            .table-responsive {
                font-size: 0.9rem;
            }
            .filter-section form {
                flex-direction: column;
            }
            .filter-section .col-md-6,
            .filter-section .col-md-4,
            .filter-section .col-md-2 {
                margin-bottom: 1rem;
            }
        }

        @media (max-width: 576px) {
            .main-content {
                padding: 0.5rem;
            }
            .card-header {
                padding: 1rem;
            }
            .stats-card {
                padding: 1rem;
            }
            .btn-action {
                width: 100%;
                margin-bottom: 0.5rem;
            }
            .user-photo {
                width: 36px;
                height: 36px;
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg shadow-sm" style="background-color: rgb(247, 247, 247);">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#" style="margin-right: auto;">
            <img src="{{ asset('assets/img/logo_camalig.png') }}" alt="Logo" class="d-none d-sm-block">
            <div class="brand-text">
                <span class="camalig" style="color:rgb(252, 122, 46);">Camalig</span><span class="tas" style="color:rgb(12, 207, 22);">tas</span>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
            <div class="navbar-nav ms-auto">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-shield me-2"></i>Super Administrator
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a href="{{ route('login') }}" class="dropdown-item">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="container main-content">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h2 mb-2"><i class="fas fa-users-cog me-3"></i>User Management</h1>
            <p class="text-muted">Manage admin accounts and approval requests</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="stats-card">
                <div class="stats-number text-primary">4</div>
                <div class="stats-label">Total Admins</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stats-card">
                <div class="stats-number text-warning">3</div>
                <div class="stats-label">Pending</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stats-card">
                <div class="stats-number text-success">1</div>
                <div class="stats-label">Active</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
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
            <div class="col-12 col-md-6">
                <input type="text" name="search" class="form-control search-box" 
                       placeholder="Search by name, email, or ID...">
            </div>
            <div class="col-12 col-md-4">
                <select name="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="inactive">Inactive</option>
                    <option value="on_leave">On Leave</option>
                    <option value="suspended">Suspended</option>
                    <option value="terminated">Terminated</option>
                    <option value="retired">Retired</option>
                </select>
            </div>
            <div class="col-12 col-md-2">
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
                                <img src="{{ asset('images/admin_photos/admin2.jpg') }}" alt="Admin Photo" class="user-photo rounded-circle">
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
                                <span class="badge bg-warning">Pending</span>
                            </td>
                            <td>
                                <small>May 20, 2025</small>
                            </td>
                            <td>
                                <div class="d-flex flex-column flex-sm-row gap-2 justify-content-center">
                                    <button class="btn btn-approve btn-action">
                                        <i class="fas fa-check me-1"></i>Approve
                                    </button>
                                    <button class="btn btn-reject btn-action">
                                        <i class="fas fa-times me-1"></i>Reject
                                    </button>
                                    <button class="btn btn-outline-danger btn-action">
                                        <i class="fas fa-trash me-1"></i>Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
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