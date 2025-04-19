<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Login - Admin Smart Trash</title>
    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/logo.png') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f5f5f9; font-family: 'Public Sans', sans-serif; }
        .login-container { min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-card { max-width: 400px; width: 100%; padding: 2rem; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        .green { color: #07AE67; }
        .yellow { color: #FFC630; }
        .btn-primary { background-color: #07AE67; border-color: #07AE67; }
        .btn-primary:hover { background-color: #059c57; border-color: #059c57; }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card bg-white">
            <div class="text-center mb-4">
                <img src="{{ asset('assets/img/Smart_Trash.png') }}" alt="Logo Smart Trash" width="50">
                <h4 class="mt-2">
                    <span class="green">Smart</span>
                    <span class="yellow">Trash</span> - Login
                </h4>
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3 position-relative">
    <label for="password" class="form-label">Password</label>
    <div class="input-group">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        <span class="input-group-text" style="cursor: pointer; background: none; border-left: 0;">
            <img id="togglePassword" src="{{ asset('assets/img/vieww.png') }}" alt="Toggle Password" width="20" />
        </span>
    </div>
    @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Remember Me
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary w-100">
                        Login
                    </button>
                </div>
                @if (Route::has('password.request'))
                    <div class="text-center">
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');
    let isPasswordVisible = false;

    togglePassword.addEventListener('click', function () {
        isPasswordVisible = !isPasswordVisible;
        passwordField.type = isPasswordVisible ? 'text' : 'password';
        togglePassword.src = isPasswordVisible 
            ? "{{ asset('assets/img/hide.png') }}" 
            : "{{ asset('assets/img/vieww.png') }}";
    });
</script>



</body>
</html>