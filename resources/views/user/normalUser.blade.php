@include('header')
<style>
    body {
        background-color: #f0f2f5;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .profile-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
    }

    .card-header-custom {
        background: linear-gradient(45deg, #1e3c72, #2a5298);
        color: white;
        padding: 20px;
    }

    .info-label {
        color: #6c757d;
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 2px;
    }

    .info-value {
        color: #212529;
        font-weight: 500;
        font-size: 1.05rem;
    }

    .section-title {
        border-left: 4px solid #1e3c72;
        padding-left: 10px;
        margin-bottom: 20px;
        color: #1e3c72;
        font-weight: bold;
    }

    .status-badge {
        border-radius: 20px;
        padding: 5px 15px;
        font-size: 0.8rem;
    }

    .icon-box {
        width: 35px;
        color: #2a5298;
    }
</style>
</head>

<body>
    @include('user.sidebar')
    <div class="container py-5">
        <div class="card profile-card shadow mb-4">
            <div class="card-header-custom d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-white text-primary d-flex align-items-center justify-content-center me-3"
                        style="width: 60px; height: 60px;">
                        <i class="fa fa-user-tie fa-2xl"></i>
                    </div>
                    <div>
                        <h3 class="mb-0">{{ auth()->user()->name }}</h3>
                        <p class="mb-0 opacity-75"><i class="fa fa-envelope me-2"></i>{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <div>
                    @foreach ($employees as $emp)
                        @if ($emp->status == 1)
                            <span class="badge bg-success status-badge"><i
                                    class="fa fa-check-circle me-1"></i>Active</span>
                        @else
                            <span class="badge bg-danger status-badge"><i
                                    class="fa fa-times-circle me-1"></i>Inactive</span>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="card-body p-4">
                @if ($employees->count() > 0)
                    @foreach ($employees as $emp)
                        <div class="section-title">ব্যক্তিগত তথ্য (Personal Information)</div>
                        <div class="row mb-4">
                            <div class="col-md-4 mb-3">
                                <div class="info-label">নাম (বাংলা)</div>
                                <div class="info-value"><i
                                        class="fa-solid fa-signature icon-box"></i>{{ $emp->name_bn }}</div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="info-label">Name (English)</div>
                                <div class="info-value"><i class="fa-solid fa-user icon-box"></i>{{ $emp->name_en }}
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="info-label">জন্ম তারিখ</div>
                                <div class="info-value"><i
                                        class="fa-solid fa-cake-candles icon-box"></i>{{ $emp->dob }}</div>
                            </div>
                        </div>

                        <div class="section-title">পেশাগত তথ্য (Professional Details)</div>
                        <div class="row mb-4">
                            <div class="col-md-4 mb-3">
                                <div class="info-label">পদবী</div>
                                <div class="info-value text-primary font-weight-bold"><i
                                        class="fa-solid fa-briefcase icon-box"></i>{{ $emp->stuffDesignation->designation_name_bn ?? 'N/A' }}
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="info-label">শাখা / সেকশন</div>
                                <div class="info-value"><i
                                        class="fa-solid fa-sitemap icon-box"></i>{{ $emp->section->name_bn ?? 'N/A' }}
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="info-label">অফিস</div>
                                <div class="info-value"><i
                                        class="fa-solid fa-building icon-box"></i>{{ $emp->office->name_bn ?? 'N/A' }}
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="info-label">জেলা ও বিভাগ</div>
                                <div class="info-value"><i
                                        class="fa-solid fa-map-location-dot icon-box"></i>{{ $emp->district->name_bn ?? 'N/A' }},
                                    {{ $emp->division->name_bn ?? 'N/A' }}</div>
                            </div>
                        </div>

                        <div class="section-title">যোগাযোগ ও পরিচয় (Contact & Identity)</div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="info-label">মোবাইল নাম্বার</div>
                                <div class="info-value"><i
                                        class="fa-solid fa-phone-volume icon-box text-success"></i>{{ $emp->mobile }}
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="info-label">NID নাম্বার</div>
                                <div class="info-value"><i class="fa-solid fa-id-card icon-box"></i>{{ $emp->nid }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-5">
                        <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="100"
                            class="mb-3 opacity-50">
                        <h5 class="text-muted">আপনার কোনো তথ্য পাওয়া যায়নি!</h5>
                        <p class="text-secondary">দয়া করে প্রোফাইল আপডেট করুন।</p>
                    </div>
                @endif
            </div>

            <div class="card-footer bg-white p-3 text-end">
                <button class="btn btn-outline-primary rounded-pill px-4" onclick="window.print()">
                    <i class="fa fa-print me-2"></i>প্রিন্ট করুন
                </button>
            </div>
        </div>
    </div>

</body>

</html>
