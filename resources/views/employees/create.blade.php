<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <title>নতুন কর্মচারী যোগ করুন | মন্ত্রিপরিষদ বিভাগ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .main-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .card-header-custom {
            background: linear-gradient(45deg, #198754, #20c997);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 20px;
        }

        .form-section-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #198754;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e9ecef;
            display: flex;
            align-items: center;
        }

        .form-section-title i {
            margin-right: 10px;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            font-size: 0.9rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #198754;
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.1);
        }

        .photo-preview-container {
            width: 120px;
            height: 120px;
            border: 3px dashed #dee2e6;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: #f8f9fa;
        }

        #photoPreview {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .btn-save {
            padding: 10px 30px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(25, 135, 84, 0.3);
        }
    </style>
</head>

<body>

    @include('employees.head_navbar')

    <div class="container-fluid">
        <div class="row">

            @include('employees.sidebar')

            <main class="col-md-9 col-lg-10 p-4">

                <div class="card main-card">
                    <div class="card-header-custom">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 text-center w-100 fw-bold">নতুন কর্মকর্তা/কর্মচারী নিবন্ধন ফরম</h5>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="mb-4">
                            <a href="{{ route('employees.index') }}" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> তালিকা ফিরে যান
                            </a>
                        </div>

                        <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <h6 class="form-section-title"><i class="bi bi-person-bounding-box"></i> ব্যক্তিগত তথ্য</h6>

                            <div class="row mb-4">
                                <div class="col-md-8">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">কর্মচারীর আইডি</label>
                                            <input type="text" class="form-control bg-light" value="Auto Generated"
                                                readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">জন্ম তারিখ <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" name="birth_date" class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">নাম (বাংলা) <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="name_bn" class="form-control"
                                                placeholder="বাংলায় নাম লিখুন" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">নাম (ইংরেজি) <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="name_en" class="form-control"
                                                placeholder="Full Name in English" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 d-flex flex-column align-items-center justify-content-center">
                                    <div class="photo-preview-container mb-2">
                                        <img id="photoPreview" src="" class="d-none">
                                        <i id="placeholderIcon" class="bi bi-camera text-muted fs-1"></i>
                                    </div>
                                    <label class="btn btn-sm btn-outline-primary shadow-sm">
                                        ছবি আপলোড করুন
                                        <input type="file" name="photo" class="d-none" accept="image/*"
                                            onchange="previewPhoto(event)">
                                    </label>
                                </div>
                            </div>

                            <h6 class="form-section-title mt-4"><i class="bi bi-geo-alt"></i> ঠিকানার বিস্তারিত</h6>

                            <div class="row mb-4 g-3">
                                <div class="col-md-6">
                                    <div class="card p-3 border-light shadow-sm">
                                        <label class="form-label">বর্তমান ঠিকানা (বাংলা)</label>
                                        <textarea name="present_address_bn" rows="2" class="form-control mb-2" placeholder="গ্রাম, রাস্তা, ডাকঘর..."></textarea>

                                        <label class="form-label">জেলা</label>
                                        <select name="district_id" class="form-select" required>
                                            <option value="">-- জেলা নির্বাচন করুন --</option>
                                            @foreach (\App\Models\District::orderBy('district_name_bn')->get() as $district)
                                                <option value="{{ $district->id }}">{{ $district->district_name_bn }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card p-3 border-light shadow-sm">
                                        <label class="form-label">স্থায়ী ঠিকানা (বাংলা)</label>
                                        <textarea name="permanent_address_bn" rows="2" class="form-control mb-2" placeholder="গ্রাম, রাস্তা, ডাকঘর..."></textarea>

                                        <label class="form-label">জেলা</label>
                                        <select name="district_id" class="form-select" required>
                                            <option value="">-- জেলা নির্বাচন করুন --</option>
                                            @foreach (\App\Models\District::orderBy('district_name_bn')->get() as $district)
                                                <option value="{{ $district->id }}">{{ $district->district_name_bn }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <h6 class="form-section-title mt-4"><i class="bi bi-briefcase"></i> দাপ্তরিক তথ্য</h6>

                            <div class="row mb-4 g-3">
                                <div class="col-md-4">
                                    <label class="form-label">পদবি</label>
                                    <select name="stuff_designation_id" class="form-select">
                                        <option value="">পদবি নির্বাচন করুন</option>
                                        @foreach (\App\Models\StuffDesignation::orderBy('designation_name_bn')->get() as $designation)
                                            <option value="{{ $designation->id }}">
                                                {{ $designation->designation_name_bn }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">কর্মরত শাখা</label>
                                    <select name="section_id" class="form-select">
                                        <option value="">-- শাখা নির্বাচন করুন --</option>
                                        @foreach (\App\Models\Section::orderBy('section_name_bn')->get() as $section)
                                            <option value="{{ $section->id }}">{{ $section->section_name_bn }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">দপ্তরে যোগদানের তারিখ</label>
                                    <input type="date" name="office_start_date" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">মূল চাকরিতে যোগদানের তারিখ</label>
                                    <input type="date" name="joining_date" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">স্থায়ীকরণের তারিখ</label>
                                    <input type="date" name="confirmation_date" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">স্ক্যানকৃত সার্ভিসবুক (PDF/Image)</label>
                                    <input type="file" name="service_book" class="form-control">
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="d-flex justify-content-between">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary px-4">
                                    <i class="bi bi-arrow-left-short"></i> বাতিল করুন
                                </a>
                                <button type="submit" class="btn btn-success btn-save">
                                    <i class="bi bi-check-circle me-1"></i> তথ্য সংরক্ষণ করুন
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
            const icon = document.getElementById('placeholderIcon');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                    icon.classList.add('d-none');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</body>

</html>
