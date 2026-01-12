<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <title>{{ $employee->name_bn }} - প্রোফাইল</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            /* Emerald to Olive Gradient based on your image */
            --primary-gradient: linear-gradient(90deg, #f3f8f7 0%, #96b07d 60%, #a4a433 100%);
            --emerald-deep: #124e43;
        }

        body {
            background-color: #f1f5f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .profile-container {
            background: #ffffff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: none;
        }

        /* The Header Background Color */
        .profile-header-bg {
            background: var(--primary-gradient);
            height: 180px;
            position: relative;
        }

        /* Positioning the info and picture to be visible */
        .profile-main-info {
            margin-top: -80px;
            padding: 0 40px 40px;
            position: relative;
            z-index: 2;
        }

        /* Profile Image Visibility Styling */
        .profile-img {
            width: 170px;
            height: 170px;
            object-fit: cover;
            border: 8px solid #ffffff;
            /* Thick white border to make it pop */
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            background-color: #fff;
        }

        .section-card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            background-color: #ffffff;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--emerald-deep);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f1f5f9;
            display: flex;
            align-items: center;
        }

        .section-title i {
            margin-right: 12px;
            color: #10b981;
        }

        .info-label {
            color: #64748b;
            font-weight: 600;
            width: 35%;
        }

        .info-value {
            color: #1e293b;
            font-weight: 500;
        }

        /* Duration Badge as requested */
        .badge-duration {
            background-color: #ecfdf5;
            color: #065f46;
            font-weight: 600;
            font-size: 0.85rem;
            border-radius: 8px;
            padding: 6px 14px;
            border: 1px solid #d1fae5;
            display: inline-flex;
            align-items: center;
        }

        .btn-emerald {
            background-color: var(--emerald-deep);
            color: white;
            border: none;
        }

        .btn-emerald:hover {
            background-color: #0b3d35;
            color: white;
        }

        .employee-id-tag {
            background-color: var(--emerald-deep);
            color: #fff;
            padding: 6px 16px;
            border-radius: 6px;
            font-size: 0.9rem;
            display: inline-block;
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
                    <a href="{{ url()->previous() }}" class="btn btn-white border shadow-sm px-3 rounded-3 bg-white">
                        <i class="bi bi-arrow-left me-1"></i> ফিরে যান
                    </a>
                    <a href="{{ route('employees.download-pdf', $employee->id) }}"
                        class="btn btn-danger px-4 rounded-3 shadow-sm">
                        <i class="bi bi-file-pdf me-1"></i> PDF ডাউনলোড করুন
                    </a>
                </div>

                <div class="profile-container">
                    <div class="profile-header-bg"></div>

                    <div class="profile-main-info">
                        <div class="row align-items-end">
                            <div class="col-md-auto text-center text-md-start">
                                <img src="{{ $employee->photo ? asset('storage/' . $employee->photo) : asset('images/user.png') }}"
                                    class="rounded-circle profile-img mb-3" alt="Employee Photo">
                            </div>
                            <div class="col-md mt-3 mt-md-0 text-center text-md-start pb-2">
                                <h1 class="fw-bold mb-1" style="color: #0f172a;">{{ $employee->name_bn }}</h1>
                                <p class="text-secondary mb-2 fs-5">
                                    <i class="bi bi-briefcase-fill me-1 text-muted"></i>
                                    {{ optional($employee->stuffDesignation)->designation_name_bn }}
                                </p>
                                <div class="employee-id-tag shadow-sm">আইডি: {{ $employee->employee_id }}</div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-lg-6">
                                <div class="section-card h-100 shadow-sm">
                                    <h6 class="section-title"><i class="bi bi-person-circle"></i> ব্যক্তিগত তথ্য</h6>
                                    <table class="table table-borderless mb-0">
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
                                <div class="section-card h-100 shadow-sm">
                                    <h6 class="section-title"><i class="bi bi-building-check"></i> অফিস সংক্রান্ত তথ্য
                                    </h6>
                                    <table class="table table-borderless mb-0">
                                        <tr>
                                            <td class="info-label">শাখা</td>
                                            <td class="info-value fw-bold text-success">
                                                {{ optional($employee->section)->section_name_bn }}</td>
                                        </tr>

                                        <tr>
                                            <td class="info-label">চাকরি যোগদান</td>
                                            <td class="info-value">{{ $employee->joining_date }}</td>
                                        </tr>
                                        <tr>
                                            <td class="info-label">স্থায়ীকরণ</td>
                                            <td class="info-value">{{ $employee->confirmation_date }}</td>
                                        </tr>
                                        <tr>
                                            <td class="info-label">PRL তারিখ</td>
                                            <td class="info-value text-danger fw-bold">{{ $employee->prl_date }}</td>
                                        </tr>
                                        <tr>
                                            <td class="info-label">সার্ভিস বুক</td>
                                            <td class="info-value">
                                                @if ($employee->service_book)
                                                    <a href="{{ asset('storage/' . $employee->service_book) }}"
                                                        target="_blank"
                                                        class="btn btn-sm btn-outline-success rounded-pill px-3">
                                                        <i class="bi bi-cloud-arrow-down-fill me-1"></i> ডাউনলোড করুন
                                                    </a>
                                                @else
                                                    <span class="text-muted small">সংযুক্ত নেই</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="col-12 mt-4">
                                <div class="section-card shadow-sm">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h6 class="section-title mb-0 border-0"><i class="bi bi-clock-history"></i>
                                            কর্মকাল হিস্ট্রি</h6>
                                        <button id="toggleHistoryFormBtn"
                                            class="btn btn-emerald btn-sm px-3 rounded-pill">
                                            <i class="bi bi-plus-lg me-1"></i> নতুন তথ্য যোগ করুন
                                        </button>
                                    </div>

                                    <div id="historyTableView" class="table-responsive">
                                        <table class="table table-hover align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>শাখা</th>
                                                    <th>পদবি</th>
                                                    <th>শুরুর তারিখ</th>
                                                    <th>শেষ তারিখ</th>
                                                    <th class="text-success">মোট কর্মকাল</th>
                                                    <th class="text-center">অ্যাকশন</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($histories as $history)
                                                    @php
                                                        $start = \Carbon\Carbon::parse($history->start_date);
                                                        $end = $history->end_date
                                                            ? \Carbon\Carbon::parse($history->end_date)
                                                            : \Carbon\Carbon::now();
                                                        $diff = $start->diff($end);

                                                        $parts = [];
                                                        if ($diff->y > 0) {
                                                            $parts[] = $diff->y . ' বছর';
                                                        }
                                                        if ($diff->m > 0) {
                                                            $parts[] = $diff->m . ' মাস';
                                                        }
                                                        if ($diff->d > 0) {
                                                            $parts[] = $diff->d . ' দিন';
                                                        }
                                                        $duration = count($parts) > 0 ? implode(', ', $parts) : '০ দিন';
                                                    @endphp
                                                    <tr>
                                                        <td class="fw-bold">{{ $history->section->section_name_bn }}
                                                        </td>
                                                        <td>{{ $history->designation->designation_name_bn }}</td>
                                                        <td>{{ $history->start_date }}</td>
                                                        <td>{{ $history->end_date ?? 'বর্তমান' }}</td>
                                                        <td><span
                                                                class="badge-duration shadow-sm">{{ $duration }}</span>
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="btn-group">
                                                                <button
                                                                    class="btn btn-sm btn-outline-warning editHistoryBtn"
                                                                    data-history-id="{{ $history->id }}"><i
                                                                        class="bi bi-pencil"></i></button>
                                                                <form method="POST"
                                                                    action="{{ route('employees.histories.destroy', [$employee->id, $history->id]) }}"
                                                                    class="d-inline">
                                                                    @csrf @method('DELETE')
                                                                    <button class="btn btn-sm btn-outline-danger"
                                                                        onclick="return confirm('নিশ্চিত?')"><i
                                                                            class="bi bi-trash"></i></button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6" class="text-center py-4 text-muted">কোনো তথ্য
                                                            নেই</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                    <div id="historyFormView" style="display:none;">
                                        <div class="p-4 bg-light rounded-3">
                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                <h5 class="fw-bold">নতুন তথ্য যোগ করুন</h5>
                                                <button id="backToTableBtn" class="btn btn-sm btn-secondary">ফিরে
                                                    যান</button>
                                            </div>
                                            <form method="POST"
                                                action="{{ route('employees.histories.store', $employee->id) }}">
                                                @csrf
                                                <div class="row g-3">
                                                    <div class="col-md-4">
                                                        <label class="form-label small fw-bold">শাখা</label>
                                                        <select name="section_id"
                                                            class="form-select border-0 shadow-sm" required>
                                                            <option value="">নির্বাচন করুন</option>
                                                            @foreach ($sections as $section)
                                                                <option value="{{ $section->id }}">
                                                                    {{ $section->section_name_bn }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label small fw-bold">পদবি</label>
                                                        <select name="designation_id"
                                                            class="form-select border-0 shadow-sm" required>
                                                            <option value="">নির্বাচন করুন</option>
                                                            @foreach ($designations as $designation)
                                                                <option value="{{ $designation->id }}">
                                                                    {{ $designation->designation_name_bn }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label small fw-bold">শুরুর তারিখ</label>
                                                        <input type="date" name="start_date"
                                                            class="form-control border-0 shadow-sm" required>
                                                    </div>
                                                    <div class="col-12 text-end">
                                                        <button class="btn btn-emerald px-5 py-2 shadow">সংরক্ষণ
                                                            করুন</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
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
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleBtn = document.getElementById('toggleHistoryFormBtn');
            const backBtn = document.getElementById('backToTableBtn');
            const tableView = document.getElementById('historyTableView');
            const formView = document.getElementById('historyFormView');

            toggleBtn.addEventListener('click', () => {
                tableView.style.display = 'none';
                formView.style.display = 'block';
                toggleBtn.style.display = 'none';
            });

            backBtn.addEventListener('click', () => {
                formView.style.display = 'none';
                tableView.style.display = 'block';
                toggleBtn.style.display = 'block';
            });
        });
    </script>
</body>

</html>
