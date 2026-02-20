<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="HairKu - Daftar">
    <title>Daftar - HairKu</title>

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

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-orange);
            box-shadow: 0 0 0 0.25rem rgba(249, 115, 22, 0.25);
        }

        .text-primary-custom {
            color: var(--primary-orange) !important;
        }

        .bg-primary-custom {
            background-color: var(--primary-orange) !important;
        }

        .register-card {
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

        .form-control, .form-select {
            padding-left: 45px;
            border-radius: 10px;
            padding: 12px 16px;
        }

        .register-image {
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

        .role-option {
            border: 2px solid #E5E7EB;
            border-radius: 12px;
            padding: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .role-option:hover {
            border-color: var(--primary-orange);
            background-color: #FFF7ED;
        }

        .role-option.selected {
            border-color: var(--primary-orange);
            background-color: #FFF7ED;
        }

        .role-option i {
            font-size: 2rem;
            color: var(--primary-orange);
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
    <div class="container-fluid vh-100">
        <div class="row h-100 align-items-center justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="register-card overflow-hidden">
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
                                    <h4 class="fw-bold">Buat Akun</h4>
                                    <p class="text-muted">Daftar dan mulai booking</p>
                                </div>

                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <!-- Name -->
                                    <div class="mb-3">
                                        <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                                        <div class="position-relative">
                                            <i class="bi bi-person input-icon"></i>
                                            <input type="text"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   id="name"
                                                   name="name"
                                                   value="{{ old('name') }}"
                                                   required
                                                   autofocus
                                                   placeholder="Masukkan nama lengkap">
                                        </div>
                                        @error('name')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Role -->
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Daftar sebagai</label>
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <label class="role-option w-100" for="role_user">
                                                    <i class="bi bi-person-fill d-block"></i>
                                                    <span class="fw-semibold">Pelanggan</span>
                                                    <input type="radio" name="role" id="role_user" value="user" class="d-none" {{ old('role') == 'user' ? 'checked' : '' }}>
                                                </label>
                                            </div>
                                            <div class="col-6">
                                                <label class="role-option w-100" for="role_barber">
                                                    <i class="bi bi-scissors d-block"></i>
                                                    <span class="fw-semibold">Barber</span>
                                                    <input type="radio" name="role" id="role_barber" value="barber" class="d-none" {{ old('role') == 'barber' ? 'checked' : '' }}>
                                                </label>
                                            </div>
                                        </div>
                                        @error('role')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Phone -->
                                    <div class="mb-3">
                                        <label for="phone" class="form-label fw-semibold">Nomor Telepon</label>
                                        <div class="position-relative">
                                            <i class="bi bi-phone input-icon"></i>
                                            <input type="text"
                                                   class="form-control @error('phone') is-invalid @enderror"
                                                   id="phone"
                                                   name="phone"
                                                   value="{{ old('phone') }}"
                                                   required
                                                   placeholder="Masukkan nomor telepon">
                                        </div>
                                        @error('phone')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label fw-semibold">Email</label>
                                        <div class="position-relative">
                                            <i class="bi bi-envelope input-icon"></i>
                                            <input type="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   id="email"
                                                   name="email"
                                                   value="{{ old('email') }}"
                                                   required
                                                   placeholder="Masukkan email">
                                        </div>
                                        @error('email')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Password -->
                                    <div class="mb-3">
                                        <label for="password" class="form-label fw-semibold">Password</label>
                                        <div class="position-relative">
                                            <i class="bi bi-lock input-icon"></i>
                                            <input type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   id="password"
                                                   name="password"
                                                   required
                                                   autocomplete="new-password"
                                                   placeholder="Masukkan password">
                                        </div>
                                        @error('password')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="mb-4">
                                        <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password</label>
                                        <div class="position-relative">
                                            <i class="bi bi-lock-fill input-icon"></i>
                                            <input type="password"
                                                   class="form-control @error('password_confirmation') is-invalid @enderror"
                                                   id="password_confirmation"
                                                   name="password_confirmation"
                                                   required
                                                   autocomplete="new-password"
                                                   placeholder="Konfirmasi password">
                                        </div>
                                        @error('password_confirmation')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Submit -->
                                    <button type="submit" class="btn btn-primary w-100 py-3">
                                        <i class="bi bi-person-plus me-2"></i> Daftar
                                    </button>
                                </form>

                                <!-- Login Link -->
                                <div class="text-center mt-4">
                                    <p class="text-muted mb-0">
                                        Sudah punya akun?
                                        <a href="{{ route('login') }}" class="text-primary-custom fw-semibold text-decoration-none">
                                            Login
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Image Section -->
                        <div class="col-lg-5 d-none d-lg-block">
                            <div class="register-image p-5 text-center">
                                <i class="bi bi-scissors fs-1 mb-4" style="font-size: 4rem;"></i>
                                <h3 class="fw-bold mb-3">Tampilan Baru,<br>Percaya Diri Baru</h3>
                                <p class="mb-0" style="opacity: 0.9;">Bergabung dengan komunitas barber terbaik</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Role selection styling
        document.querySelectorAll('.role-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.role-option').forEach(o => o.classList.remove('selected'));
                this.classList.add('selected');
            });
        });

        // Set initial state
        @if(old('role'))
            document.querySelectorAll('.role-option').forEach(o => o.classList.remove('selected'));
            @if(old('role') == 'user')
                document.getElementById('role_user').closest('.role-option').classList.add('selected');
            @else
                document.getElementById('role_barber').closest('.role-option').classList.add('selected');
            @endif
        @endif
    </script>
</body>
</html>
