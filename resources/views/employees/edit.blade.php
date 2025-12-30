<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <title>কর্মচারী তথ্য হালনাগাদ করুন</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
        }

        .sidebar {
            min-height: calc(100vh - 56px);
            background: #0d6efd;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
        }

        .sidebar a:hover,
        .sidebar .active {
            background: rgba(255, 255, 255, 0.15);
        }
    </style>
</head>

<body>

    <!-- 🔹 Header (UNCHANGED) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Dashboard</a>

            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.edit') }}">Profile</a>
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

    <div class="container-fluid">
        <div class="row">

            <!-- 🔹 Sidebar -->
            <nav class="col-md-3 col-lg-2 sidebar p-3">
                <h6 class="text-white text-center mb-4">মেনু</h6>

                <ul class="nav flex-column gap-2">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2 me-2"></i> ড্যাশবোর্ড
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white active" href="{{ route('employees.index') }}">
                            <i class="bi bi-people me-2"></i> কর্মচারী তালিকা
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('profile.edit') }}">
                            <i class="bi bi-person me-2"></i> প্রোফাইল
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- 🔹 Main Content -->
            <main class="col-md-9 col-lg-10 p-4">

                <div class="card shadow">
                    <div class="card-header bg-warning">
                        <h5 class="mb-0 text-dark">কর্মচারী তথ্য হালনাগাদ করুন</h5>
                    </div>

                    <div class="card-body">

                        <div class="mb-4">
                            <a href="{{ route('employees.index') }}" class="text-decoration-none">
                                ← কর্মচারী তালিকায় ফিরে যান
                            </a>
                        </div>

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

                                    <input type="file" name="photo" class="form-control" accept="image/*"
                                        onchange="previewPhoto(event)">

                                    <!-- Existing image OR preview -->
                                    <img id="photoPreview"
                                        src="{{ $employee->photo ? asset('storage/' . $employee->photo) : '' }}"
                                        class="img-thumbnail mt-2 {{ $employee->photo ? '' : 'd-none' }}"
                                        style="height: 50px;" alt="Photo Preview">
                                </div>

                            </div>

                            <!-- Name -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">নাম (বাংলা)</label>
                                    <input type="text" name="name_bn"
                                        value="{{ old('name_bn', $employee->name_bn) }}" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">নাম (ইংরেজি)</label>
                                    <input type="text" name="name_en"
                                        value="{{ old('name_en', $employee->name_en) }}" class="form-control">
                                </div>
                            </div>

                            <!-- Designation -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">পদবি (বাংলা)</label>
                                    <input type="text" name="designation_bn"
                                        value="{{ old('designation_bn', $employee->designation_bn) }}"
                                        class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">পদবি (ইংরেজি)</label>
                                    <input type="text" name="designation_en"
                                        value="{{ old('designation_en', $employee->designation_en) }}"
                                        class="form-control">
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
                                    value="{{ old('office_duration', $employee->office_duration) }}"
                                    class="form-control">
                            </div>

                            <!-- Dates -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">চাকরিতে যোগদানের তারিখ</label>
                                    <input type="date" name="joining_date"
                                        value="{{ old('joining_date', $employee->joining_date) }}"
                                        class="form-control">
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

            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- 🔹 Photo Preview Script -->
    <script>
        function previewPhoto(event) {
            const preview = document.getElementById('photoPreview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            }
        }
    </script>

    <script>
        function previewPhoto(event) {
            const input = event.target;
            const preview = document.getElementById('photoPreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>


</body>

</html>
