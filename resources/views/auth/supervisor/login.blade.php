<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('site.supervisor.login.title') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @if(app()->getLocale()=='en')
    <link rel="stylesheet" href="{{ asset('css/supervisor.css') }}">
    @else
    <link rel="stylesheet" href="{{ asset('css/supervisor.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    @endif

    <style>
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 2rem;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 10px;
            background-color: white;
        }
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .login-header i {
            font-size: 3rem;
            color: #0d6efd;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body class="{{ app()->getLocale() === 'ar' ? 'rtl font-cairo' : '' }}">
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <i class="fa-solid fa-user-shield"></i>
                <h2>{{ __('site.supervisor.login.title') }}</h2>
            </div>

            <form method="POST" action="{{ route('supervisor.login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('site.supervisor.login.email') }}</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                    id="email" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('site.supervisor.login.password') }}</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                    id="password" name="password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">
                        {{ __('site.supervisor.login.remember_me') }}
                    </label>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    {{ __('site.supervisor.login.submit') }}
                </button>
            </form>
        </div>
    </div>
</body>
</html> 