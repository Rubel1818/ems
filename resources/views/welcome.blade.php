<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <!-- 🔷 Header -->
    <nav class="navbar navbar-dark bg-secondary py-3">
        <div class="container">
            <div class="header">
                <img src="{{ asset('images/logo.png') }}" alt="Government Logo" style="width:50px; height:auto;">

                <span class="navbar-brand mx-auto fw-bold">
                    মন্ত্রিপরিষদ বিভাগ
                </span>
            </div>
            <!-- Login / Register -->
            <div class="d-flex">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-light btn-sm ms-2">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-light btn-sm ms-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-light btn-sm ms-2">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- 🔷 Body -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">

                <div class="text-white"
                    style="background: url('{{ asset('images/government-bg.jpg') }}') no-repeat center center; 
                        background-size: cover; 
                        border-radius: 15px;">

                    <!-- Optional overlay for better readability -->
                    <div class="card-body p-5" style="border-radius: 15px;">
                        <h3 class="mb-3 fw-bold">
                            মন্ত্রিপরিষদ বিভাগের কর্মকর্তা কর্মচারিদের তথ্য বাতায়ন
                        </h3>

                        <p class="text-light mb-4">
                            এই সিস্টেমের মাধ্যমে কর্মকর্তা ও কর্মচারীদের তথ্য সংরক্ষণ,
                            হালনাগাদ এবং ব্যবস্থাপনা করা যাবে।
                        </p>

                        <p class="text-light">
                            <strong>মন্ত্রিপরিষদ বিভাগ, বাংলাদেশ:</strong>
                            এটি বাংলাদেশের কেন্দ্রীয় প্রশাসনিক বিভাগ যা নীতি নির্ধারণ,
                            সরকারি কর্মচারীদের নিয়ন্ত্রণ এবং সরকারি কার্যক্রমের সমন্বয় নিশ্চিত করে।
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
<footer class="bg-secondary text-white mt-5 pt-4 pb-3">
    <div class="container text-center">
        <div class="row">
            <div class="col-md-12">
                <p class="mb-1">&copy; {{ date('Y') }} মন্ত্রিপরিষদ বিভাগ, বাংলাদেশ. সর্বস্বত্ব সংরক্ষিত।</p>
                <p class="mb-0">
                    সচিবালয়, ঢাকা-১০০০, বাংলাদেশ |
                    ফোন: +880-2-9555000
                </p>
            </div>
        </div>
    </div>
</footer>

</html>
