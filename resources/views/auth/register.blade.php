{{-- resources/views/auth/register.blade.php --}}

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register — BookShelf</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.svg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f7f4ff;
            font-family: 'Segoe UI', sans-serif;
        }

        .card {
            border-radius: 1rem;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .brand {
            color: #6f42c1;
            font-weight: bold;
        }

        .form-control:focus {
            border-color: #6f42c1;
            box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, .25);
        }

        .btn-primary {
            background-color: #6f42c1;
            border-color: #6f42c1;
        }

        .btn-primary:hover {
            background-color: #5a35a3;
            border-color: #5a35a3;
        }

        .link-purple {
            color: #6f42c1;
        }

        .link-purple:hover {
            color: #5a35a3;
        }
    </style>
</head>

<body>

    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="col-md-7 col-lg-5">
            <div class="card p-4">
                <h2 class="text-center mb-4 brand">Create your account</h2>
                <p class="text-center text-muted mb-4">Register to start organizing and tracking your favorite books easily.</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- Name --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="username">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Birth Date --}}
                    <div class="mb-3">
                        <label for="birth_date" class="form-label">Birth Date</label>
                        <input id="birth_date" type="date" class="form-control" name="birth_date" value="{{ old('birth_date') }}" required autocomplete="bday">
                        @error('birth_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        @error('password_confirmation')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="{{ route('welcome') }}" class="link-purple small">Already registered? Log in</a>
                        <button type="submit" class="btn btn-primary px-4">Register</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</body>

</html>
