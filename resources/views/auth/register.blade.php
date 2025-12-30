<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - মন্ত্রিপরিষদ বিভাগ</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Full-page background */
        body,
        html {
            height: 100%;
            margin: 0;
            background: url('images/government-bg.png') no-repeat center center fixed;
            background-size: cover;
        }

        /* Overlay card */
        .overlay-card {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 2rem;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body>
    <div class="d-flex align-items-center justify-content-center min-vh-100">

        <!-- Registration Card -->
        <div class="overlay-card">
            <h2 class="text-center mb-4 fw-bold">Register</h2>

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required autofocus>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        required>
                </div>

                <!-- Footer -->
                <div class="d-flex justify-content-between align-items-center">
                    <a href="#" class="text-decoration-underline text-muted">Already registered?</a>
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
        </div>

    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
