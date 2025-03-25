<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{asset('/css/styles.css')}}">
    @if (app()->getLocale() == 'ar')
    <link rel="stylesheet" href="{{asset('/css/style-ar.css')}}">
    @endif --}}
    <style>
        .login-container {
          display: flex;
          justify-content: center;
          align-items: center;
          height: 100vh;
          background: linear-gradient(110deg, #f2e5d5 50%, #ddad27 50%);
      }
      .login-box {
          width: 100%;
          max-width: 1400px;
          background-color: #fff;
          box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
          border-radius: 12px;
          padding: 40px 30px;
      }

      .illustration-container {
          display: flex;
          justify-content: center;
          align-items: center;
          height: 100%;
          padding: 20px 0;
      }

      .illustration-img {
          max-width: 600px;
          width: 100%;
          height: auto;
          object-fit: contain;
          display: block;
          margin: 0 auto;
      }

      @media (max-width: 768px) {
          .illustration-container {
              min-height: auto;
              padding: 0;
              margin-top: 40px;
          }
          .illustration-img {
              max-width: 220px;
          }
          .circular-photo {
              margin-top: 20px;
          }
          .login-box {
              padding: 20px 15px;
          }
      }
      
      @media (max-width: 576px) {
          .illustration-container {
              margin-top: 30px;
          }
          .illustration-img {
              max-width: 200px;
          }
      }
      .circular-photo {
          width: 100px;
          height: 100px;
          border-radius: 50%;
          margin-bottom: 20px;
      }

      .advisor-mate {
          color: #d4a017;
      }

      .btn-custom, .input-group-text {
          background-color: #ddad27;
          border-color: #ddad27;
          color: #ffffff;
      }

      @media (max-width: 768px) {
          .illustration-img {
              max-width: 220px;
          }
      }
      
      @media (max-width: 576px) {
          .illustration-img {
              max-width: 200px;
          }
      }
  </style>

</head>
<body>
    <div class="container-fluid login-container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 login-box">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="illustration-container">
                            <img src="{{asset('/images/image.png')}}" alt="Illustration" class="illustration-img">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <img src="{{asset('/images/ac.png')}}" alt="Circular Photo" class="circular-photo mx-auto d-block">
                        <h2 class="text-center">{{trans('site.login.welcome')}} <br> {{trans('site.login.to_your')}} <span class="advisor-mate">{{trans('site.sidebar.logo')}}</span></h2>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="role">{{trans('site.login.select_role')}}</label>
                                <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required>
                                    <option value="" disabled selected>{{trans('site.login.select_role')}}</option>
                                    <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>{{trans('site.login.student')}}</option>
                                    <option value="advisor" {{ old('role') == 'advisor' ? 'selected' : '' }}>{{trans('site.login.advisor')}}</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">{{trans('site.login.email')}}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" placeholder="{{trans('site.login.email_placeholder')}}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password">{{trans('site.login.password')}}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="{{trans('site.login.password_placeholder')}}" required>
                                    <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                      <i class="fas fa-eye"></i>
                                    </span>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-check d-flex align-items-center mt-3">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label ml-2" for="remember">{{trans('site.login.remember_me')}}</label>
                            </div>
                            <a href="{{ app()->getLocale() == 'ar' ? '/en' : '/ar' }}" class="d-block mt-2"> {{ app()->getLocale() == 'ar' ? 'English' : 'العربية' }} </a>
                            <button type="submit" class="btn btn-custom btn-block mt-3">{{trans('site.login.login_button')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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

