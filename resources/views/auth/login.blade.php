<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('/css/styles.css')}}">
</head>
<body class="login-page">
  <div class="login-container">
    <div class="login-box d-flex flex-column flex-md-row">
      <div class="login-image"></div>

      <div class="login-form">
        <div class="text-center mb-4">
          <img src="{{asset('/images/ac.png')}}" alt="Welcome Icon" class="img-fluid" style="width: 170px; height: 170px;">
          <h2>Welcome <br> to your <span style="color:#ddad27;">AdvisorMate!</span></h2>
        </div>

        <form>
          <div class="mb-2">
            <label for="role" class="form-label">Select your role</label>
            <select id="role" class="form-select" required>
              <option value="" disabled selected>Select your role</option>
              <option value="Student">Student</option>
              <option value="Advisor">Advisor</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-envelope"></i></span>
              <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
            </div>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-lock"></i></span>
              <input type="password" class="form-control" id="password" placeholder="Enter your password" required>
              <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                <i class="fas fa-eye"></i>
              </span>
            </div>
          </div>

          <button type="submit" class="btn btn-primary mt-4">Login</button>
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
