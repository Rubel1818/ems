<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <title>কর্মচারী তথ্য হালনাগাদ | HR Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #4f46e5;
            --secondary-color: #64748b;
        }

        body {
            background-color: #f1f5f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .main-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }

        .card-header-custom {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            padding: 20px;
            border: none;
        }

        .form-section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 20px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e2e8f0;
            display: flex;
            align-items: center;
        }

        .form-section-title i {
            margin-right: 10px;
        }

        .form-label {
            font-weight: 500;
            color: #334155;
            margin-bottom: 5px;
            font-size: 0.9rem;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            padding: 10px 12px;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .photo-upload-wrapper {
            position: relative;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 3px solid #e2e8f0;
            overflow: hidden;
            background: #f8fafc;
            margin: 0 auto;
        }

        #photoPreview {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .update-btn {
            background: var(--primary-color);
            border: none;
            padding: 12px 35px;
            border-radius: 8px;
            font-weight: 600;
            transition: 0.3s;
        }

        .update-btn:hover {
            background: #4338ca;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(79, 70, 229, 0.3);
        }

        .back-link {
            color: var(--secondary-color);
            font-weight: 500;
            transition: 0.2s;
        }

        .back-link:hover {
            color: var(--primary-color);
        }
    </style>
</head>

<body>

    @include('employees.head_navbar')

    <div class="container-fluid">
        <div class="row">

            @include('employees.sidebar')

            <main class="col-md-9 col-lg-10 p-4">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('employees.index') }}"
                                    class="back-link text-decoration-none">কর্মচারী তালিকা</a></li>
                            <li class="breadcrumb-item active">হালনাগাদ</li>
                        </ol>
                    </nav>
                    <a href="{{ route('employees.index') }}" class="back-link text-decoration-none">
                        <i class="bi bi-arrow-left"></i> ফিরে যান
                    </a>
                </div>

                <div class="card main-card shadow-lg">
                    <div class="card-header-custom text-center">
                        <h4 class="mb-0 fw-bold"><i class="bi bi-person-check-fill me-2"></i> কর্মচারী তথ্য হালনাগাদ
                            করুন</h4>
                    </div>

                    <div class="card-body p-4 p-lg-5">
                        <form action="{{ route('employees.update', $employee->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-section-title">
                                <i class="bi bi-person-circle"></i> ব্যক্তিগত প্রোফাইল
                            </div>

                            <div class="row g-4 mb-5 align-items-center">
                                <div class="col-md-3 text-center">
                                    <div class="photo-upload-wrapper shadow-sm mb-2">
                                        <img id="photoPreview"
                                            src="{{ $employee->photo ? asset('storage/' . $employee->photo) : asset('images/default-avatar.png') }}"
                                            alt="Profile">
                                    </div>
                                    <label for="photoInput" class="btn btn-sm btn-outline-primary rounded-pill">
                                        <i class="bi bi-camera me-1"></i> ছবি পরিবর্তন
                                    </label>
                                    <input type="file" name="photo" id="photoInput" class="d-none" accept="image/*"
                                        onchange="previewPhoto(event)">
                                </div>

                                <div class="col-md-9">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">কর্মচারীর আইডি <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light"><i
                                                        class="bi bi-hash"></i></span>
                                                <input type="text" name="employee_id"
                                                    value="{{ old('employee_id', $employee->employee_id) }}"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">জন্ম তারিখ <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light"><i
                                                        class="bi bi-calendar-event"></i></span>
                                                <input type="date" name="birth_date" class="form-control"
                                                    value="{{ old('birth_date', optional($employee->birth_date)->format('Y-m-d')) }}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">নাম (বাংলা) <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="name_bn"
                                                value="{{ old('name_bn', $employee->name_bn) }}" class="form-control"
                                                required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">নাম (ইংরেজি) <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="name_en"
                                                value="{{ old('name_en', $employee->name_en) }}" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-section-title">
                                <i class="bi bi-geo-alt"></i> ঠিকানা ও অবস্থান
                            </div>

                            @php
                                use App\Models\District;
                                $districts = District::orderBy('district_name_bn')->get();
                            @endphp

                            <div class="row g-4 mb-5">
                                <div class="col-md-8">
                                    <label class="form-label">বর্তমান ঠিকানা (বাংলা)</label>
                                    <textarea name="present_address_bn" rows="1" class="form-control" placeholder="গ্রাম, রাস্তা, পোস্ট কোড...">{{ old('present_address_bn', $employee->present_address_bn) }}</textarea>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">নিজ জেলা <span class="text-danger">*</span></label>
                                    <select name="district_id" class="form-select" required>
                                        <option value="">-- নির্বাচন করুন --</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->id }}"
                                                {{ old('district_id', $employee->district_id) == $district->id ? 'selected' : '' }}>
                                                {{ $district->district_name_bn }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-section-title">
                                <i class="bi bi-briefcase"></i> দাপ্তরিক তথ্য
                            </div>

                            @php
                                use App\Models\StuffDesignation;
                                use App\Models\Section;
                                $designations = StuffDesignation::orderBy('designation_name_bn')->get();
                                $sections = Section::orderBy('section_name_bn')->get();
                            @endphp

                            <div class="row g-4 mb-5">
                                <div class="col-md-6">
                                    <label class="form-label">পদবি <span class="text-danger">*</span></label>
                                    <select name="stuff_designation_id" class="form-select" required>
                                        <option value="">পদবি নির্বাচন করুন</option>
                                        @foreach ($designations as $designation)
                                            <option value="{{ $designation->id }}"
                                                {{ old('stuff_designation_id', $employee->stuff_designation_id) == $designation->id ? 'selected' : '' }}>
                                                {{ $designation->designation_name_bn }}
                                                ({{ $designation->designation_name_en }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">কর্মরত শাখা</label>
                                    <select name="section_id" class="form-select">
                                        <option value="">-- শাখা নির্বাচন করুন --</option>
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}"
                                                {{ old('section_id', $employee->section_id) == $section->id ? 'selected' : '' }}>
                                                {{ $section->section_name_bn }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">যোগদানের তারিখ</label>
                                    <input type="date" name="joining_date"
                                        value="{{ old('joining_date', $employee->joining_date) }}"
                                        class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">স্থায়ীকরণের তারিখ</label>
                                    <input type="date" name="confirmation_date"
                                        value="{{ old('confirmation_date', $employee->confirmation_date) }}"
                                        class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">দপ্তরের মেয়াদকাল (শুরু)</label>
                                    <input type="date" name="office_start_date"
                                        value="{{ old('office_start_date', $employee->office_start_date) }}"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="form-section-title">
                                <i class="bi bi-file-earmark-pdf"></i> নথিপত্র (Documents)
                            </div>



                            <div class="row mb-5">
                                <div class="col-md-12">
                                    <div class="p-4 border border-dashed rounded-3 bg-light text-center">
                                        <label class="form-label d-block fw-bold">স্ক্যানকৃত সার্ভিসবুক আপলোড
                                            করুন</label>

                                        @if ($employee->service_book)
                                            <div class="mb-3">
                                                <div
                                                    class="d-inline-flex align-items-center p-2 border rounded bg-white shadow-sm">
                                                    <i class="bi bi-file-earmark-check text-success fs-4 me-2"></i>
                                                    <div class="text-start">
                                                        <small class="text-muted d-block">বর্তমান ফাইল:</small>
                                                        <a href="{{ asset('storage/' . $employee->service_book) }}"
                                                            target="_blank"
                                                            class="text-decoration-none fw-bold text-success">
                                                            ভিউ করুন (View Existing File)
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <input type="file" name="service_book" class="form-control w-50 mx-auto">

                                        <small class="text-muted mt-2 d-block">
                                            ফাইল ফরম্যাট: PDF, JPG (সর্বোচ্চ ৫ মেগাবাইট) <br>
                                            <span class="text-info">(নতুন ফাইল আপলোড করলে আগেরটি পরিবর্তন হয়ে
                                                যাবে)</span>
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary update-btn shadow">
                                    <i class="bi bi-save me-2"></i> তথ্য হালনাগাদ করুন
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
            const preview = document.getElementById('photoPreview');
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
            };
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>

</body>

</html>
