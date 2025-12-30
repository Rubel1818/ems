<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Full page background */
        body,
        html {
            height: 100%;
            margin: 0;
            background: url('{{ asset('images/government-bg.png') }}') no-repeat center center fixed;
            background-size: cover;
        }

        /* Overlay to make text readable */
        .overlay {
            background-color: rgba(0, 0, 0, 0.6);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .card-body {
            border-radius: 15px;
            padding: 2rem;
        }
    </style>
</head>

<body>

    <!-- Overlay container -->
    <div class="overlay">

        <!-- Card content -->
        <div class="card-body text-center text-white" style="max-width: 900px;">

            <!-- Header Logo & Title -->
            <div class="mb-4 d-flex justify-content-center align-items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Government Logo" style="width:50px; height:auto;"
                    class="me-3">
                <h2 class="fw-bold mb-0">মন্ত্রিপরিষদ বিভাগ</h2>
            </div>

            <!-- Main Content -->
            <h3 class="mb-3 fw-bold">
                মন্ত্রিপরিষদ বিভাগে কর্মরত ১০-২০তম গ্রেডের কর্মকর্তা-কর্মচারিদের তথ্য বাতায়ন
            </h3>

            <p class="mb-4">
                এই সিস্টেমের মাধ্যমে মন্ত্রিপরিষদ বিভাগে কর্মরত ১০-২০তম গ্রেডের কর্মকর্তা-কর্মচারিদের তথ্য সংরক্ষণ,
                হালনাগাদ এবং ব্যবস্থাপনা করা যাবে।
            </p>



            <!-- Login / Register Buttons -->
            <div class="mt-4 d-flex justify-content-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-light btn-sm">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-light btn-sm">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-light btn-sm">Register</a>
                @endauth
            </div>

        </div>

    </div>

    <!-- Footer -->
    <footer class="bg-secondary text-white mt-0 pt-4 pb-3">
        <div class="container text-center">
            <p class="mb-1">&copy; {{ date('Y') }} মন্ত্রিপরিষদ বিভাগ, আইসিটি সেল. সর্বস্বত্ব সংরক্ষিত।</p>
            <p class="mb-0">
                সচিবালয়, ঢাকা-১০০০, বাংলাদেশ | ফোন: +880-2-9555000
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
