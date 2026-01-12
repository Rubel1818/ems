<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $employee->name_bn }} — কর্মচারী হিস্ট্রি</title>

    <!-- Bootstrap CSS (v5.3) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional: Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container-fluid py-4">

        <div class="row justify-content-center">
            <div class="col-lg-10">

                {{-- PAGE HEADER --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">
                        🧾 {{ $employee->name_bn }} — কর্মচারী হিস্ট্রি
                    </h4>

                    <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-secondary btn-sm">
                        ← প্রোফাইলে ফিরে যান
                    </a>
                </div>

                {{-- CREATE HISTORY CARD --}}
                <div class="card shadow mb-4">
                    <div class="card-header bg-primary text-white">
                        <strong>➕ নতুন হিস্ট্রি যোগ করুন</strong>
                    </div>

                    <div class="card-body">

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

                        <form method="POST" action="{{ route('employees.histories.store', $employee->id) }}">
                            @csrf

                            <div class="row">

                                {{-- Section --}}
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">শাখা (Section)</label>
                                    <select name="section_id" class="form-select" required>
                                        <option value="">-- নির্বাচন করুন --</option>
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}"
                                                {{ old('section_id') == $section->id ? 'selected' : '' }}>
                                                {{ $section->section_name_bn }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Designation --}}
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">পদবি (Designation)</label>
                                    <select name="designation_id" class="form-select" required>
                                        <option value="">-- নির্বাচন করুন --</option>
                                        @foreach ($designations as $designation)
                                            <option value="{{ $designation->id }}"
                                                {{ old('designation_id') == $designation->id ? 'selected' : '' }}>
                                                {{ $designation->designation_name_bn }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Start Date --}}
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">শুরুর তারিখ</label>
                                    <input type="date" name="start_date" class="form-control"
                                        value="{{ old('start_date') }}" required>
                                </div>

                            </div>

                            <div class="text-end">
                                <button class="btn btn-success">
                                    💾 সংরক্ষণ করুন
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

                {{-- HISTORY LIST --}}
                <div class="card shadow">
                    <div class="card-header bg-dark text-white">
                        <strong>📋 হিস্ট্রি তালিকা</strong>
                    </div>

                    <div class="card-body p-0">
                        <table class="table table-bordered table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>শাখা</th>
                                    <th>পদবি</th>
                                    <th>শুরুর তারিখ</th>
                                    <th>শেষ তারিখ</th>
                                    <th width="150" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($histories as $history)
                                    <tr>
                                        <td>{{ $history->section->section_name_bn }}</td>
                                        <td>{{ $history->designation->designation_name_bn }}</td>
                                        <td>{{ $history->start_date }}</td>
                                        <td>
                                            {{ $history->end_date ?? 'বর্তমান' }}
                                        </td>
                                        <td class="text-center">

                                            <a href="{{ route('employees.histories.edit', [$employee->id, $history->id]) }}"
                                                class="btn btn-sm btn-warning">
                                                ✏️ Edit
                                            </a>

                                            <form method="POST"
                                                action="{{ route('employees.histories.destroy', [$employee->id, $history->id]) }}"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger"
                                                    onclick="return confirm('আপনি কি নিশ্চিত?')">
                                                    🗑 Delete
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-3">
                                            কোনো হিস্ট্রি পাওয়া যায়নি
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- Bootstrap JS (with Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
