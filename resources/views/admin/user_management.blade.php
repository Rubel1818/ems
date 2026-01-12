<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management | Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600&family=Inter:wght@400;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Inter', 'Hind Siliguri', sans-serif;
            margin: 0;
        }

        /* Layout Structure */
        .main-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .content-area {
            flex-grow: 1;
            padding: 20px;
            margin-top: 60px;
            /* Adjust based on your header height */
            transition: all 0.3s;
        }

        .main-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
            background: white;
        }

        .table thead th {
            background-color: #f1f4f8;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
            color: #555;
            border-top: none;
        }

        .badge {
            padding: 0.5em 0.8em;
            font-weight: 500;
            border-radius: 6px;
        }

        .bg-success-soft {
            background-color: #05bc5e;
            color: #28a745;
        }

        .bg-warning-soft {
            background-color: #eb9012;
            color: #ffc107;
        }

        .btn-approve {
            background-color: #4e73df;
            border: none;
            color: white;
            transition: all 0.2s;
        }

        .btn-approve:hover {
            background-color: #2e59d9;
            transform: translateY(-1px);
            color: white;
        }

        .page-header {
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e3e6f0;
        }
    </style>
</head>

<body>
    @include('employees.header')

    <div class="main-wrapper">
        @include('employees.sidebar')

        <main class="content-area">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center page-header">
                    <div class="d-flex align-items-center">
                        <a href="{{ route('employees.index') }}"
                            class="btn btn-light border btn-sm me-3 px-3 rounded-pill shadow-sm">
                            <i class="fas fa-arrow-left me-2"></i>ড্যাশবোর্ড (Back)
                        </a>
                        <div>
                            <h1 class="h3 mb-0 text-gray-800">User Management</h1>
                            <p class="text-muted mb-0">Manage permissions and account approvals.</p>
                        </div>
                    </div>
                    <button class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-download me-1"></i> Export Report
                    </button>
                </div>

                <div class="card main-card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th class="ps-4">নাম (Name)</th>
                                        <th>স্ট্যাটাস (Status)</th>
                                        <th>বর্তমান রোল (Role)</th>
                                        <th class="text-end pe-4">অ্যাকশন (Action)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm me-3 bg-light rounded-circle d-flex align-items-center justify-content-center"
                                                        style="width: 40px; height: 40px;">
                                                        <span
                                                            class="text-primary fw-bold">{{ substr($user->name, 0, 1) }}</span>
                                                    </div>
                                                    <span class="fw-semibold text-dark">{{ $user->name }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($user->is_approved)
                                                    <span class="badge bg-success-soft">
                                                        <i class="fas fa-check-circle me-1"></i> Approved
                                                    </span>
                                                @else
                                                    <span class="badge bg-warning-soft">
                                                        <i class="fas fa-clock me-1"></i> Pending
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.users.role', $user->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <select name="role" onchange="this.form.submit()"
                                                        class="form-select form-select-sm w-auto">
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->name }}"
                                                                {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                                {{ ucfirst($role->name) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </form>
                                            </td>
                                            <td class="text-end pe-4">
                                                @if (!$user->is_approved)
                                                    <form action="{{ route('admin.users.approve', $user->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-sm btn-primary btn-approve px-3">
                                                            Approve Now
                                                        </button>
                                                    </form>
                                                @else
                                                    <button class="btn btn-sm btn-light text-muted" disabled>
                                                        No Actions
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
