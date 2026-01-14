@include('employees.header')

<style>
    /* ড্যাশবোর্ড লেআউট সেটআপ */
    .page-wrapper {
        display: flex;
        min-height: 100vh;
        background-color: #f4f7f6;
    }

    .main-content {
        flex: 1;
        padding: 30px;
        transition: all 0.3s;
    }

    /* প্রোফাইল কার্ড ডিজাইন */
    .profile-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        background: #fff;
        overflow: hidden;
    }

    .card-header-custom {
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        color: white;
        padding: 30px;
        border-bottom: 4px solid #2ecc71;
    }

    .profile-img-circle {
        width: 80px;
        height: 80px;
        background: rgba(255, 255, 255, 0.2);
        border: 3px solid rgba(255, 255, 255, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        border-radius: 50%;
    }

    /* সেকশন এবং লেবেল স্টাইল */
    .section-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #2c3e50;
        margin: 25px 0 15px 0;
        padding-bottom: 8px;
        border-bottom: 2px solid #eef2f7;
        display: flex;
        align-items: center;
    }

    .section-title i {
        margin-right: 10px;
        color: #2ecc71;
    }

    .info-box {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 10px;
        border-left: 3px solid #dee2e6;
        height: 100%;
        transition: 0.2s;
    }

    .info-box:hover {
        background: #fff;
        border-left-color: #2ecc71;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .info-label {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6c757d;
        margin-bottom: 5px;
        font-weight: 600;
    }

    .info-value {
        font-size: 1rem;
        color: #2d3436;
        font-weight: 500;
    }

    .icon-box {
        color: #2c3e50;
        margin-right: 10px;
        width: 20px;
        text-align: center;
    }

    .status-badge {
        padding: 8px 16px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* প্রিন্ট অপ্টিমাইজেশন */
    @media print {

        .sidebar,
        .navbar,
        .btn-print {
            display: none !important;
        }

        .main-content {
            padding: 0;
        }

        .profile-card {
            box-shadow: none;
            border: 1px solid #ddd;
        }
    }
</style>

<div class="page-wrapper">
    {{-- Sidebar --}}
    @include('user.sidebar')

    {{-- সফলভাবে সেভ হওয়ার সাকসেস মেসেজ --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert"
            style="border-left: 5px solid #198754;">
            <div class="d-flex align-items-center">
                <i class="bi bi-check-circle-fill me-2 fs-4"></i>
                <div>{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="main-content">
        <div class="container-fluid">

            <div class="card profile-card">
                {{-- Header Section --}}
                <div class="card-header-custom">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="d-flex align-items-center">
                                <div class="profile-img-circle me-4">
                                    <i class="bi bi-person-badge"></i>
                                </div>
                                <div>
                                    <h2 class="mb-1 fw-bold">{{ auth()->user()->name }}</h2>
                                    <p class="mb-0 opacity-75">
                                        <i class="bi bi-envelope-at me-2"></i>{{ auth()->user()->email }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-end mt-3 mt-md-0">

                            @if ($employees->status == 1)
                                <span class="badge bg-success status-badge">
                                    <i class="bi bi-check-circle-fill me-1"></i> Active Employee
                                </span>
                            @else
                                <span class="badge bg-danger status-badge">
                                    <i class="bi bi-x-circle-fill me-1"></i> Inactive
                                </span>
                            @endif

                        </div>
                    </div>
                </div>

                {{-- Body Section --}}
                <div class="card-body p-4 p-lg-5">
                    @if ($employees->count() > 0)
                        {{-- Personal Info --}}
                        <div class="section-title">
                            <i class="bi bi-person-lines-fill"></i> ব্যক্তিগত তথ্য (Personal Information)
                        </div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <div class="info-box">
                                    <div class="info-label">নাম (বাংলা)</div>
                                    <div class="info-value"><i
                                            class="bi bi-pencil-square icon-box"></i>{{ $employees->name_bn }}</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box">
                                    <div class="info-label">Name (English)</div>
                                    <div class="info-value"><i
                                            class="bi bi-alphabet icon-box"></i>{{ $employees->name_en }}</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box">
                                    <div class="info-label">জন্ম তারিখ</div>
                                    <div class="info-value"><i
                                            class="bi bi-calendar-event icon-box"></i>{{ $employees->birth_date }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- Professional Details --}}
                        <div class="section-title">
                            <i class="bi bi-briefcase-fill"></i> পেশাগত তথ্য (Professional Details)
                        </div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <div class="info-box">
                                    <div class="info-label">পদবী</div>
                                    <div class="info-value text-primary fw-bold"><i
                                            class="bi bi-award icon-box"></i>{{ $employees->stuffDesignation->designation_name_bn ?? 'N/A' }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box">
                                    <div class="info-label">শাখা / সেকশন</div>
                                    <div class="info-value"><i
                                            class="bi bi-diagram-3 icon-box"></i>{{ $employees->section->section_name_bn ?? 'N/A' }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box">
                                    <div class="info-label">অফিস</div>
                                    <div class="info-value"><i class="bi bi-building icon-box"></i>মন্ত্রিপরিষদ বিভাগ
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box">
                                    <div class="info-label">জেলা</div>
                                    <div class="info-value"><i
                                            class="bi bi-geo-alt icon-box"></i>{{ $employees->district->district_name_bn ?? 'N/A' }},
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Contact Info --}}
                        <div class="section-title">
                            <i class="bi bi-telephone-fill"></i> যোগাযোগ ও পরিচয় (Contact & Identity)
                        </div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="info-box">
                                    <div class="info-label">মোবাইল নাম্বার</div>
                                    <div class="info-value text-success fw-bold"><i
                                            class="bi bi-phone icon-box"></i>{{ $employees->mobile }}</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box">
                                    <div class="info-label">NID নাম্বার</div>
                                    <div class="info-value"><i
                                            class="bi bi-card-heading icon-box"></i>{{ $employees->nid }}</div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-exclamation-triangle fs-1 text-warning"></i>
                            <h5 class="text-muted mt-3">আপনার কোনো তথ্য পাওয়া যায়নি!</h5>
                            <button class="btn btn-primary mt-2">প্রোফাইল আপডেট করুন</button>
                        </div>
                    @endif
                </div>

                {{-- Footer Action --}}
                <div class="card-footer bg-light p-4 text-end">
                    <button class="btn btn-dark rounded-pill px-4 btn-print shadow-sm" onclick="window.print()">
                        <i class="bi bi-printer me-2"></i> তথ্য প্রিন্ট করুন
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
