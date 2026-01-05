<nav class="col-md-3 col-lg-2 d-md-block sidebar shadow-lg" id="sidebarMenu">
    <div class="sidebar-sticky pt-4 px-3">

        <div class="user-info text-center mb-4 pb-4 border-bottom border-secondary border-opacity-25">
            <div class="avatar-circle mx-auto mb-2">
                <i class="bi bi-person-circle text-white-50 fs-1"></i>
            </div>
            <h6 class="text-white small mb-0">{{ Auth::user()->name }}</h6>
            <span class="badge bg-success" style="font-size: 0.6rem;">অনলাইন</span>
        </div>

        <ul class="nav flex-column gap-2">

            @role('admin|employee')
                @if (!request()->routeIs('employees.create'))
                    <li class="nav-item">
                        <a class="nav-link custom-link" href="{{ route('employees.create') }}">
                            <i class="bi bi-plus-circle-fill me-2"></i>
                            <span>নতুন যোগ করুন</span>
                        </a>
                    </li>
                @endif
            @endrole

            <li class="nav-item">
                <a class="nav-link custom-link {{ request()->routeIs('profile.*') ? 'active' : '' }}"
                    href="{{ route('profile.edit') }}">
                    <i class="bi bi-person-fill me-2"></i>
                    <span>প্রোফাইল</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link custom-link" href="#">
                    <i class="bi bi-gear-fill me-2"></i>
                    <span>সেটিংস</span>
                </a>
            </li>

            <li class="nav-item mt-4 pt-4 border-top border-secondary border-opacity-25">
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
