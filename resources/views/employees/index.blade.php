@include('employees.header')

<style>
    /* মেইন কার্ড এবং পেজ সেটআপ */
    body {
        background-color: #f8fafc;
    }

    .employee-card {
        border-radius: 12px;
        border: none;
        background: #ffffff;
    }

    .card-header-gradient {
        background: linear-gradient(135deg, #1e293b, #334155);
        padding: 1.25rem;
        border-radius: 12px 12px 0 0 !important;
    }

    /* টেবিল স্টাইল */
    .table thead th {
        background-color: #f1f5f9;
        color: #475569;
        font-weight: 700;
        border-bottom: 2px solid #e2e8f0;
        text-transform: uppercase;
        font-size: 0.8rem;
    }

    .table tbody tr {
        transition: all 0.2s;
    }

    .table tbody tr:hover {
        background-color: #f8fafc;
    }

    /* হাই-ভিজিবিলিটি অ্যাকশন বাটন */
    .btn-action {
        width: 36px;
        height: 36px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin: 2px;
        border: none;
        color: white !important;
        transition: all 0.2s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
    }

    /* বাটন ভিত্তিক উজ্জ্বল কালার */
    .btn-view {
        background-color: #0ea5e9 !important;
    }

    /* উজ্জ্বল আকাশী নীল */
    .btn-edit {
        background-color: #f59e0b !important;
    }

    /* উজ্জ্বল কমলা */
    .btn-delete {
        background-color: #ef4444 !important;
    }

    /* গাঢ় লাল */
    .btn-approve {
        background-color: #10b981 !important;
    }

    /* উজ্জ্বল সবুজ */

    .btn-action:hover {
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
        filter: brightness(1.15);
    }

    /* স্ট্যাটাস ব্যাজ */
    .badge-status {
        padding: 6px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .bg-approved {
        background-color: #dcfce7;
        color: #166534;
        border: 1px solid #bbf7d0;
    }

    .bg-pending {
        background-color: #fef9c3;
        color: #854d0e;
        border: 1px solid #fef08a;
    }

    /* ডাটা টেবিল কাস্টমাইজেশন */
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 8px;
        padding: 6px 12px;
        border: 1px solid #cbd5e1;
        outline: none;
    }
</style>

<div class="container-fluid">
    <div class="row">
        @include('employees.sidebar')

        <main class="col-md-9 col-lg-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold text-slate-800 mb-1">কর্মকর্তা/কর্মচারী তালিকা</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-decoration-none">ড্যাশবোর্ড</a></li>
                            <li class="breadcrumb-item active">তালিকা</li>
                        </ol>
                    </nav>
                </div>
                <a href="{{ route('employees.create') }}"
                    class="btn btn-success rounded-pill px-4 py-2 shadow-sm fw-bold">
                    <i class="bi bi-person-plus-fill me-2"></i>নতুন যোগ করুন
                </a>
            </div>

            <div class="card employee-card shadow-sm">
                <div class="card-header-gradient text-white">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-people-fill fs-4 me-2"></i>
                        <h5 class="mb-0 fw-bold">নিবন্ধিত কর্মচারীদের ডাটাবেস</h5>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="employeesTable" class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>আইডি</th>
                                    <th>নাম (বাংলা)</th>
                                    <th>পদবি</th>
                                    <th>স্ট্যাটাস</th>
                                    <th class="text-center">অ্যাকশন</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($employees as $employee)
                                    <tr>
                                        <td class="text-primary fw-bold">#{{ $employee->employee_id }}</td>
                                        <td>
                                            <div class="fw-bold text-dark">{{ $employee->name_bn }}</div>
                                            <small class="text-muted">{{ $employee->name_en }}</small>
                                        </td>
                                        <td>
                                            <span class="text-secondary fw-semibold">
                                                {{ optional($employee->stuffDesignation)->designation_name_bn ?? 'অনির্ধারিত' }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($employee->status == 1)
                                                <span class="badge-status bg-approved text-uppercase">
                                                    <i class="bi bi-patch-check-fill me-1"></i>Approved
                                                </span>
                                            @else
                                                <span class="badge-status bg-pending text-uppercase">
                                                    <i class="bi bi-hourglass-split me-1"></i>Pending
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center" style="white-space: nowrap;">
                                            <a href="{{ route('employees.show', $employee->id) }}"
                                                class="btn-action btn-view" title="বিস্তারিত দেখুন">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>

                                            @role('admin')
                                                <a href="{{ route('employees.edit', $employee->id) }}"
                                                    class="btn-action btn-edit" title="এডিট করুন">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>

                                                <form action="{{ route('employees.destroy', $employee->id) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('আপনি কি নিশ্চিতভাবে ডিলিট করতে চান?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-action btn-delete" title="ডিলিট করুন">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </form>

                                                @if ($employee->status == 0)
                                                    <form method="POST"
                                                        action="{{ route('employees.approve', $employee->id) }}"
                                                        class="d-inline" onsubmit="return approveEmployee(this,event);">
                                                        @csrf
                                                        <button type="submit" class="btn-action btn-approve"
                                                            title="অনুমোদন দিন">
                                                            <i class="bi bi-check-lg"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            @endrole

                                            @role('employee')
                                                @if ($employee->status == 0)
                                                    <a href="{{ route('employees.edit', $employee->id) }}"
                                                        class="btn-action btn-edit" title="এডিট">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </a>
                                                    <form action="{{ route('employees.destroy', $employee->id) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('ডিলিট করবেন?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-action btn-delete" title="ডিলিট">
                                                            <i class="bi bi-trash-fill"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <button class="btn-action bg-secondary" disabled
                                                        title="অনুমোদিত ডাটা পরিবর্তনযোগ্য নয়">
                                                        <i class="bi bi-lock-fill"></i>
                                                    </button>
                                                @endif
                                            @endrole
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-5 text-center">
                                            <img src="{{ asset('images/no-data.png') }}" alt="No Data"
                                                style="width: 80px;" class="opacity-50">
                                            <p class="text-muted mt-2">বর্তমানে কোনো কর্মচারীর তথ্য নেই।</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $('#employeesTable').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            order: [
                [0, 'desc']
            ],
            lengthMenu: [10, 25, 50],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "খুঁজুন...",
                lengthMenu: "_MENU_ টি রেকর্ড",
                info: "মোট _TOTAL_ জনের মধ্যে _START_-_END_ দেখাচ্ছেন",
                paginate: {
                    next: "→",
                    previous: "←"
                },
                zeroRecords: "দুঃখিত, কোনো তথ্য পাওয়া যায়নি",
            }
        });
    });

    function approveEmployee(form, event) {
        event.preventDefault();
        const button = form.querySelector('button');
        const originalHtml = button.innerHTML;
        button.disabled = true;
        button.innerHTML = '<span class="spinner-border spinner-border-sm"></span>';

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': form.querySelector('[name="_token"]').value,
                'Accept': 'application/json'
            }
        }).then(response => {
            if (response.ok) location.reload();
            else {
                alert('An error occurred');
                button.disabled = false;
                button.innerHTML = originalHtml;
            }
        });
    }
</script>
