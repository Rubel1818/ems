<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>নতুন কর্মচারী যোগ করুন</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<!-- 🔹 Navbar (Breeze user + logout) -->
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
                        <button class="btn btn-link nav-link text-white" type="submit">
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
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">নতুন কর্মচারী যোগ করুন</h5>
        </div>

        <div class="card-body">

            <div class="mb-4">
                <a href="{{ route('employees.index') }}" class="text-decoration-none">
                    ← কর্মচারী তালিকায় ফিরে যান
                </a>
            </div>

            <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Employee ID & Photo -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">কর্মচারীর আইডি</label>
                        <input type="text" name="employee_id" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">ছবি</label>
                        <input type="file" name="photo" class="form-control">
                    </div>
                </div>

                <!-- Name -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">নাম (বাংলা)</label>
                        <input type="text" name="name_bn" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">নাম (ইংরেজি)</label>
                        <input type="text" name="name_en" class="form-control">
                    </div>
                </div>

                <!-- Designation -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">পদবি (বাংলা)</label>
                        <input type="text" name="designation_bn" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">পদবি (ইংরেজি)</label>
                        <input type="text" name="designation_en" class="form-control">
                    </div>
                </div>

                <!-- Present Address -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">বর্তমান ঠিকানা (বাংলা)</label>
                        <textarea name="present_address_bn" rows="2" class="form-control"></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">বর্তমান ঠিকানা (ইংরেজি)</label>
                        <textarea name="present_address_en" rows="2" class="form-control"></textarea>
                    </div>
                </div>

                <!-- Permanent Address -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">স্থায়ী ঠিকানা (বাংলা)</label>
                        <textarea name="permanent_address_bn" rows="2" class="form-control"></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">স্থায়ী ঠিকানা (ইংরেজি)</label>
                        <textarea name="permanent_address_en" rows="2" class="form-control"></textarea>
                    </div>
                </div>

                <!-- Office -->
                <div class="mb-3">
                    <label class="form-label">কর্মরত দপ্তর / শাখা</label>
                    <input type="text" name="office_name" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">দপ্তরের মেয়াদকাল</label>
                    <input type="text" name="office_duration" placeholder="২০২০ - বর্তমান" class="form-control">
                </div>

                <!-- Dates -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">যোগদানের তারিখ</label>
                        <input type="date" name="joining_date" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">স্থায়ীকরণের তারিখ</label>
                        <input type="date" name="confirmation_date" class="form-control">
                    </div>
                </div>

                <!-- Service Book -->
                <div class="mb-4">
                    <label class="form-label">স্ক্যানকৃত সার্ভিসবুক</label>
                    <input type="file" name="service_book" class="form-control">
                </div>

                <!-- Submit -->
                <div class="text-end">
                    <button type="submit" class="btn btn-success px-4">
                        সংরক্ষণ করুন
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
