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
            background-color: #f4f7f6;
            background-image: url("https://www.transparenttextures.com/patterns/cubes.png");
        }

        /* Top Bar Flag Style */
        .top-stripe {
            height: 5px;
            background: linear-gradient(90deg, #006a4e 50%, #f42a41 50%);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Govt Style Login Card */
        .login-card {
            background: #ffffff;
            border-top: 5px solid #006a4e;
            border-radius: 8px;
            padding: 2.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            animation: fadeIn 0.6s ease-out;
        }

        .brand-logo {
            width: 80px;
            height: auto;
            margin-bottom: 15px;
        }

        .login-title {
            color: #006a4e;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .form-label {
            color: #444;
            font-weight: 600;
        }

        .form-control {
            border: 1px solid #ced4da;
            padding: 12px;
            border-radius: 4px;
        }

        .form-control:focus {
            border-color: #006a4e;
            box-shadow: 0 0 0 0.25rem rgba(0, 106, 78, 0.15);
        }

        /* Button - Govt Green */
        .btn-login {
            background-color: #006a4e;
            border: none;
            color: white;
            padding: 12px;
            font-weight: 700;
            width: 100%;
            border-radius: 4px;
            transition: all 0.3s;
        }

        .btn-login:hover {
            background-color: #00523d;
            box-shadow: 0 4px 12px rgba(0, 106, 78, 0.2);
        }

        .input-group-text {
            background-color: #f8f9fa;
            color: #006a4e;
            border: 1px solid #ced4da;
        }

        .forgot-link {
            color: #f42a41;
            font-size: 0.9rem;
            text-decoration: none;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .register-link {
            color: #006a4e;
            font-weight: 700;
            text-decoration: none;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background: #222;
            color: #bbb;
            padding: 10px 0;
            font-size: 0.85rem;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="top-stripe"></div>

    <div class="login-container">
        <div class="login-card">
            <div class="text-center mb-4">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="brand-logo">
                <h3 class="login-title">সিস্টেম লগইন</h3>
                <p class="text-muted small">মন্ত্রিপরিষদ বিভাগ, বাংলাদেশ সচিবালয়</p>
                <hr style="width: 50px; margin: 10px auto; border-top: 3px solid #f42a41;">
            </div>

            @if ($errors->any())
                <div class="alert alert-danger py-2 small border-0 shadow-sm"
                    style="background-color: #fff5f5; color: #c53030;">
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
                    <label for="email" class="form-label small">ইমেইল ঠিকানা</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email') }}" required autofocus placeholder="আপনার ইমেইল">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label small">পাসওয়ার্ড</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" required
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label small text-muted" for="remember">মনে রাখুন</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">পাসওয়ার্ড ভুলে গেছেন?</a>
                    @endif
                </div>

                <button type="submit" class="btn btn-login shadow-sm mb-3">
                    প্রবেশ করুন <i class="fa fa-sign-in-alt ms-2"></i>
                </button>
            </form>

            <div class="text-center mt-3 pt-3 border-top">
                <p class="small text-muted mb-0">অ্যাকাউন্ট নেই?
                    <a href="{{ route('register') }}" class="register-link">নিবন্ধন করুন</a>
                </p>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            &copy; {{ date('Y') }} মন্ত্রিপরিষদ বিভাগ | কারিগরি সহায়তায়: মো: এবাদুল হক রুবেল
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
