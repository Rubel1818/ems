<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
        }

        .sidebar {
            min-height: 100vh;
            background: #0d6efd;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        .card-icon {
            font-size: 2.5rem;
            color: #0d6efd;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->


            <!-- Main Content -->
            <main class="col-md-9 col-lg-10 p-4">

                <!-- Top Bar -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold">Welcome, {{ auth()->user()->name ?? 'User' }}</h3>
                    <span class="badge bg-success">User Role</span>
                </div>

                <!-- Dashboard Cards -->
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-person card-icon"></i>
                                <h5 class="mt-3">Profile</h5>
                                <p class="text-muted">View and update your profile</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-bell card-icon"></i>
                                <h5 class="mt-3">Notifications</h5>
                                <p class="text-muted">Check latest alerts</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-shield-lock card-icon"></i>
                                <h5 class="mt-3">Security</h5>
                                <p class="text-muted">Manage security settings</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table Section -->
                <div class="card shadow-sm mt-5">
                    <div class="card-header bg-primary text-white">
                        Recent Activity
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Activity</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Profile Updated</td>
                                    <td>2025-01-10</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Password Changed</td>
                                    <td>2025-01-08</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
