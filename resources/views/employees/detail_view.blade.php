<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <title>{{ $employee->name_bn }} - প্রোফাইল</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .profile-container {
            background: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: none;
        }

        .profile-header-bg {
            background: linear-gradient(135deg, #0d6efd 0%, #004085 100%);
            height: 120px;
        }

        .profile-main-info {
            margin-top: -70px;
            padding: 0 30px 30px;
        }

        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 5px solid #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .section-card {
            border: 1px solid #eef0f2;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #fdfdfd;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #0d6efd;
            margin-bottom: 15px;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 8px;
            display: flex;
            align-items: center;
        }

        .section-title i {
            margin-right: 10px;
        }

        .info-label {
            color: #6c757d;
            font-weight: 600;
            font-size: 0.9rem;
            width: 40%;
        }

        .info-value {
            color: #212529;
            font-weight: 500;
        }

        .table-custom tr {
            border-bottom: 1px solid #f1f1f1;
        }

        .table-custom tr:last-child {
            border-bottom: none;
        }

        .table-custom td {
            padding: 10px 5px;
            border: none;
        }

        .btn-download {
            border-radius: 50px;
            padding: 8px 20px;
            font-weight: 600;
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
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm shadow-sm">
                        <i class="bi bi-arrow-left"></i> ফিরে যান
                    </a>
                    <a href="{{ route('employees.download-pdf', $employee->id) }}"
                        class="btn btn-danger btn-download shadow-sm">
                        <i class="bi bi-file-pdf"></i> PDF ডাউনলোড করুন
                    </a>
                </div>

                <div class="profile-container">
                    <div class="profile-header-bg"></div>

                    <div class="profile-main-info">
                        <div class="row align-items-end">
                            <div class="col-md-auto text-center text-md-start">
                                <img src="{{ $employee->photo ? asset('storage/' . $employee->photo) : asset('images/user.png') }}"
                                    class="rounded-circle profile-img mb-3" alt="Photo">
                            </div>
                            <div class="col-md mt-3 mt-md-0 text-center text-md-start">
                                <h2 class="fw-bold mb-1">{{ $employee->name_bn }}</h2>
                                <p class="text-muted mb-2 fs-5">
                                    {{ optional($employee->stuffDesignation)->designation_name_bn }}</p>
                                <span class="badge bg-primary px-3 py-2">ID: {{ $employee->employee_id }}</span>
                            </div>
                        </div>

                        <hr class="my-5">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="section-card">
                                    <h6 class="section-title"><i class="bi bi-person-badge"></i> ব্যক্তিগত তথ্য</h6>
                                    <table class="table table-custom mb-0">
                                        <tr>
                                            <td class="info-label">নাম (ইংরেজি)</td>
                                            <td class="info-value">{{ $employee->name_en }}</td>
                                        </tr>
                                        <tr>
                                            <td class="info-label">জন্ম তারিখ</td>
                                            <td class="info-value">{{ $employee->birth_date }}</td>
                                        </tr>
                                        <tr>
                                            <td class="info-label">বর্তমান ঠিকানা</td>
                                            <td class="info-value">{{ $employee->present_address_bn }}</td>
                                        </tr>
                                        <tr>
                                            <td class="info-label">জেলা</td>
                                            <td class="info-value">
                                                {{ optional($employee->district)->district_name_bn }}</td>
                                        </tr>
                                        <tr>
                                            <td class="info-label">স্থায়ী ঠিকানা</td>
                                            <td class="info-value">{{ $employee->permanent_address_bn }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="section-card shadow-sm" style="border-left: 4px solid #0d6efd;">
                                    <h6 class="section-title"><i class="bi bi-building"></i> অফিস সংক্রান্ত তথ্য</h6>
                                    <table class="table table-custom mb-0">
                                        <tr>
                                            <td class="info-label">শাখা</td>
                                            <td class="info-value text-primary fw-bold">
                                                {{ optional($employee->section)->section_name_bn }}</td>
                                        </tr>
                                        <tr>
                                            <td class="info-label">দপ্তরে যোগদান</td>
                                            <td class="info-value">{{ $employee->office_start_date }}</td>
                                        </tr>
                                        <tr>
                                            <td class="info-label">চাকরি যোগদানের তারিখ</td>
                                            <td class="info-value">{{ $employee->joining_date }}</td>
                                        </tr>
                                        <tr>
                                            <td class="info-label">স্থায়ীকরণের তারিখ</td>
                                            <td class="info-value">{{ $employee->confirmation_date }}</td>
                                        </tr>
                                        <tr>
                                            <td class="info-label">PRL তারিখ</td>
                                            <td class="info-value text-danger">{{ $employee->prl_date }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="section-card mt-4">
                                    <h6 class="section-title"><i class="bi bi-file-earmark-text"></i> প্রয়োজনীয়
                                        ডকুমেন্ট</h6>
                                    <div class="d-grid">
                                        @if ($employee->service_book)
                                            <a href="{{ asset('storage/' . $employee->service_book) }}" target="_blank"
                                                class="btn btn-outline-primary">
                                                <i class="bi bi-file-earmark-pdf-fill"></i> সার্ভিস বুক ডাউনলোড করুন
                                            </a>
                                        @else
                                            <div class="alert alert-light border text-center text-muted mb-0">
                                                কোনো ফাইল আপলোড করা নেই
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
