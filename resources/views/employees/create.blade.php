<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <title>নতুন কর্মচারী যোগ করুন</title>
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

            <!-- 🔹 Main Content (FORM UNCHANGED) -->
            <main class="col-md-9 col-lg-10 p-4">

                <div class="">
                    <div class="card-header bg-primary text-white text-center">
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

                                <div class="col-md-3">
                                    <label class="form-label">ছবি</label>
                                    <input type="file" name="photo" class="form-control" accept="image/*"
                                        onchange="previewPhoto(event)">
                                </div>
                                <div class="col-md-3 text-center">
                                    <img id="photoPreview" src="" class="img-thumbnail mt-2 d-none"
                                        style="max-height: 50px;" alt="Photo Preview">
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
                            <div class="col-md-6">
                                <label class="form-label">পদবি</label>
                                <select name="designation_bn" class="form-select" required>
                                    <option value="">-- পদবি নির্বাচন করুন --</option>

                                    <!-- ৩য় ও ৪র্থ শ্রেণি (নিম্ন গ্রেড) -->
                                    <option value="উচ্চমান সহকারী">উচ্চমান সহকারী</option>
                                    <option value="নিম্নমান সহকারী">নিম্নমান সহকারী</option>
                                    <option value="অফিস সহকারী">অফিস সহকারী</option>
                                    <option value="অফিস সহকারী কাম কম্পিউটার মুদ্রাক্ষরিক">
                                        অফিস সহকারী কাম কম্পিউটার মুদ্রাক্ষরিক
                                    </option>
                                    <option value="কম্পিউটার অপারেটর">কম্পিউটার অপারেটর</option>
                                    <option value="ডাটা এন্ট্রি অপারেটর">ডাটা এন্ট্রি অপারেটর</option>
                                    <option value="মুদ্রাক্ষরিক">মুদ্রাক্ষরিক</option>

                                    <!-- সহায়ক কর্মচারী -->
                                    <option value="রেকর্ড কিপার">রেকর্ড কিপার</option>
                                    <option value="অভ্যর্থনা সহকারী">অভ্যর্থনা সহকারী</option>
                                    <option value="টেলিফোন অপারেটর">টেলিফোন অপারেটর</option>
                                    <option value="অফিস সহায়ক কর্মচারী">অফিস সহায়ক কর্মচারী</option>

                                    <!-- কারিগরি / সহায়ক -->
                                    <option value="ইলেকট্রিশিয়ান">ইলেকট্রিশিয়ান</option>
                                    <option value="প্লাম্বার">প্লাম্বার</option>
                                    <option value="মেকানিক">মেকানিক</option>

                                    <!-- ৪র্থ শ্রেণি -->
                                    <option value="চালক">চালক</option>
                                    <option value="এমএলএসএস">এমএলএসএস</option>
                                    <option value="পিয়ন">পিয়ন</option>
                                    <option value="পরিচ্ছন্নতাকর্মী">পরিচ্ছন্নতাকর্মী</option>
                                    <option value="নৈশ প্রহরী">নৈশ প্রহরী</option>
                                    <option value="নিরাপত্তা প্রহরী">নিরাপত্তা প্রহরী</option>
                                </select>
                            </div>



                            <div class="col-md-6">
                                <label class="form-label">Designation (English)</label>
                                <select name="designation_en" class="form-select" required>
                                    <option value="">-- Select Designation --</option>

                                    <!-- 3rd & 4th Class / Lower Grade -->
                                    <option value="Upper Division Assistant (UDA)">Upper Division Assistant (UDA)
                                    </option>
                                    <option value="Lower Division Assistant (LDA)">Lower Division Assistant (LDA)
                                    </option>
                                    <option value="Office Assistant">Office Assistant</option>
                                    <option value="Computer Operator">Computer Operator</option>
                                    <option value="Data Entry Operator">Data Entry Operator</option>
                                    <option value="Typist">Typist</option>

                                    <!-- Support Staff -->
                                    <option value="Record Keeper">Record Keeper</option>
                                    <option value="Receptionist">Receptionist</option>
                                    <option value="Telephone Operator">Telephone Operator</option>
                                    <option value="Office Support Staff">Office Support Staff</option>

                                    <!-- Technical / Utility -->
                                    <option value="Electrician">Electrician</option>
                                    <option value="Plumber">Plumber</option>
                                    <option value="Mechanic">Mechanic</option>

                                    <!-- 4th Class -->
                                    <option value="Driver">Driver</option>
                                    <option value="Office Assistant cum Computer Typist">Office Assistant cum Computer
                                        Typist</option>
                                    <option value="MLSS">MLSS</option>
                                    <option value="Cleaner">Cleaner</option>
                                    <option value="Peon">Peon</option>
                                    <option value="Night Guard">Night Guard</option>
                                    <option value="Security Guard">Security Guard</option>
                                </select>
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
                        <label class="form-label">কর্মরত শাখা</label>
                        <select name="office_name" class="form-select" required>
                            <option value="">-- শাখা নির্বাচন করুন --</option>

                            <option value="প্রশাসন শাখা">প্রশাসন শাখা</option>
                            <option value="আইসিটি শাখা">আইসিটি শাখা</option>
                            <option value="সমন্বয় শাখা">সমন্বয় শাখা</option>
                            <option value="আইন ও বিধি শাখা">আইন ও বিধি শাখা</option>
                            <option value="মন্ত্রিসভা শাখা">মন্ত্রিসভা শাখা</option>
                            <option value="কমিটি ও সভা শাখা">কমিটি ও সভা শাখা</option>
                            <option value="অর্থ ও বাজেট শাখা">অর্থ ও বাজেট শাখা</option>
                            <option value="সংস্থাপন শাখা">সংস্থাপন শাখা</option>
                            <option value="রেকর্ড শাখা">রেকর্ড শাখা</option>
                            <option value="প্রশিক্ষণ শাখা">প্রশিক্ষণ শাখা</option>
                            <option value="অভ্যন্তরীণ নিরীক্ষা শাখা">অভ্যন্তরীণ নিরীক্ষা শাখা</option>

                        </select>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">দপ্তরের মেয়াদকাল (শুরুর তারিখ)</label>
                        <input type="date" name="office_start_date" class="form-control" required>
                        <small class="text-muted">মেয়াদকাল: নির্বাচিত তারিখ থেকে বর্তমান</small>
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

        </main>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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
