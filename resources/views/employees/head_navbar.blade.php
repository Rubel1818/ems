<nav class="navbar navbar-expand-lg sticky-top shadow-sm" style="background: #2c3e50; border-bottom: 3px solid #2ecc71;">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" height="40" class="d-inline-block align-top me-2">
            <div class="d-flex flex-column">
                <span class="text-white fw-bold fs-5 lh-1">মন্ত্রিপরিষদ বিভাগ</span>
                <small class="text-white-50" style="font-size: 0.7rem;">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</small>
            </div>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
            data-bs-target="#cabinetNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="cabinetNavbar">
            <ul class="navbar-nav align-items-center">



                <li class="nav-item dropdown ms-lg-3">
                    <a class="nav-link dropdown-toggle d-flex align-items-center bg-white bg-opacity-10 rounded-pill px-3 py-1"
                        href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle text-white me-2 fs-5"></i>
                        <span class="text-white small fw-semibold">{{ Auth::user()->name }}</span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 animate slideIn"
                        aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item py-2" href="{{ route('profile.edit') }}">
                                <i class="bi bi-person me-2 text-primary"></i> প্রোফাইল
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item py-2 text-danger" type="submit">
                                    <i class="bi bi-box-arrow-right me-2"></i> লগআউট
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    /* Custom Styling for Lucrative Look */
    .navbar .nav-link {
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .hover-white:hover {
        color: #fff !important;
    }

    .dropdown-menu {
        border-radius: 12px;
        min-width: 180px;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #2ecc71;
    }

    /* Simple Animation */
    @media (min-width: 992px) {
        .animate {
            animation-duration: 0.3s;
            -webkit-animation-duration: 0.3s;
            animation-fill-mode: both;
            -webkit-animation-fill-mode: both;
        }
    }

    @keyframes slideIn {
        0% {
            transform: translateY(1rem);
            opacity: 0;
        }

        100% {
            transform: translateY(0rem);
            opacity: 1;
        }
    }

    .slideIn {
        animation-name: slideIn;
    }
</style>
