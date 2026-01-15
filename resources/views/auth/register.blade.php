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

        .register-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        /* Govt Style Register Card */
        .register-card {
            background: #ffffff;
            border-top: 5px solid #006a4e;
            border-radius: 8px;
            padding: 2.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 550px;
            /* Registration needs slightly more width */
            animation: fadeIn 0.6s ease-out;
        }

        .brand-logo {
            width: 70px;
            height: auto;
            margin-bottom: 15px;
        }

        .register-title {
            color: #006a4e;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .form-label {
            color: #444;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .form-control {
            border: 1px solid #ced4da;
            padding: 10px;
            border-radius: 4px;
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: #006a4e;
            box-shadow: 0 0 0 0.25rem rgba(0, 106, 78, 0.15);
        }

        .input-group-text {
            background-color: #f8f9fa;
            color: #006a4e;
            border: 1px solid #ced4da;
        }

        /* Button - Govt Green */
        .btn-register {
            background-color: #006a4e;
            border: none;
            color: white;
            padding: 12px;
            font-weight: 700;
            width: 100%;
            border-radius: 4px;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .btn-register:hover {
            background-color: #00523d;
            box-shadow: 0 4px 12px rgba(0, 106, 78, 0.2);
        }

        .login-link {
            color: #f42a41;
            font-weight: 700;
            text-decoration: none;
        }

        .login-link:hover {
            text-decoration: underline;
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
            background: #222;
            color: #bbb;
            padding: 15px 0;
            font-size: 0.85rem;
            text-align: center;
            margin-top: -50px;
        }
    </style>
</head>

<body>
    <div class="top-stripe"></div>

    <div class="register-container">
        <div class="register-card">
            <div class="text-center mb-4">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="brand-logo">
                <h3 class="register-title">নতুন অ্যাকাউন্ট তৈরি করুন</h3>
                <p class="text-muted small">মন্ত্রিপরিষদ বিভাগ তথ্য বাতায়ন</p>
                <hr style="width: 50px; margin: 10px auto; border-top: 3px solid #f42a41;">
            </div>

            @if ($errors->any())
                <div class="alert alert-danger py-2 small border-0 shadow-sm mb-4"
                    style="background-color: #fff5f5; color: #c53030;">
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
                    <label class="form-label">পূর্ণ নাম(ইংরেজি)</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" name="name_eng" value="{{ old('name_eng') }}"
                            required autofocus placeholder="আপনার নাম লিখুন">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">পূর্ণ নাম(বাংলা)</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" name="name_ban" value="{{ old('name_ban') }}"
                            required autofocus placeholder="আপনার নাম লিখুন">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">মোবাইল(বাংলা)</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" name="mobile" value="{{ old('mobile') }}" required
                            autofocus placeholder="আপনার মোবাইল নম্বর লিখুন">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">ইমেইল ঠিকানা</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required
                            placeholder="example@mail.com">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">পাসওয়ার্ড</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" name="password" required placeholder="••••••••">
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label">পাসওয়ার্ড নিশ্চিত করুন</label>
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

                <div class="text-center mt-3 pt-3 border-top">
                    <span class="small text-muted">পূর্বেই অ্যাকাউন্ট আছে?</span>
                    <a href="{{ route('login') }}" class="login-link small">লগইন করুন</a>
                </div>
            </form>
        </div>
    </div>

    <footer class="text-center">
        <div class="container">
            &copy; {{ date('Y') }} মন্ত্রিপরিষদ বিভাগ | কারিগরি সহায়তায়: মো: এবাদুল হক রুবেল
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
