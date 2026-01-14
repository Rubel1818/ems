<nav class="col-md-3 col-lg-2 d-md-block sidebar shadow-lg" id="sidebarMenu">
    <div class="sidebar-sticky pt-4 px-3">

        <div class="user-info text-center mb-4 pb-4 border-bottom border-secondary border-opacity-25">
            <div class="avatar-circle mx-auto mb-2">
                <i class="bi bi-person-circle text-white-50 fs-1"></i>
            </div>
            <h6 class="text-white small mb-0">{{ Auth::user()->name }}</h6>
            <span class="badge bg-success mt-1" style="font-size: 0.6rem; padding: 2px 8px;">অনলাইন</span>
        </div>


        <ul class="nav flex-column gap-2">
            @role('stuff')
                @php
                    // ইউজারের এমপ্লয়ী তথ্যটি আনা হচ্ছে
                    $employee = auth()->user()->employee;
                    $hasInformation = $employee !== null;

                    // চেক করা হচ্ছে এডমিন এন্ট্রিটি এপ্রুভ করেছে কি না (ধরে নিচ্ছি status == 1 মানে এপ্রুভড)
                    $isApproved = $hasInformation && $employee->status == 1;
                @endphp

                {{-- প্রথম বাটন: তথ্য যোগ করুন --}}
                <li class="nav-item me-2">
                    @if (!$hasInformation)
                        {{-- তথ্য না থাকলে বাটন একটিভ থাকবে --}}
                        <a href="{{ route('NormalUser.create') }}"
                            class="btn btn-success rounded-pill px-4 py-2 shadow-sm fw-bold">
                            <i class="bi bi-person-plus-fill me-2"></i>আপনার তথ্য যোগ করুন
                        </a>
                    @else
                        {{-- তথ্য অলরেডি যোগ করা থাকলে এটি ডিসেবল থাকবে --}}
                        <button class="btn btn-secondary rounded-pill px-4 py-2 shadow-sm fw-bold" disabled>
                            <i class="bi bi-check-circle-fill me-2"></i>তথ্য যোগ করা হয়েছে
                        </button>
                    @endif
                </li>

                {{-- দ্বিতীয় বাটন: তথ্য দেখুন অথবা এপ্রুভাল স্ট্যাটাস --}}
                <li class="nav-item">
                    @if (!$hasInformation)
                        {{-- তথ্য একদমই না থাকলে --}}
                        <button class="btn btn-outline-primary rounded-pill px-4 py-2 shadow-sm fw-bold disabled"
                            style="opacity: 0.5; cursor: not-allowed;">
                            <i class="bi bi-lock-fill me-2"></i>তথ্য দেখুন (আগে যোগ করুন)
                        </button>
                    @elseif ($hasInformation && !$isApproved)
                        {{-- তথ্য আছে কিন্তু এডমিন এখনো এপ্রুভ করেনি --}}
                        <button class="btn btn-warning rounded-pill px-4 py-2 shadow-sm fw-bold" disabled
                            style="color: #856404; background-color: #fff3cd; border-color: #ffeeba;">
                            <i class="bi bi-hourglass-split me-2"></i>এডমিন অনুমোদনের অপেক্ষায়...
                        </button>
                    @else
                        {{-- তথ্য আছে এবং এডমিন এপ্রুভ করেছে --}}
                        <a href="{{ route('NormalUser.Dashboard') }}"
                            class="btn btn-primary rounded-pill px-4 py-2 shadow-sm fw-bold">
                            <i class="bi bi-person-lines-fill me-2"></i>আপনার তথ্য দেখুন
                        </a>
                    @endif
                </li>
            @endrole
            @role('admin|employee|userdashboard|')
                <li class="nav-item">
                    <a class="nav-link custom-link {{ Request::is('dashboard*') ? 'active' : '' }}"
                        href="{{ route('dashboardView') }}">
                        <i class="fa-solid fa-users-viewfinder me-3"></i>
                        <span>ড্যাশবোর্ড</span>
                    </a>
                </li>
            @endrole
            @role('admin')
                <li class="nav-item">
                    <a class="nav-link custom-link {{ Request::is('admin/users*') ? 'active' : '' }}"
                        href="{{ url('admin/users') }}">
                        <i class="fa-solid fa-users-gear me-3"></i>
                        <span>ইউজার ম্যানেজমেন্ট</span>
                    </a>
                </li>
            @endrole

            @role('admin|employee')
                <li class="nav-item">
                    <a class="nav-link custom-link {{ Request::is('employees*') ? 'active' : '' }}"
                        href="{{ route('employees.index') }}">
                        <i class="fa-solid fa-users-line me-3"></i>
                        <span>কর্মচারী তালিকা</span>
                    </a>
                </li>
            @endrole

            <li class="nav-item mt-4 pt-4 border-top border-secondary border-opacity-10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn logout-btn w-100 d-flex align-items-center justify-content-center">
                        <i class="bi bi-box-arrow-right me-2"></i>
                        <span>লগআউট</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>

<style>
    #sidebarMenu {
        min-height: 100vh;
        background: #212529;
        /* Darker professional background */
        transition: all 0.3s;
    }

    .sidebar-sticky {
        position: sticky;
        top: 0;
    }

    /* Custom Link Styling */
    .custom-link {
        color: rgba(255, 255, 255, 0.75) !important;
        padding: 12px 15px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
        font-weight: 500;
        font-size: 0.95rem;
    }

    .custom-link i {
        font-size: 1.1rem;
        transition: transform 0.3s;
    }

    .custom-link:hover {
        background: rgba(255, 255, 255, 0.1);
        color: #2ecc71 !important;
        transform: translateX(5px);
    }

    .custom-link:hover i {
        transform: scale(1.2);
    }

    /* Active State */
    .custom-link.active {
        background: #2ecc71;
        color: #fff !important;
        box-shadow: 0 4px 10px rgba(46, 204, 113, 0.3);
    }

    /* Logout Button */
    .logout-btn {
        background: transparent;
        border: 1px solid rgba(220, 53, 69, 0.5);
        color: #ff4d4d;
        padding: 10px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .logout-btn:hover {
        background: #dc3545;
        color: white;
        border-color: #dc3545;
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.2);
    }

    .avatar-circle {
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid rgba(46, 204, 113, 0.5);
    }
</style>
