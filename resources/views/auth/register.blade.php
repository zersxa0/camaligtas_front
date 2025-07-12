
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration - Camaligtas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        .bg-image {
            position: fixed;
            top: 0; left: 0;
            width: 100vw; height: 100vh;
            object-fit: cover;
            z-index: -2;
            filter: blur(5px) brightness(0.7);
        }
        .bg-overlay {
            position: fixed;
            top: 0; left: 0;
            width: 100vw; height: 100vh;
            background: rgba(44,44,44,0.3);
            z-index: -1;
        }
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent;
        }
        .register-container {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
            max-width: 520px;
            padding: 2.5rem 2rem;
            z-index: 1;
        }
        .register-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .register-header h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #333;
        }
        .form-row {
            display: flex;
            gap: 1rem;
        }
        .form-row .form-floating {
            flex: 1;
        }
        .form-floating {
            margin-bottom: 1.2rem;
        }
        .btn-register {
            background: #4caf50;
            border: none;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            color: #fff;
            width: 100%;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .btn-register:hover {
            background: #388e3c;
        }
        .login-link {
            text-align: center;
            margin-top: 1rem;
        }
        /* Modal styles */
        .modal-backdrop.show {
            opacity: 0.5;
        }
        .modal-content {
            border-radius: 16px;
        }
        @media (max-width: 600px) {
            .form-row {
                flex-direction: column;
                gap: 0;
            }
            .register-container {
                max-width: 98vw;
                padding: 1.2rem 0.5rem;
            }
        }
    </style>
</head>
<body>
    <img src="{{ asset('assets/img/register-bg.png') }}" alt="Background" class="bg-image">
    <div class="bg-overlay"></div>
    <div class="register-container">
        <div class="register-header">
            <h2>Register as User</h2>
            <p style="font-size: 1rem; color: #888;">Create your account</p>
        </div>
        <form id="registerForm" onsubmit="return handleRegister(event)">
            <div class="form-row">
                <div class="form-floating">
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" required>
                    <label for="first_name"><i class="fas fa-user me-2"></i>First Name</label>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" required>
                    <label for="last_name"><i class="fas fa-user me-2"></i>Last Name</label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-floating">
                    <input type="number" min="1" class="form-control" id="age" name="age" placeholder="Age" required>
                    <label for="age"><i class="fas fa-calendar me-2"></i>Age</label>
                </div>
                <div class="form-floating">
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="" disabled selected>Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                    <label for="gender"><i class="fas fa-venus-mars me-2"></i>Gender</label>
                </div>
            </div>
            <div class="form-floating">
                <input type="tel" class="form-control" id="contact" name="contact" placeholder="Contact Number" pattern="[0-9]{11}" required>
                <label for="contact"><i class="fas fa-phone me-2"></i>Contact Number</label>
            </div>
            <div class="form-row">
                <div class="form-floating">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                    <label for="confirm_password"><i class="fas fa-lock me-2"></i>Confirm Password</label>
                </div>
            </div>
            <button type="submit" class="btn btn-register" id="registerBtn">
                <i class="fas fa-user-plus me-2"></i>Register
            </button>
        </form>
        <div class="login-link">
            <a href="{{ url('login') }}" style="color: #e53935; text-decoration: underline; font-size: 0.95rem;">Back to Login</a>
        </div>
    </div>

    <!-- OTP Modal -->
    <div class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="otpModalLabel">OTP Verification</h5>
          </div>
          <div class="modal-body">
            <p>Enter the OTP sent to your number.</p>
            <input type="text" class="form-control mb-3" id="otpInput" placeholder="Enter OTP" required>
            <div id="otpError" class="text-danger" style="display:none;">Invalid OTP. Please try again.</div>
            <div class="text-muted" style="font-size:0.95rem;">(For testing, use <b>123</b>)</div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" onclick="verifyOTP()">Verify</button>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function handleRegister(event) {
            event.preventDefault();
            const password = document.getElementById('password').value;
            const confirm = document.getElementById('confirm_password').value;
            if (password !== confirm) {
                alert('Passwords do not match!');
                return false;
            }
            // Show OTP modal
            var otpModal = new bootstrap.Modal(document.getElementById('otpModal'));
            otpModal.show();
            window.currentOtpModal = otpModal;
            return false;
        }

        function verifyOTP() {
            const otp = document.getElementById('otpInput').value;
            const otpError = document.getElementById('otpError');
            if (otp === '123') {
                otpError.style.display = 'none';
                window.currentOtpModal.hide();
                alert('OTP Verified! Registration Complete.');
                window.location.href = "{{ url('login') }}";
            } else {
                otpError.style.display = 'block';
            }
        }
    </script>
</body>
</html>