<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>লগইন | মন্ত্রিপরিষদ বিভাগ</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'Hind Siliguri', sans-serif;
            overflow: hidden;
        }

        /* Background with Overlay */
        .bg-wrapper {
            background-image: url('{{ asset('images/government-bg.png') }}');
            background-size: cover;
            background-position: center;
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

        /* Glassmorphism Login Card */
        .login-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
            color: white;
            animation: fadeInScale 0.8s ease-out;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 10px;
            padding: 12px 15px;
            margin-bottom: 5px;
        }

        .form-control:focus {
            background: #ffffff;
            box-shadow: 0 0 15px rgba(46, 204, 113, 0.4);
            border-color: #2ecc71;
        }

        .btn-login {
            background: #2ecc71;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 700;
            color: white;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-login:hover {
            background: #27ae60;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(46, 204, 113, 0.4);
        }

        .brand-logo {
            width: 60px;
            margin-bottom: 15px;
            filter: drop-shadow(0 0 8px rgba(255, 255, 255, 0.5));
        }

        .forgot-link {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            transition: color 0.3s;
        }

        .forgot-link:hover {
            color: #2ecc71;
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .input-group-text {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 10px 0 0 10px;
            color: #555;
        }

        .has-icon .form-control {
            border-radius: 0 10px 10px 0;
        }
    </style>
</head>

<body>

    <div class="bg-wrapper">
        <div class="bg-overlay"></div>
    </div>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="login-card col-11 col-sm-8 col-md-6 col-lg-4">

            <div class="text-center mb-4">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="brand-logo">
                <h3 class="fw-bold m-0">সিস্টেম লগইন</h3>
                <p class="small opacity-75 mt-1">মন্ত্রিপরিষদ বিভাগ</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger py-2 small border-0"
                    style="border-radius: 10px; background: rgba(220, 53, 69, 0.8); color: white;">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label small fw-bold">ইমেইল ঠিকানা</label>
                    <div class="input-group has-icon">
                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email') }}" required autofocus placeholder="example@mail.com">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label small fw-bold">পাসওয়ার্ড</label>
                    <div class="input-group has-icon">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" required
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label small" for="remember">মনে রাখুন</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link text-decoration-none">পাসওয়ার্ড
                            ভুলে গেছেন?</a>
                    @endif
                </div>

                <button type="submit" class="btn btn-login shadow-sm">
                    প্রবেশ করুন <i class="fa fa-sign-in-alt ms-2"></i>
                </button>
            </form>

            <div class="text-center mt-4 pt-2 border-top border-secondary border-opacity-25">
                <p class="small mb-0">অ্যাকাউন্ট নেই? <a href="{{ route('register') }}"
                        class="text-decoration-none fw-bold" style="color: #2ecc71;">নিবন্ধন করুন</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
