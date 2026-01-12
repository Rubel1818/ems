@php
    use Carbon\Carbon;
    $today = Carbon::today();
    $threeYearsLater = Carbon::today()->addYears(3);

    $activeEmployees = $employees->where('status', 1);

    // PRL Filter
    $prlEmployees = $activeEmployees
        ->filter(function ($emp) use ($today, $threeYearsLater) {
            return $emp->prl_date && $emp->prl_date->between($today, $threeYearsLater);
        })
        ->sortBy('prl_date');

    // Data Processing for District & Designation
    $distCounts = [];
    $distDetails = [];

    foreach ($activeEmployees as $emp) {
        if ($emp->district) {
            $dName = $emp->district->district_name_bn;
            $distCounts[$dName] = ($distCounts[$dName] ?? 0) + 1;

            if ($emp->stuffDesignation) {
                $dsName = $emp->stuffDesignation->designation_name_bn;
                $distDetails[$dName][$dsName] = ($distDetails[$dName][$dsName] ?? 0) + 1;
            }
        }
    }

    // PRL Chart Data
    $prlChartData = [];
    foreach ($prlEmployees as $emp) {
        $prlChartData[] = [
            'name' => $emp->name_bn,
            'years' => number_format($today->diffInDays($emp->prl_date) / 365, 1),
            'date' => $emp->prl_date->format('d/m/Y'),
        ];
    }
@endphp

@include('employees.header') {{-- This includes your <head> and opening <body> --}}

<style>
    .dashboard-wrapper {
        background-color: #f8f9fc;
        min-height: 100vh;
    }

    .stat-card {
        border: none;
        border-radius: 10px;
        transition: all 0.3s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .border-left-primary {
        border-left: 4px solid #4e73df !important;
    }

    .border-left-success {
        border-left: 4px solid #1cc88a !important;
    }

    .border-left-warning {
        border-left: 4px solid #f6c23e !important;
    }

    .chart-box {
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
        height: 100%;
    }

    .canvas-container {
        position: relative;
        height: 320px;
        width: 100%;
    }

    .page-heading {
        color: #4e73df;
        font-weight: 700;
        border-bottom: 2px solid #eaecf4;
        padding-bottom: 10px;
    }
</style>

<div class="container-fluid dashboard-wrapper">
    <div class="row">
        @include('employees.sidebar')

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="page-heading mb-0">
                    <i class="bi bi-speedometer2 me-2"></i>মন্ত্রিপরিষদ বিভাগের কর্মকর্তা কর্মচারীদের প্রশাসনিক
                    ড্যাশবোর্ড
                </h4>
                <span class="badge bg-light text-dark shadow-sm p-2">
                    আজকের তারিখ: {{ $today->format('d/m/Y') }}
                </span>
            </div>

            <div class="row mb-4">
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card stat-card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">মোট সক্রিয়
                                        কর্মচারী</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $activeEmployees->count() }}
                                        জন</div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-people-fill fs-2 text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card stat-card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">পিআরএল (আগামী
                                        ৩ বছর)</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($prlChartData) }} জন
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-clock-history fs-2 text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card stat-card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">মোট জেলা
                                        কভারড</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($distCounts) }} টি
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-geo-alt-fill fs-2 text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-7 mb-4">
                    <div class="chart-box shadow-sm">
                        <h6 class="fw-bold text-primary mb-3">📍 জেলা ভিত্তিক জনবল বিবরণ</h6>
                        <div class="canvas-container">
                            <canvas id="districtDetailedChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 mb-4">
                    <div class="chart-box shadow-sm">
                        <h6 class="fw-bold text-danger mb-3">⏳ পিআরএল তালিকা (শীর্ষ ৩ বছর)</h6>
                        <div class="canvas-container" style="overflow-y: auto;">
                            @if (empty($prlChartData))
                                <div class="text-center py-5">
                                    <i class="bi bi-info-circle fs-1 text-muted"></i>
                                    <p class="text-muted mt-2">আগামী ৩ বছরে অবসরের কেউ নেই।</p>
                                </div>
                            @else
                                <canvas id="reorganizedPrlChart"></canvas>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // District Chart Logic
    const distData = @json($distCounts);
    const distDetails = @json($distDetails);

    const distCtx = document.getElementById('districtDetailedChart').getContext('2d');
    new Chart(distCtx, {
        type: 'bar',
        data: {
            labels: Object.keys(distData),
            datasets: [{
                label: 'মোট কর্মচারী',
                data: Object.values(distData),
                backgroundColor: 'rgba(78, 115, 223, 0.8)',
                hoverBackgroundColor: 'rgba(78, 115, 223, 1)',
                borderRadius: 6,
                barThickness: 30
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        afterLabel: function(context) {
                            const district = context.label;
                            const details = distDetails[district];
                            if (!details) return '';
                            let detailStrings = ['\nপদবি অনুযায়ী:'];
                            for (const [desig, count] of Object.entries(details)) {
                                detailStrings.push(`${desig}: ${count} জন`);
                            }
                            return detailStrings;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // PRL Chart Logic
    @if (!empty($prlChartData))
        const prlData = @json($prlChartData);
        new Chart(document.getElementById('reorganizedPrlChart'), {
            type: 'bar',
            data: {
                labels: prlData.map(d => d.name),
                datasets: [{
                    label: 'অবশিষ্ট বছর',
                    data: prlData.map(d => d.years),
                    backgroundColor: prlData.map(d => d.years < 1 ? '#e74a3b' : '#1cc88a'),
                    borderRadius: 4
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `অবশিষ্ট: ${context.raw} বছর (তারিখ: ${prlData[context.dataIndex].date})`;
                            }
                        }
                    }
                }
            }
        });
    @endif
</script>

</body>

</html>
