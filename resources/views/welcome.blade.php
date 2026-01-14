<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'মন্ত্রিপরিষদ বিভাগ') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'Hind Siliguri', sans-serif;
            background: url('{{ asset('images/government-bg.png') }}') no-repeat center center fixed;
            background-size: cover;
        }

        /* Modern Glassmorphism Overlay */
        .overlay {
            background: radial-gradient(circle, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.7) 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .welcome-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
            animation: fadeInUp 1s ease-out;
        }

        .logo-img {
            width: 70px;
            height: auto;
            filter: drop-shadow(0 0 10px rgba(255, 255, 255, 0.3));
        }

        .btn-custom {
            padding: 10px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-login {
            background-color: #ffffff;
            color: #1a1a1a;
        }

        .btn-login:hover {
            background-color: #2ecc71;
            color: white;
            transform: scale(1.05);
        }

        .btn-reg {
            border: 2px solid #ffffff;
            color: white;
        }

        .btn-reg:hover {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            transform: scale(1.05);
        }

        footer {
            background: rgba(36, 35, 35, 0.5);
            backdrop-filter: blur(5px);
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <div class="overlay">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 text-center">

                    <div class="welcome-card text-white">
                        <div class="mb-4">
                            <img src="{{ asset('images/logo.png') }}" alt="Government Logo" class="logo-img mb-3">
                            <h1 class="fw-bold" style="letter-spacing: 2px;">মন্ত্রিপরিষদ বিভাগ</h1>
                            <div style="height: 3px; width: 60px; background: #2ecc71; margin: 15px auto;"></div>
                        </div>

                        <h2 class="mb-4 fw-bold lh-base">
                            ১০-২০তম গ্রেডের কর্মকর্তা-কর্মচারিদের তথ্য বাতায়ন
                        </h2>

                        <p class="mb-5 opacity-75 fs-5">
                            মন্ত্রিপরিষদ বিভাগে কর্মরত কর্মকর্তা-কর্মচারিদের তথ্য সুশৃঙ্খলভাবে সংরক্ষণ,
                            তৎক্ষণাৎ হালনাগাদ এবং উন্নত ব্যবস্থাপনার একটি সমন্বিত ডিজিটাল প্ল্যাটফর্ম।
                        </p>

                        <div class="d-flex justify-content-center gap-4 flex-wrap">
                            @auth
                                <a href="{{ route('dashboard') }}" class="btn btn-login btn-custom shadow">ড্যাশবোর্ড</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-login btn-custom shadow">লগইন</a>
                                <a href="{{ route('register') }}" class="btn btn-reg btn-custom">নিবন্ধন</a>
                            @endauth
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <footer class="py-4 text-center fixed-bottom">
        <div class="container">
            <p class="mb-1 fw-semibold">&copy; {{ date('Y') }} মন্ত্রিপরিষদ বিভাগ, আইসিটি সেল | গণপ্রজাতন্ত্রী
                বাংলাদেশ সরকার</p>
            <p class="mb-0 small opacity-75">
                বাংলাদেশ সচিবালয়, ঢাকা-১০০০ | ফোন: +৮৮০-২-৯৫৫৫০০০ | ইমেইল: info@cabinet.gov.bd
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
