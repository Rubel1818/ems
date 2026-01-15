<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <title>মন্ত্রিপরিষদ বিভাগ | কর্মচারীদের তথ্য বাতায়ন</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'Hind Siliguri', sans-serif;
            /* সরকারি ওয়েবসাইটের স্ট্যান্ডার্ড হালকা গ্রে ব্যাকগ্রাউন্ড */
            background-color: #f4f7f6;
            background-image: url("https://www.transparenttextures.com/patterns/cubes.png");
        }

        /* Top Bar with Flag Colors */
        .top-stripe {
            height: 5px;
            background: linear-gradient(90deg, #006a4e 50%, #f42a41 50%);
        }

        .overlay {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding-bottom: 100px;
            /* Space for footer */
        }

        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            padding: 40px 0;
        }

        .welcome-card {
            background: #ffffff;
            border-top: 5px solid #006a4e;
            /* সবুজ বর্ডার */
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.8s ease-in;
        }

        .logo-img {
            width: 90px;
            height: auto;
            margin-bottom: 20px;
        }

        .gov-title {
            color: #006a4e;
            font-weight: 700;
            margin-bottom: 10px;
            border-bottom: 2px solid #eee;
            padding-bottom: 15px;
        }

        .sub-title {
            color: #444;
            font-weight: 600;
            margin-top: 20px;
        }

        .description {
            color: #666;
            line-height: 1.8;
            font-size: 1.1rem;
            max-width: 800px;
            margin: 0 auto 30px;
        }

        /* Button Styling - Govt Theme */
        .btn-custom {
            padding: 12px 35px;
            border-radius: 4px;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-login {
            background-color: #006a4e;
            color: white;
            border: none;
        }

        .btn-login:hover {
            background-color: #00523d;
            color: white;
            box-shadow: 0 4px 12px rgba(0, 106, 78, 0.3);
        }

        .btn-reg {
            background-color: #f42a41;
            color: white;
            border: none;
        }

        .btn-reg:hover {
            background-color: #d12235;
            color: white;
            box-shadow: 0 4px 12px rgba(244, 42, 65, 0.3);
        }

        footer {
            background: #222;
            color: #eee;
            width: 100%;
            padding: 25px 0;
            border-top: 4px solid #f42a41;
        }

        .footer-text {
            font-size: 0.95rem;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="top-stripe"></div>

    <div class="overlay">
        <div class="main-content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 text-center">

                        <div class="welcome-card">
                            <img src="{{ asset('images/logo.png') }}" alt="Government Logo" class="logo-img">

                            <h1 class="gov-title">মন্ত্রিপরিষদ বিভাগ</h1>
                            <p class="text-muted mb-4">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</p>

                            <h2 class="sub-title mb-3">
                                ১০-২০তম গ্রেডের কর্মকর্তা-কর্মচারিদের তথ্য বাতায়ন
                            </h2>

                            <p class="description">
                                মন্ত্রিপরিষদ বিভাগে কর্মরত কর্মকর্তা-কর্মচারিদের তথ্য সুশৃঙ্খলভাবে সংরক্ষণ,
                                তৎক্ষণাৎ হালনাগাদ এবং উন্নত ব্যবস্থাপনার একটি সমন্বিত ডিজিটাল প্ল্যাটফর্ম।
                            </p>

                            <div class="d-flex justify-content-center gap-3 flex-wrap mt-4">
                                @auth
                                    <a href="{{ route('dashboard') }}"
                                        class="btn btn-login btn-custom shadow-sm">ড্যাশবোর্ড</a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-login btn-custom shadow-sm">লগইন করুন</a>
                                    <a href="{{ route('register') }}" class="btn btn-reg btn-custom shadow-sm">নতুন
                                        নিবন্ধন</a>
                                @endauth
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center">
        <div class="container">
            <p class="mb-1 footer-text">&copy; {{ date('Y') }} মন্ত্রিপরিষদ বিভাগ | সর্বস্বত্ব সংরক্ষিত</p>
            <p class="mb-2 small opacity-75">
                বাংলাদেশ সচিবালয়, ঢাকা-১০০০ | ফোন: +৮৮০-২-৯৫৫৫০০০ | ইমেইল: info@cabinet.gov.bd
            </p>
            <div style="height: 1px; background: #444; width: 200px; margin: 10px auto;"></div>
            <p class="mb-0 small" style="color: #bbb;">
                ডেভেলপ করেছেন : <strong>মো: এবাদুল হক রুবেল</strong>, সহকারী প্রোগ্রামার, মন্ত্রিপরিষদ বিভাগ
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
