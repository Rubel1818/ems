<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <title>প্রশাসনিক ড্যাোর্ড</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #f4f7fa;
            font-family: 'Segoe UI', Tahoma, sans-serif;
        }

        .chart-box {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
        }

        .stat-card {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            border-left: 5px solid #4e73df;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: 0.3s;
            cursor: pointer;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            color: #5a5c69;
            font-size: 0.85rem;
            text-transform: uppercase;
            font-weight: bold;
        }

        .card-value {
            font-size: 1.6rem;
            font-weight: bold;
            color: #333;
        }

        .chart-container {
            position: relative;
            height: 400px;
            overflow-y: auto;
        }

        .table-custom thead {
            background-color: #4e73df;
            color: white;
        }
    </style>
</head>

<body>

    @include('employees.head_navbar')

    <div class="container-fluid">
        <div class="row">
            @include('employees.sidebar')

            <main class="col-md-9 col-lg-10 p-4">
                <h4 class="mb-4">📊 প্রশাসনিক ড্যাশবোর্ড ও পিআরএল ট্র্যাকার</h4>

                @php
                    use Carbon\Carbon;
                    $today = Carbon::today();
                    $threeYearsLater = Carbon::today()->addYears(3);

                    $activeEmployees = $employees->where('status', 1);

                    // পিআরএল ফিল্টার
                    $prlEmployees = $activeEmployees
                        ->filter(function ($emp) use ($today, $threeYearsLater) {
                            return $emp->prl_date && $emp->prl_date->between($today, $threeYearsLater);
                        })
                        ->sortBy('prl_date');

                    // জেলা ও পদবি ভিত্তিক ডাটা প্রসেসিং (Detailed Tooltip এর জন্য)
                    $distCounts = [];
                    $distDetails = []; // [District][Designation] = count

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

                    // পিআরএল চার্ট ডাটা
                    $prlChartData = [];
                    foreach ($prlEmployees as $emp) {
                        $prlChartData[] = [
                            'name' => $emp->name_bn,
                            'years' => number_format($today->diffInDays($emp->prl_date) / 365, 1),
                            'date' => $emp->prl_date->format('d/m/Y'),
                        ];
                    }
                @endphp

                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="card-title text-primary">সর্বমোট কর্মচারী</div>
                            <div class="card-value">{{ $activeEmployees->count() }} জন</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="chart-box">
                            <h6 class="text-dark fw-bold mb-3">📍 জেলা ভিত্তিক জনবল (পদবিসহ বিস্তারিত)</h6>
                            <canvas id="districtDetailedChart" height="250"></canvas>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="chart-box">
                            <h6 class="text-dark fw-bold mb-3">⏳ পিআরএল সময়সীমা (আগামী ৩ বছর)</h6>
                            <div class="chart-container">
                                @if (empty($prlChartData))
                                    <p class="text-center py-5 text-muted">আগামী ৩ বছরে অবসরের কেউ নেই।</p>
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

    <script>
        // জেলা ভিত্তিক বিস্তারিত ডাটা
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
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            // মূল পরিবর্তন এখানে: টুলটিপে পদবি অনুযায়ী সংখ্যা দেখাবে
                            afterLabel: function(context) {
                                const district = context.label;
                                const details = distDetails[district];
                                if (!details) return '';

                                let detailStrings = ['\nপদবি অনুযায়ী:'];
                                for (const [desig, count] of Object.entries(details)) {
                                    detailStrings.push(`${desig}: ${count} জন`);
                                }
                                return detailStrings;
                            }
                        }
                    }
                }
            }
        });

        // PRL Chart
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
                        borderRadius: 5
                    }]
                },
                options: {
                    indexAxis: 'y',
                    maintainAspectRatio: false
                }
            });
        @endif
    </script>
</body>

</html>
