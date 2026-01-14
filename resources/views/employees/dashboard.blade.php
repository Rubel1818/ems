@php
    use Carbon\Carbon;
    $today = Carbon::today();
    $threeYearsLater = Carbon::today()->addYears(3);

    $activeEmployees = $employees->where('status', 1);

    // PRL Filter Logic (Keeping same)
    $prlEmployees = $activeEmployees
        ->filter(function ($emp) use ($today, $threeYearsLater) {
            return $emp->prl_date && $emp->prl_date->between($today, $threeYearsLater);
        })
        ->sortBy('prl_date');

    // Data Processing (Keeping same)
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

    $prlChartData = [];
    foreach ($prlEmployees as $emp) {
        $prlChartData[] = [
            'name' => $emp->name_bn,
            'years' => number_format($today->diffInDays($emp->prl_date) / 365, 1),
            'date' => $emp->prl_date->format('d/m/Y'),
        ];
    }
@endphp

@include('employees.header')

<style>
    /* আধুনিক কালার প্যালেট এবং ফন্ট */
    body {
        background-color: #f4f7f6;
        font-family: 'SolaimanLipi', sans-serif;
    }
    .dashboard-wrapper {
        display: flex;
        min-height: 100vh;
    }
    .main-content {
        flex: 1;
        padding: 25px;
        background-color: #f4f7f6;
    }
    .page-header {
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.04);
        margin-bottom: 25px;
    }
    .stat-card {
        border: none;
        border-radius: 12px;
        padding: 20px;
        background: #fff;
        transition: all 0.3s cubic-bezier(.25,.8,.25,1);
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        display: flex;
        align-items: center;
    }
    .stat-card:hover {
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        transform: translateY(-3px);
    }
    .stat-icon {
        width: 55px;
        height: 55px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-right: 15px;
    }
    .bg-soft-primary { background: #eef2ff; color: #4e73df; }
    .bg-soft-warning { background: #fffcf0; color: #f6c23e; }
    .bg-soft-success { background: #f0fdf4; color: #1cc88a; }

    .chart-container-box {
        background: #fff;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        height: 100%;
    }
    .chart-title {
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }
</style>

<div class="dashboard-wrapper">
    {{-- Sidebar Layout --}}
    @include('employees.sidebar')

    <div class="main-content">
        {{-- Header Section --}}
        <div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h4 class="mb-1 text-primary fw-bold">প্রশাসনিক ড্যাশবোর্ড</h4>
                <p class="text-muted mb-0">মন্ত্রিপরিষদ বিভাগ (১০-২০তম গ্রেড)</p>
            </div>
            <div class="text-md-end">
                <span class="badge bg-white text-dark border p-2 shadow-sm">
                    <i class="bi bi-calendar-check text-primary me-2"></i>আজকের তারিখ: {{ $today->format('d/m/Y') }}
                </span>
            </div>
        </div>

        {{-- Statistics Cards --}}
        <div class="row g-4 mb-4">
            <div class="col-xl-4 col-md-6">
                <div class="stat-card border-start border-primary border-5">
                    <div class="stat-icon bg-soft-primary"><i class="bi bi-people-fill"></i></div>
                    <div>
                        <p class="text-muted mb-1 font-weight-bold" style="font-size: 0.85rem;">মোট জনবল (১০-২০ গ্রেড)</p>
                        <h3 class="mb-0 fw-bold text-dark">{{ $activeEmployees->count() }} জন</h3>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="stat-card border-start border-warning border-5">
                    <div class="stat-icon bg-soft-warning"><i class="bi bi-clock-history"></i></div>
                    <div>
                        <p class="text-muted mb-1 font-weight-bold" style="font-size: 0.85rem;">আগামী ৩ বছরে পিআরএল</p>
                        <h3 class="mb-0 fw-bold text-dark">{{ count($prlChartData) }} জন</h3>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="stat-card border-start border-success border-5">
                    <div class="stat-icon bg-soft-success"><i class="bi bi-geo-alt-fill"></i></div>
                    <div>
                        <p class="text-muted mb-1 font-weight-bold" style="font-size: 0.85rem;">প্রতিনিধিত্বকারী জেলা সংখ্যা</p>
                        <h3 class="mb-0 fw-bold text-dark">{{ count($distCounts) }} টি</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- Charts Section --}}
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="chart-container-box">
                    <h6 class="chart-title text-primary"><i class="bi bi-bar-chart-fill me-2"></i>জেলা ভিত্তিক জনবল বিন্যাস</h6>
                    <div style="height: 380px;">
                        <canvas id="districtDetailedChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="chart-container-box">
                    <h6 class="chart-title text-danger"><i class="bi bi-pie-chart-fill me-2"></i>পিআরএল টাইমলাইন (আগামী ৩ বছর)</h6>
                    <div style="height: 380px; overflow-y: auto;">
                        @if (empty($prlChartData))
                            <div class="text-center py-5">
                                <i class="bi bi-emoji-smile fs-1 text-muted"></i>
                                <p class="text-muted mt-2">আগামী ৩ বছরে অবসরের তালিকায় কেউ নেই।</p>
                            </div>
                        @else
                            <canvas id="reorganizedPrlChart"></canvas>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // --- District Chart Logic (Keeping original) ---
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
                backgroundColor: '#4e73df',
                borderRadius: 5,
                barThickness: 28
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        afterLabel: function(context) {
                            const district = context.label;
                            const details = distDetails[district];
                            if (!details) return '';
                            let res = ['\nপদবি অনুযায়ী:'];
                            for (const [desig, count] of Object.entries(details)) {
                                res.push(`${desig}: ${count} জন`);
                            }
                            return res;
                        }
                    }
                }
            }
        }
    });

    // --- PRL Chart Logic (Keeping original) ---
    @if (!empty($prlChartData))
        const prlData = @json($prlChartData);
        new Chart(document.getElementById('reorganizedPrlChart'), {
            type: 'bar',
            data: {
                labels: prlData.map(d => d.name),
                datasets: [{
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
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(c) {
                                return `অবশিষ্ট: ${c.raw} বছর (তারিখ: ${prlData[c.dataIndex].date})`;
                            }
                        }
                    }
                }
            }
        });
    @endif
</script>