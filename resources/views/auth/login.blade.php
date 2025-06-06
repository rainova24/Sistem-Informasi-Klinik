<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login Page</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Background image style -->
  <style>
    body {
      background-image: url('img/background.jpg'); /* Ganti dengan path ke gambar yang kamu punya */
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
    }
    
    /* Style untuk validasi */
    .validation-message {
      font-size: 12px;
      margin-top: 5px;
      display: none;
      color: #e74a3b;
    }
    
    .requirements-list {
      list-style-type: none;
      padding-left: 10px;
      margin-top: 5px;
      font-size: 12px;
      display: none;
    }
    
    .requirements-list li.valid {
      color: #1cc88a;
    }
    
    .requirements-list li.invalid {
      color: #e74a3b;
    }
  </style>

</head>

<body>
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Silahkan login terlebih dahulu</h1>
                  </div>
                  <form class="user" method="POST" action="{{ route('login') }}"
                    enctype="application/x-www-form-urlencoded" id="loginForm">
                    @csrf
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror"
                        name="email" id="email" value="{{ old('email') }}" required autocomplete="email"
                        placeholder="Email Address">
                      <div id="emailValidationMessage" class="validation-message"></div>
                      @error('email')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <input type="password"
                        class="form-control form-control-user @error('password') is-invalid @enderror" name="password"
                        id="password" required autocomplete="current-password" placeholder="Password">
                      <div id="passwordValidationMessage" class="validation-message"></div>
                      <ul id="passwordRequirements" class="requirements-list">
                        <li id="length" class="invalid">Minimal 8 karakter</li>
                        <li id="uppercase" class="invalid">Minimal 1 huruf besar</li>
                        <li id="lowercase" class="invalid">Minimal 1 huruf kecil</li>
                        <li id="number" class="invalid">Minimal 1 angka</li>
                        <li id="symbol" class="invalid">Minimal 1 simbol</li>
                      </ul>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" name="remember" class="custom-control-input" id="customCheck"
                          {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="customCheck">Remember
                          Me</label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block" id="loginButton">
                      Login
                    </button>
                    <hr>
                  </form>
                  {{-- <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div> --}}
                  <div class="text-center">
                    <a class="small" href="{{ route('register') }}">Create an Account!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  
  <!-- Validasi Form Login -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const emailInput = document.getElementById('email');
      const passwordInput = document.getElementById('password');
      const loginButton = document.getElementById('loginButton');
      const emailValidationMessage = document.getElementById('emailValidationMessage');
      const passwordValidationMessage = document.getElementById('passwordValidationMessage');
      const passwordRequirements = document.getElementById('passwordRequirements');
      
      // Tampilkan persyaratan password saat input password difokuskan
      passwordInput.addEventListener('focus', function() {
        passwordRequirements.style.display = 'block';
      });
      
      // Sembunyikan persyaratan password saat klik di luar input
      document.addEventListener('click', function(event) {
        if (event.target !== passwordInput && !passwordRequirements.contains(event.target)) {
          passwordRequirements.style.display = 'none';
        }
      });
      
      // Validasi email
      function validateEmail(email) {
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return emailRegex.test(email);
      }
      
      // Validasi password
      function validatePassword(password) {
        // Cek panjang minimal 8 karakter
        const isLengthValid = password.length >= 8;
        document.getElementById('length').className = isLengthValid ? 'valid' : 'invalid';
        
        // Cek minimal 1 huruf besar
        const hasUppercase = /[A-Z]/.test(password);
        document.getElementById('uppercase').className = hasUppercase ? 'valid' : 'invalid';
        
        // Cek minimal 1 huruf kecil
        const hasLowercase = /[a-z]/.test(password);
        document.getElementById('lowercase').className = hasLowercase ? 'valid' : 'invalid';
        
        // Cek minimal 1 angka
        const hasNumber = /[0-9]/.test(password);
        document.getElementById('number').className = hasNumber ? 'valid' : 'invalid';
        
        // Cek minimal 1 simbol
        const hasSymbol = /[!@#$%^&*()_+\-=\[\]{};':"\\\/|,.<>\/?]/.test(password);
        document.getElementById('symbol').className = hasSymbol ? 'valid' : 'invalid';
        
        return isLengthValid && hasUppercase && hasLowercase && hasNumber && hasSymbol;
      }
      
      // Fungsi untuk sanitasi input (mencegah SQL injection)
      function sanitizeInput(input) {
        return input.replace(/[\\\"']/g, '');
      }
      
      // Event listener untuk input email
      emailInput.addEventListener('input', function() {
        const sanitizedValue = sanitizeInput(this.value);
        if (this.value !== sanitizedValue) {
          this.value = sanitizedValue;
        }
        
        if (!validateEmail(this.value) && this.value.length > 0) {
          emailValidationMessage.style.display = 'block';
          emailValidationMessage.textContent = 'Masukkan alamat email yang valid.';
        } else {
          emailValidationMessage.style.display = 'none';
        }
      });
      
      // Event listener untuk input password
      passwordInput.addEventListener('input', function() {
        const sanitizedValue = sanitizeInput(this.value);
        if (this.value !== sanitizedValue) {
          this.value = sanitizedValue;
        }
        
        validatePassword(this.value);
        
        if (!validatePassword(this.value) && this.value.length > 0) {
          passwordValidationMessage.style.display = 'block';
          passwordValidationMessage.textContent = 'Password tidak memenuhi persyaratan keamanan.';
        } else {
          passwordValidationMessage.style.display = 'none';
        }
      });
      
      // Validasi form sebelum submit
      document.getElementById('loginForm').addEventListener('submit', function(event) {
        const isEmailValid = validateEmail(emailInput.value);
        const isPasswordValid = validatePassword(passwordInput.value);
        
        if (!isEmailValid || !isPasswordValid) {
          event.preventDefault();
          
          if (!isEmailValid) {
            emailValidationMessage.style.display = 'block';
            emailValidationMessage.textContent = 'Masukkan alamat email yang valid.';
          }
          
          if (!isPasswordValid) {
            passwordValidationMessage.style.display = 'block';
            passwordValidationMessage.textContent = 'Password tidak memenuhi persyaratan keamanan.';
            passwordRequirements.style.display = 'block';
          }
        }
      });
    });
  </script>

</body>

</html>