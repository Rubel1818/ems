<nav class="col-md-3 col-lg-2 d-md-block sidebar p-3">
    <h4 class="text-white mb-4 text-center">User Dashboard</h4>

    <ul class="nav flex-column gap-2">
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="bi bi-person me-2"></i> Profile
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="bi bi-gear me-2"></i> Settings
            </a>
        </li>
        <li class="nav-item mt-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-light w-100">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </button>
            </form>
        </li>
    </ul>
</nav>
