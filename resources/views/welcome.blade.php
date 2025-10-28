<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BookTrack — Login</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logo.svg') }}">
</head>

<body>
    <div class="container d-flex flex-column justify-content-center align-items-center min-vh-100 px-3">

        <!-- Logo -->
        <div class="mb-4">
            <img src="{{ asset('logo.svg') }}" alt="logo" style="height: 6em;">
        </div>

        <!-- Login Card -->
        <div class="card p-4 w-100" style="max-width: 400px;">
            <h2 class="h5 text-center mb-3 booktrack-title">BENVINGUT A LA MEVA BIBLIOTECA</h2>

            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Username</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}"
                        required autofocus>
                    @error('email')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                    @error('password')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">
                        Remember me
                    </label>
                </div>

                <!-- Actions -->
                <button type="submit" class="btn btn-booktrack w-100 mb-2">Log in</button>

                <!-- Register Link -->
                @if (Route::has('register'))
                    <p class="text-center mt-3 small">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-decoration-none fw-bold text-primary">
                            Register
                        </a>
                    </p>
                @endif
            </form>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>