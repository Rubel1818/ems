<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <title>কর্মচারীর হিস্ট্রি যোগ করুন</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
        }

        .card {
            border-radius: 10px;
        }
    </style>
</head>

<body>

    @include('employees.head_navbar')

    <div class="container-fluid">
        <div class="row">

            @include('employees.sidebar')

            <main class="col-md-9 col-lg-10 p-4">

                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            কর্মচারীর পদ ও শাখা হিস্ট্রি যোগ করুন
                        </h5>

                        <a href="{{ route('employees.histories.index', $employee->id) }}" class="btn btn-primary">
                            History
                        </a>
                    </div>

                    <div class="card-body">

                        {{-- Employee Basic Info --}}
                        <div class="alert alert-info">
                            <strong>কর্মচারী:</strong>
                            {{ $employee->name_bn }}
                            ({{ $employee->employee_id }})
                        </div>

                        {{-- Validation Errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Form --}}
                        <form method="POST" action="{{ route('employees.histories.store', $employee->id) }}">
                            @csrf

                            {{-- Section --}}
                            <div class="mb-3">
                                <label class="form-label">শাখা (Section)</label>
                                <select name="section_id" class="form-select" required>
                                    <option value="">-- শাখা নির্বাচন করুন --</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}"
                                            {{ old('section_id') == $section->id ? 'selected' : '' }}>
                                            {{ $section->section_name_bn }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Designation --}}
                            <div class="mb-3">
                                <label class="form-label">পদবি (Designation)</label>
                                <select name="designation_id" class="form-select" required>
                                    <option value="">-- পদবি নির্বাচন করুন --</option>
                                    @foreach ($designations as $designation)
                                        <option value="{{ $designation->id }}"
                                            {{ old('designation_id') == $designation->id ? 'selected' : '' }}>
                                            {{ $designation->designation_name_bn }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Starting Date --}}
                            <div class="mb-3">
                                <label class="form-label">শুরুর তারিখ</label>
                                <input type="date" name="start_date" class="form-control"
                                    value="{{ old('start_date') }}" required>
                            </div>

                            {{-- Buttons --}}
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('employees.histories.index', $employee->id) }}"
                                    class="btn btn-secondary">
                                    ← ফিরে যান
                                </a>

                                <button type="submit" class="btn btn-success">
                                    💾 সংরক্ষণ করুন
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
