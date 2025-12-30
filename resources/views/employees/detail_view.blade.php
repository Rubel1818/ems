<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <title>কর্মচারীর প্রোফাইল</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
        }

        /* Sidebar */
        .sidebar {
            min-height: 100vh;
            background-color: #0d6efd;
        }

        .sidebar a {
            color: #fff;
            padding: 10px;
            display: block;
            text-decoration: none;
            border-radius: 6px;
        }

        .sidebar a:hover,
        .sidebar .active {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Profile */
        .profile-card {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            padding: 30px;
        }

        .profile-img {
            height: 150px;
            width: 150px;
            object-fit: cover;
        }

        .profile-label {
            font-weight: 600;
            color: #495057;
        }

        .profile-value {
            color: #212529;
        }

        h6.section-title {
            border-left: 4px solid #0d6efd;
            padding-left: 8px;
            margin-top: 30px;
            margin-bottom: 15px;
            font-weight: 600;
            color: #0d6efd;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Dashboard</a>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#">Profile</a></li>
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

    <div class="container-fluid">
        <div class="row">

            <!-- ✅ SIDEBAR (FIXED) -->
            <aside class="col-md-2 sidebar p-3">
                <h6 class="text-white text-center mb-4">মেনু</h6>

                <a href="{{ route('employees.index') }}">
                    <i class="bi bi-people"></i> কর্মচারী তালিকা
                </a>

                <a href="{{ route('employees.create') }}">
                    <i class="bi bi-person-plus"></i> নতুন কর্মচারী
                </a>

                <a href="#" class="active">
                    <i class="bi bi-person-circle"></i> প্রোফাইল
                </a>
            </aside>

            <!-- ✅ MAIN CONTENT -->
            <main class="col-md-10 p-4">
                <div class="profile-card">

                    <!-- Photo -->
                    <div class="text-center mb-4">
                        <img src="{{ $employee->photo ? asset('storage/' . $employee->photo) : 'https://via.placeholder.com/150' }}"
                            class="rounded-circle profile-img" alt="Employee Photo">
                    </div>


                    <!-- Personal Info -->
                    <h6 class="section-title">ব্যক্তিগত তথ্য</h6>
                    <div class="row mb-2">
                        <div class="col-5 profile-label">কর্মচারীর আইডি</div>
                        <div class="col-7 profile-value">{{ $employee->employee_id }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 profile-label">নাম (বাংলা)</div>
                        <div class="col-7 profile-value">{{ $employee->name_bn }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 profile-label">নাম (ইংরেজি)</div>
                        <div class="col-7 profile-value">{{ $employee->name_en }}</div>
                    </div>

                    <!-- Address -->
                    <h6 class="section-title">ঠিকানা</h6>
                    <div class="row mb-2">
                        <div class="col-5 profile-label">বর্তমান ঠিকানা</div>
                        <div class="col-7 profile-value">{{ $employee->present_address_bn }}</div>
                    </div>
                    <h6 class="section-title">ঠিকানা</h6>
                    <div class="row mb-2">
                        <div class="col-5 profile-label">স্থায়ী ঠিকানা</div>
                        <div class="col-7 profile-value">{{ $employee->permanent_address_bn }}</div>
                    </div>

                    <!-- Office -->
                    <h6 class="section-title">কর্মক্ষেত্র</h6>
                    <div class="row mb-2">
                        <div class="col-5 profile-label">পদবি</div>
                        <div class="col-7 profile-value">{{ $employee->designation_bn }}</div>
                    </div>
                    <!-- Dates -->

                    <div class="row mb-2">

                        <div class="col-5 profile-label">চাকরিতে যোগদানের তারিখ</div>
                        <div class="col-7 profile-value">{{ $employee->joining_date }}</div>


                        <div class="col-5 profile-label">চাকরিতে স্থায়ীকরণের তারিখ</div>
                        <div class="col-7 profile-value">{{ $employee->confirmation_date }}</div>



                    </div>
                    <!-- File -->
                    <h6 class="section-title">ফাইল</h6>
                    <a href="{{ $employee->service_book }}" class="btn btn-outline-primary btn-sm" target="_blank">
                        View / Download
                    </a>

                </div>
            </main>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
