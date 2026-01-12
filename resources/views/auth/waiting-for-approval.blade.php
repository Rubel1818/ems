<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waiting for Approval</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #f3f4f7;
            font-family: 'Inter', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .approval-card {
            background: #ffffff;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            max-width: 500px;
            width: 90%;
            text-align: center;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .icon-box {
            width: 80px;
            height: 80px;
            background: #fff4e5;
            color: #ff9800;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2.5rem;
            animation: pulse 2s infinite;
        }

        h1 {
            color: #1a202c;
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        p {
            color: #718096;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .btn-logout {
            background-color: #f8f9fa;
            color: #4a5568;
            border: 1px solid #e2e8f0;
            padding: 0.6rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            background-color: #edf2f7;
            color: #2d3748;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(255, 152, 0, 0.4);
            }

            70% {
                transform: scale(1.05);
                box-shadow: 0 0 0 15px rgba(255, 152, 0, 0);
            }

            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(255, 152, 0, 0);
            }
        }
    </style>
</head>

<body>

    <div class="approval-card">
        <div class="icon-box">
            <i class="bi bi-clock-history"></i>
        </div>
        <h1>একাউন্ট অনুমোদনের জন্য অপেক্ষারত</h1>
        <p>
            আপনার একাউন্ট সফলভাবে তৈরি হয়েছে এবং বর্তমানে <strong>অ্যাডমিনিস্ট্রেটর অনুমোদনের</strong> জন্য অপেক্ষা
            করছে।
            অনুমোদনের পর, আপনি ড্যাশবোর্ডের সম্পূর্ণ প্রবেশাধিকার পাবেন।
        </p>

        <div class="border-top pt-4">
            <p class="small mb-4">Need help? <a href="mailto:admin@example.com"
                    class="text-primary text-decoration-none">Contact Support</a></p>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="bi bi-box-arrow-left me-2"></i>Logout
                </button>
            </form>
        </div>
    </div>

</body>

</html>
