<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>নিবন্ধন | মন্ত্রিপরিষদ বিভাগ</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'Hind Siliguri', sans-serif;
            overflow-x: hidden;
        }

        /* Background Wrapper */
        .bg-wrapper {
            background: url('{{ asset('images/government-bg.png') }}') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            width: 100vw;
            position: fixed;
            z-index: -1;
        }

        .bg-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.7) 100%);
        }

        /* Glassmorphism Card */
        .register-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
            color: white;
            animation: fadeInScale 0.6s ease-out;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 10px;
            padding: 10px 15px;
        }

        .form-control:focus {
            background: #ffffff;
            box-shadow: 0 0 15px rgba(46, 204, 113, 0.4);
            border-color: #2ecc71;
        }

        .input-group-text {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 10px 0 0 10px;
            color: #555;
            width: 45px;
            justify-content: center;
        }

        .btn-register {
            background: #2ecc71;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 700;
            color: white;
            width: 100%;
            transition: 0.3s;
        }

        .btn-register:hover {
            background: #27ae60;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(46, 204, 113, 0.3);
        }

        .brand-logo {
            width: 60px;
            filter: drop-shadow(0 0 8px rgba(255, 255, 255, 0.4));
        }

        .login-link {
            color: #2ecc71;
            font-weight: 600;
            text-decoration: none;
        }

        .login-link:hover {
            text-decoration: underline;
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</head>

<body>

    <div class="bg-wrapper">
        <div class="bg-overlay"></div>
    </div>

    <div class="container d-flex align-items-center justify-content-center min-vh-100 py-5">

        <div class="register-card col-11 col-sm-9 col-md-7 col-lg-5">

            <div class="text-center mb-4">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="brand-logo mb-2">
                <h3 class="fw-bold m-0">নতুন অ্যাকাউন্ট তৈরি করুন</h3>
                <p class="small opacity-75">মন্ত্রিপরিষদ বিভাগ তথ্য বাতায়ন</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger py-2 small border-0 mb-4"
                    style="border-radius: 10px; background: rgba(220, 53, 69, 0.8); color: white;">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label small fw-bold">পূর্ণ নাম</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required
                            autofocus placeholder="আপনার নাম লিখুন">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold">ইমেইল ঠিকানা</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required
                            placeholder="example@mail.com">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label small fw-bold">পাসওয়ার্ড</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" name="password" required placeholder="••••••••">
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label small fw-bold">নিশ্চিত করুন</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-check-double"></i></span>
                            <input type="password" class="form-control" name="password_confirmation" required
                                placeholder="••••••••">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-register shadow-sm mb-3">
                    নিবন্ধন সম্পন্ন করুন <i class="fa fa-user-plus ms-2"></i>
                </button>

                <div class="text-center">
                    <span class="small opacity-75">পূর্বেই অ্যাকাউন্ট আছে?</span>
                    <a href="{{ route('login') }}" class="login-link small">লগইন করুন</a>
                </div>
            </form>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
