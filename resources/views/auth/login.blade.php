<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  @if (app()->getLocale() == 'en')
  <link rel="stylesheet" href="{{asset('/css/styles.css')}}">
  @else
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('/css/styles.css')}}">
  <link rel="stylesheet" href="{{asset('/css/style-ar.css')}}">
  @endif
  
  @if (app()->getLocale() == 'ar')
  <style>
    .input-group-text i {
      transform: scaleX(-1);
    }
    .form-label {
      text-align: right;
    }
    .login-form {
      text-align: right;
    }
    .input-group > :not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
      margin-left: -1px;
      border-top-left-radius: 0.375rem;
      border-bottom-left-radius: 0.375rem;
      border-top-right-radius: 0;
      border-bottom-right-radius: 0;
    }
    .input-group:not(.has-validation) > :not(:last-child):not(.dropdown-toggle):not(.dropdown-menu):not(.form-floating) {
      border-top-right-radius: 0.375rem;
      border-bottom-right-radius: 0.375rem;
      border-top-left-radius: 0;
      border-bottom-left-radius: 0;
    }
  </style>
  @endif
</head>
<body class="login-page">
  <div class="login-container">
    <div class="login-box d-flex flex-column flex-md-row">
      <div class="login-image"></div>

      <div class="login-form">
        <div class="text-center mb-4">
          <img src="{{asset('/images/ac.png')}}" alt="Welcome Icon" class="img-fluid" style="width: 170px; height: 170px;">
          <h2>{{trans('site.login.welcome')}} <br> {{trans('site.login.to_your')}} <span style="color:#ddad27;">{{trans('site.sidebar.logo')}}</span></h2>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="mb-2">
            <label for="role" class="form-label">{{trans('site.login.select_role')}}</label>
            <select id="role" name="role" class="form-select @error('role') is-invalid @enderror" required>
              <option value="" disabled selected>{{trans('site.login.select_role')}}</option>
              <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>{{trans('site.login.student')}}</option>
              <option value="advisor" {{ old('role') == 'advisor' ? 'selected' : '' }}>{{trans('site.login.advisor')}}</option>
            </select>
            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">{{trans('site.login.email')}}</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-envelope"></i></span>
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" placeholder="{{trans('site.login.email_placeholder')}}" required>
              @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">{{trans('site.login.password')}}</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-lock"></i></span>
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="{{trans('site.login.password_placeholder')}}" required>
              <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                <i class="fas fa-eye"></i>
              </span>
              @error('password')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">{{trans('site.login.remember_me')}}</label>
          </div>

          <div>
            <a href="{{ app()->getLocale()  == 'ar' ? '/en' :  '/ar'}}"> {{ app()->getLocale() == 'ar' ? 'English' : 'العربية' }} </a>
          </div>

          <button type="submit" class="btn btn-primary mt-4 w-100">{{trans('site.login.login_button')}}</button>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const togglePassword = document.querySelector('#togglePassword');
      const password = document.querySelector('#password');

      togglePassword.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);

        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
      });
    });
  </script>
</body>
</html>

