<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <title>কর্মচারী তথ্য হালনাগাদ করুন</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <div class="card-header bg-warning">
                <h5 class="mb-0 text-dark">কর্মচারী তথ্য হালনাগাদ করুন</h5>
            </div>

            <div class="card-body">

                <!-- Back button -->
                <div class="mb-4">
                    <a href="{{ route('employees.index') }}" class="text-decoration-none">
                        ← কর্মচারী তালিকায় ফিরে যান
                    </a>
                </div>

                <!-- Edit Form -->
                <form action="{{ route('employees.update', $employee->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Employee ID & Photo -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">কর্মচারীর আইডি</label>
                            <input type="text" name="employee_id"
                                value="{{ old('employee_id', $employee->employee_id) }}" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">ছবি</label>
                            <input type="file" name="photo" class="form-control">

                            @if ($employee->photo)
                                <img src="{{ asset('storage/' . $employee->photo) }}" class="img-thumbnail mt-2"
                                    style="height: 90px;">
                            @endif
                        </div>
                    </div>

                    <!-- Name -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">নাম (বাংলা)</label>
                            <input type="text" name="name_bn" value="{{ old('name_bn', $employee->name_bn) }}"
                                class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">নাম (ইংরেজি)</label>
                            <input type="text" name="name_en" value="{{ old('name_en', $employee->name_en) }}"
                                class="form-control">
                        </div>
                    </div>

                    <!-- Designation -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">পদবি (বাংলা)</label>
                            <input type="text" name="designation_bn"
                                value="{{ old('designation_bn', $employee->designation_bn) }}" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">পদবি (ইংরেজি)</label>
                            <input type="text" name="designation_en"
                                value="{{ old('designation_en', $employee->designation_en) }}" class="form-control">
                        </div>
                    </div>

                    <!-- Present Address -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">বর্তমান ঠিকানা (বাংলা)</label>
                            <textarea name="present_address_bn" rows="2" class="form-control">{{ old('present_address_bn', $employee->present_address_bn) }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">বর্তমান ঠিকানা (ইংরেজি)</label>
                            <textarea name="present_address_en" rows="2" class="form-control">{{ old('present_address_en', $employee->present_address_en) }}</textarea>
                        </div>
                    </div>

                    <!-- Permanent Address -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">স্থায়ী ঠিকানা (বাংলা)</label>
                            <textarea name="permanent_address_bn" rows="2" class="form-control">{{ old('permanent_address_bn', $employee->permanent_address_bn) }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">স্থায়ী ঠিকানা (ইংরেজি)</label>
                            <textarea name="permanent_address_en" rows="2" class="form-control">{{ old('permanent_address_en', $employee->permanent_address_en) }}</textarea>
                        </div>
                    </div>

                    <!-- Office -->
                    <div class="mb-3">
                        <label class="form-label">
                            কর্মরত দপ্তর / অনুবিভাগ / অধিশাখা / শাখা / সেলের নাম
                        </label>
                        <input type="text" name="office_name"
                            value="{{ old('office_name', $employee->office_name) }}" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">কর্মরত দপ্তরের মেয়াদকাল</label>
                        <input type="text" name="office_duration"
                            value="{{ old('office_duration', $employee->office_duration) }}" class="form-control">
                    </div>

                    <!-- Dates -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">চাকরিতে যোগদানের তারিখ</label>
                            <input type="date" name="joining_date"
                                value="{{ old('joining_date', $employee->joining_date) }}" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">চাকরি স্থায়ীকরণের তারিখ</label>
                            <input type="date" name="confirmation_date"
                                value="{{ old('confirmation_date', $employee->confirmation_date) }}"
                                class="form-control">
                        </div>
                    </div>

                    <!-- Service Book -->
                    <div class="mb-4">
                        <label class="form-label">স্ক্যানকৃত সার্ভিসবুক</label>
                        <input type="file" name="service_book" class="form-control">
                    </div>

                    <!-- Submit -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4">
                            আপডেট করুন
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
