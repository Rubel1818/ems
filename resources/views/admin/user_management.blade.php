<style>
    :root {
        --primary-color: #006a4e;
        --bg-soft: #f4f7f6;
        --dark-blue: #2c3e50;
    }

    body {
        background-color: var(--bg-soft);
        font-family: 'Hind Siliguri', sans-serif;
        margin: 0;
    }

    .main-wrapper {
        display: flex;
        min-height: 100vh;
    }

    .content-area {
        flex-grow: 1;
        padding: 25px;
        transition: all 0.3s;
    }

    /* Card Styling */
    .main-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        background: white;
        border-top: 5px solid var(--primary-color);
    }

    .page-header {
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #e9ecef;
    }

    /* Table Design */
    .table thead th {
        background-color: #f8f9fa;
        font-weight: 700;
        color: var(--primary-color);
        padding: 15px;
        border-bottom: 2px solid #dee2e6;
    }

    /* Status Badges */
    .status-badge {
        padding: 8px 16px;
        font-weight: 700;
        font-size: 0.85rem;
        border-radius: 50px;
        display: inline-flex;
        align-items: center;
    }

    .badge-approved {
        background-color: #198754 !important;
        color: #ffffff !important;
        box-shadow: 0 2px 6px rgba(25, 135, 84, 0.3);
    }

    .badge-pending {
        background-color: #ffc107 !important;
        color: #000000 !important;
        box-shadow: 0 2px 6px rgba(255, 193, 7, 0.3);
    }

    .avatar-box {
        width: 42px;
        height: 42px;
        background-color: #e9ecef;
        color: var(--primary-color);
        border: 2px solid #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .btn-action {
        border-radius: 8px;
        padding: 8px 12px;
        font-weight: 600;
        transition: 0.3s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    /* Pagination Fix */
    .pagination svg {
        width: 1.25rem !important;
        height: 1.25rem !important;
    }

    /* ডিলিট আইকন নিশ্চিতভাবে দেখানোর জন্য */
    .fa-trash-can,
    .fa-trash-alt {
        display: inline-block !important;
        visibility: visible !important;
    }
</style>
</head>

<body>
    @include('employees.header')

    <div class="main-wrapper">
        @include('employees.sidebar')

        <main class="content-area">
            <div class="container-fluid">

                <div class="d-flex justify-content-between align-items-center page-header">
                    <div>
                        <h2 class="h3 mb-1 fw-bold text-dark">ইউজার ম্যানেজমেন্ট</h2>
                        <p class="text-muted mb-0 small">অ্যাডমিন প্যানেল: ইউজার রোল এবং অ্যাকাউন্টের অনুমতি পরিচালনা
                            করুন।</p>
                    </div>
                    <a href="{{ route('employees.index') }}"
                        class="btn btn-outline-dark btn-sm rounded-pill px-4 shadow-sm">
                        <i class="fas fa-arrow-left me-2"></i>ড্যাশবোর্ড
                    </a>
                </div>

                <div class="card main-card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th class="ps-4">ইউজার তথ্য</th>
                                        <th class="text-center">স্ট্যাটাস</th>
                                        <th class="text-center">রোল (Role)</th>
                                        <th class="text-end pe-4">অ্যাকশন</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr>
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="avatar-box rounded-circle d-flex align-items-center justify-content-center me-3">
                                                        <span
                                                            class="fw-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                                    </div>
                                                    <div>
                                                        <div class="fw-bold text-dark mb-0">{{ $user->name }}</div>
                                                        <div class="text-muted small">{{ $user->email }}</div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="text-center">
                                                @if ($user->is_approved)
                                                    <span class="status-badge badge-approved">
                                                        <i class="fas fa-check-circle me-2"></i>অনুমোদিত
                                                    </span>
                                                @else
                                                    <span class="status-badge badge-pending">
                                                        <i class="fas fa-clock me-2"></i>অপেক্ষমান
                                                    </span>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                <form action="{{ route('admin.users.role', $user->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <select name="role" onchange="this.form.submit()"
                                                        class="form-select form-select-sm border-success fw-bold shadow-sm mx-auto"
                                                        style="width: 140px;">
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->name }}"
                                                                {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                                {{ ucfirst($role->name) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </form>
                                            </td>

                                            <td class="text-end pe-4">
                                                <div class="d-flex justify-content-end gap-2">
                                                    @if (!$user->is_approved)
                                                        <form action="{{ route('admin.users.approve', $user->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-sm btn-success btn-action shadow-sm">
                                                                <i class="fas fa-user-check me-1"></i> Approve
                                                            </button>
                                                        </form>
                                                    @endif

                                                    <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('আপনি কি নিশ্চিত যে এই ইউজারটিকে মুছে ফেলতে চান?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-danger btn-action shadow-sm"
                                                            title="ডিলিট করুন">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-5">
                                                <p class="text-muted fw-bold">কোনো নিবন্ধিত ইউজার পাওয়া যায়নি।</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer bg-white py-4 border-0">
                        <div class="d-flex justify-content-center">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
