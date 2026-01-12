@include('employees.header') {{-- Your existing header with Bootstrap & CSS --}}

<div class="container-fluid">
    <div class="row">
        @include('employees.sidebar')

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4" style="background: #f4f7fa; min-height: 100vh;">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold text-dark"><i class="bi bi-person-gear me-2"></i>প্রোফাইল সেটিংস</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboardView') }}">ড্যাশবোর্ড</a></li>
                        <li class="breadcrumb-item active">প্রোফাইল</li>
                    </ol>
                </nav>
            </div>

            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i> {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="card shadow-sm border-0 rounded-3">
                        <div class="card-header bg-white py-3 border-bottom">
                            <h6 class="mb-0 fw-bold text-primary">ব্যক্তিগত তথ্য আপডেট করুন</h6>
                            <small class="text-muted">আপনার অ্যাকাউন্টের প্রোফাইল তথ্য এবং ইমেল ঠিকানা আপডেট
                                করুন।</small>
                        </div>
                        <div class="card-body p-4">
                            <form method="post" action="{{ route('profile.update') }}">
                                @csrf
                                @method('patch')

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">নাম (Name)</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $user->name) }}" required autocomplete="name">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">ইমেল ঠিকানা (Email)</label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-4">সংরক্ষণ করুন</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-4">
                    <div class="card shadow-sm border-0 rounded-3 border-top border-4 border-success">
                        <div class="card-body text-center py-4">
                            <div class="avatar-circle-lg mx-auto mb-3 bg-light text-success d-flex align-items-center justify-content-center"
                                style="width: 80px; height: 80px; border-radius: 50%;">
                                <i class="bi bi-shield-lock fs-1"></i>
                            </div>
                            <h5 class="fw-bold mb-1">{{ Auth::user()->name }}</h5>
                            <p class="text-muted small mb-3">{{ Auth::user()->email }}</p>

                            <div class="d-flex flex-wrap justify-content-center gap-2">
                                @foreach (Auth::user()->getRoleNames() as $role)
                                    <span
                                        class="badge bg-success text-capitalize p-2 px-3 shadow-sm">{{ $role }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 mb-4">
                    <div class="card shadow-sm border-0 rounded-3">
                        <div class="card-header bg-white py-3 border-bottom">
                            <h6 class="mb-0 fw-bold text-primary">পাসওয়ার্ড পরিবর্তন করুন</h6>
                            <small class="text-muted">নিরাপত্তার জন্য দীর্ঘ এবং এলোমেলো পাসওয়ার্ড ব্যবহার নিশ্চিত
                                করুন।</small>
                        </div>
                        <div class="card-body p-4">
                            <form method="post" action="{{ route('password.update') }}">
                                @csrf
                                @method('put')

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">বর্তমান পাসওয়ার্ড</label>
                                    <input type="password" name="current_password"
                                        class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                                        autocomplete="current-password">
                                    @error('current_password', 'updatePassword')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">নতুন পাসওয়ার্ড</label>
                                    <input type="password" name="password"
                                        class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                                        autocomplete="new-password">
                                    @error('password', 'updatePassword')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">পাসওয়ার্ড নিশ্চিত করুন</label>
                                    <input type="password" name="password_confirmation"
                                        class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                                        autocomplete="new-password">
                                    @error('password_confirmation', 'updatePassword')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-dark px-4">পাসওয়ার্ড আপডেট করুন</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 mb-5">
                    <div class="card shadow-sm border-0 rounded-3 border-start border-4 border-danger">
                        <div
                            class="card-body p-4 d-flex justify-content-between align-items-center bg-danger bg-opacity-10">
                            <div>
                                <h6 class="mb-1 fw-bold text-danger">অ্যাকাউন্ট মুছে ফেলুন</h6>
                                <p class="text-muted small mb-0">একবার আপনার অ্যাকাউন্ট মুছে ফেলা হলে, এর সমস্ত তথ্য
                                    স্থায়ীভাবে মুছে যাবে।</p>
                            </div>
                            <button class="btn btn-danger px-4 shadow-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteAccountModal">
                                অ্যাকাউন্ট মুছুন
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form method="post" action="{{ route('profile.destroy') }}" class="p-4">
                @csrf
                @method('delete')

                <h5 class="fw-bold text-danger mb-3">আপনি কি নিশ্চিত?</h5>
                <p class="text-muted mb-4">
                    আপনার অ্যাকাউন্ট মুছে ফেলার আগে, অনুগ্রহ করে আপনার পাসওয়ার্ড লিখুন নিশ্চিত করার জন্য যে আপনি এটি
                    করতে চান।
                </p>

                <div class="mb-4">
                    <input type="password" name="password"
                        class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                        placeholder="আপনার পাসওয়ার্ড দিন" required>
                    @error('password', 'userDeletion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">বাতিল করুন</button>
                    <button type="submit" class="btn btn-danger px-4">স্থায়ীভাবে মুছে ফেলুন</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Ensure you have Bootstrap Bundle JS for Modals and Tabs --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
