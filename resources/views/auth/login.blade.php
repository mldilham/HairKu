<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="HairKu - Login">
    <title>Login - HairKu</title>

    <!-- Google Fonts - Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-orange: #F97316;
            --primary-orange-hover: #EA580C;
            --light-bg: #F8F9FA;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
        }

        .btn-primary {
            background-color: var(--primary-orange);
            border-color: var(--primary-orange);
            font-weight: 600;
            padding: 12px 28px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--primary-orange-hover);
            border-color: var(--primary-orange-hover);
        }

        .form-control:focus {
            border-color: var(--primary-orange);
            box-shadow: 0 0 0 0.25rem rgba(249, 115, 22, 0.25);
        }

        .form-check-input:checked {
            background-color: var(--primary-orange);
            border-color: var(--primary-orange);
        }

        .text-primary-custom {
            color: var(--primary-orange) !important;
        }

        .bg-primary-custom {
            background-color: var(--primary-orange) !important;
        }

        .login-card {
            background: white;
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
        }

        .brand-logo {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #F97316 0%, #FB923C 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #9CA3AF;
        }

        .form-control {
            padding-left: 45px;
            border-radius: 10px;
            padding: 12px 16px;
        }

        .login-image {
            background: linear-gradient(135deg, #F97316 0%, #FB923C 100%);
            border-radius: 20px;
            height: 100%;
            min-height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container-fluid vh-100">
        <div class="row h-100 align-items-center justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="login-card overflow-hidden">
                    <div class="row g-0">
                        <!-- Form Section -->
                        <div class="col-lg-7">
                            <div class="p-5 p-lg-5">
                                <div class="text-center mb-4">
                                    <a href="/" class="d-flex align-items-center justify-content-center mb-4 text-decoration-none">
                                        <div class="brand-logo me-2">
                                            <i class="bi bi-scissors text-white fs-4"></i>
                                        </div>
                                        <span class="fw-bold fs-3 text-dark">HairKu</span>
                                    </a>
                                    <h4 class="fw-bold">Selamat Datang</h4>
                                    <p class="text-muted">Masuk ke akun Anda</p>
                                </div>

                                <!-- Session Status -->
                                @if (session('status'))
                                    <div class="alert alert-success mb-4">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <!-- Email -->
                                    <div class="mb-4">
                                        <label for="email" class="form-label fw-semibold">Email</label>
                                        <div class="position-relative">
                                            <i class="bi bi-envelope input-icon"></i>
                                            <input type="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   id="email"
                                                   name="email"
                                                   value="{{ old('email') }}"
                                                   required
                                                   autofocus
                                                   placeholder="Masukkan email Anda">
                                        </div>
                                        @error('email')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Password -->
                                    <div class="mb-4">
                                        <label for="password" class="form-label fw-semibold">Password</label>
                                        <div class="position-relative">
                                            <i class="bi bi-lock input-icon"></i>
                                            <input type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   id="password"
                                                   name="password"
                                                   required
                                                   autocomplete="current-password"
                                                   placeholder="Masukkan password">
                                        </div>
                                        @error('password')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Remember Me -->
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                                            <label class="form-check-label text-muted" for="remember_me">
                                                Ingat saya
                                            </label>
                                        </div>
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" class="text-primary-custom text-decoration-none small">
                                                Lupa password?
                                            </a>
                                        @endif
                                    </div>

                                    <!-- Submit -->
                                    <button type="submit" class="btn btn-primary w-100 py-3">
                                        <i class="bi bi-box-arrow-in-right me-2"></i> Masuk
                                    </button>
                                </form>

                                <!-- Register Link -->
                                <div class="text-center mt-4">
                                    <p class="text-muted mb-0">
                                        Belum punya akun?
                                        <a href="{{ route('register') }}" class="text-primary-custom fw-semibold text-decoration-none">
                                            Daftar Sekarang
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Image Section -->
                        <div class="col-lg-5 d-none d-lg-block">
                            <div class="login-image p-5 text-center">
                                <i class="bi bi-scissors fs-1 mb-4" style="font-size: 4rem;"></i>
                                <h3 class="fw-bold mb-3">Tampilan Baru,<br>Percaya Diri Baru</h3>
                                <p class="mb-0" style="opacity: 0.9;">Booking barber terbaik dengan mudah</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
