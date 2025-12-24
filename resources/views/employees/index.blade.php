<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <title>কর্মচারী তালিকা</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- jQuery (required by DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

</head>

<body class="bg-light">

    <!-- 🔹 Navbar (Breeze compatible) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Dashboard</a>

            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.edit') }}">
                            Profile
                        </a>
                    </li>

                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link text-white">
                                Logout
                            </button>
                        </form>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- 🔹 Page Content -->
    <div class="container my-5">
        <div class="card shadow">

            <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                <h5 class="mb-0">কর্মচারী তালিকা</h5>

                <a href="{{ route('employees.create') }}" class="btn btn-light btn-sm">
                    নতুন যোগ করুন
                </a>
            </div>

            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table id="employeesTable" class="table table-bordered table-striped text-center align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>আইডি</th>
                                <th>নাম (বাংলা)</th>
                                <th>পদবি</th>
                                <th width="180">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($employees as $employee)
                                <tr>
                                    <td>{{ $employee->employee_id }}</td>
                                    <td>{{ $employee->name_bn }}</td>
                                    <td>{{ $employee->designation_bn }}</td>
                                    <td>
                                        <a href="{{ route('employees.edit', $employee->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>

                                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('ডিলিট করবেন?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">কোন তথ্য পাওয়া যায়নি</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script>
    $(document).ready(function() {
        $('#employeesTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "lengthMenu": [5, 10, 25, 50], // Records per page
            "language": {
                "search": "খুঁজুন:",
                "lengthMenu": "প্রতি পাতা _MENU_ টি রেকর্ড দেখাও",
                "info": "দেখানো হচ্ছে _START_ থেকে _END_ পর্যন্ত _TOTAL_ টি রেকর্ড",
                "paginate": {
                    "first": "প্রথম",
                    "last": "শেষ",
                    "next": "পরবর্তী",
                    "previous": "পূর্ববর্তী"
                },
                "zeroRecords": "কোন তথ্য পাওয়া যায়নি"
            },
            "columnDefs": [{
                    "orderable": false,
                    "targets": 3
                } // Disable sorting for Action column
            ]
        });
    });
</script>

</html>
