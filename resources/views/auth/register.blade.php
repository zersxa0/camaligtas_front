<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Disaster Risk Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
    <style>
        body {
            background: rgb(248, 248, 248);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .title-camaligtas {
            font-family: 'Lobster', cursive;
            font-size: 4.2rem;
            font-weight: bold;
            margin-bottom: 0rem;
            letter-spacing: 2px;
            text-align: center;
            margin-top: -80px;
        }
        .title-camaligtas .camalig {
            color: #e53935;
        }
        .title-camaligtas .tas {
            color: #43a047;
        }
        .register-container {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
            border: 1px solid #f1f1f1;
            max-width: 500px;
            margin: 0 auto;
            padding: 2.5rem 2rem 2rem 2rem;
        }
        .register-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .register-header h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 0.5rem;
        }
        .form-floating {
            margin-bottom: 1.2rem;
        }
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 0.75rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #e53935;
            box-shadow: 0 0 0 0.2rem rgba(229,57,53,0.10);
        }
        .btn-register {
            background: rgb(175, 62, 60);
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
            box-shadow: 0 2px 8px rgba(229,57,53,0.10);
        }
        .btn-register:hover {
            background: rgb(124, 36, 35);
            color:rgb(255, 255, 255);
        }
        .footer-text {
            text-align: center;
            color: #6c757d;
            font-size: 0.85rem;
            margin-top: 1.5rem;
        }
        .login-link {
            text-align: center;
            margin-top: 1rem;
        }
        #passcodeBox {
            text-align: center;
            font-size: 1.1rem;
        }
        @media (max-width: 576px) {
            .register-container {
                max-width: 98vw;
                padding: 1rem;
            }
            .title-camaligtas {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>
    <div class="title-camaligtas"><br>
        <span class="camalig">Camalig</span><span class="tas">tas</span>
    </div>
    <div class="register-container my-3">
        <div class="register-header">
            <h2>Register</h2>
            <p class="mb-0" style="font-size: 1rem; color: #888;">Disaster Risk Dashboard</p>
        </div>
        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle me-2"></i>
                {{ session('error') }}
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif
        
<form id="registerForm" method="POST" action="{{ route('register.submit') }}">
    @csrf
    <div class="form-floating">
        <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" required 
               minlength="3" pattern="[A-Za-z ]{3,}">
        <label for="name"><i class="fas fa-user me-2"></i>Full Name</label>
        <div class="form-text text-muted small">
            Enter your full name (minimum 3 characters, letters only)
        </div>
    </div>
    <div class="form-floating">
        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
        <label for="email"><i class="fas fa-envelope me-2"></i>Email Address</label>
        <div class="form-text text-muted small">
            This email will be used for login and account recovery
        </div>
    </div>
    <div class="form-floating">
        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone Number" required
               pattern="[0-9]{11}" maxlength="11">
        <label for="phone"><i class="fas fa-phone me-2"></i>Phone Number</label>
        <div class="form-text text-muted small">
            Enter 11-digit phone number (e.g., 09123456789)
        </div>
    </div>
    <div class="form-floating">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required 
               minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
        <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
        <div class="form-text text-muted small">
            Password must be at least 8 characters long, contain uppercase, lowercase and numbers
        </div>
    </div>
    <div class="form-floating">
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" 
               placeholder="Confirm Password" required>
        <label for="password_confirmation"><i class="fas fa-lock me-2"></i>Confirm Password</label>
    </div>
    <button type="submit" class="btn btn-register" id="submitBtn">
        <i class="fas fa-user-plus me-2"></i>Create Account
    </button>
</form>

<!-- Passcode Modal -->
<div class="modal fade" id="passcodeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="passcodeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="passcodeModalLabel">
                    <i class="fas fa-key me-2"></i>Your Login Passcode
                </h5>
            </div>
            <div class="modal-body text-center">
                <div class="mb-4">
                    <i class="fas fa-check-circle text-success" style="font-size: 3rem;"></i>
                    <h4 class="mt-3">Registration Successful!</h4>
                    <p class="text-muted">Save your login passcode below:</p>
                </div>
                
                <div class="passcode-display" id="passcodeDisplay"></div>
                
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Important:</strong> Write down this passcode! You'll need it to log in.
                </div>
                
                <div class="d-grid gap-2">
                    <button class="btn btn-outline-primary" id="copyPasscode">
                        <i class="fas fa-copy me-2"></i>Copy Passcode
                    </button>
                    <a href="{{ route('login') }}" class="btn btn-success">
                        <i class="fas fa-sign-in-alt me-2"></i>Proceed to Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

        <div id="passcodeBox" class="alert alert-info mt-3 d-none"></div>
        <div class="login-link">
            <span>Already have an account? <a href="{{ route('login') }}">Login here</a></span>
        </div>
        <div class="footer-text">
            <i class="fas fa-info-circle me-1"></i>
            Emergency Hotline: <strong>911</strong> | Barangay Office: <strong>(052) XXX-XXXX</strong>
            <br><small class="text-muted">© 2025 Barangay Ilawod Emergency Management System</small>
        </div>
    </div>

    <!-- Add Bootstrap JS and its dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const password = document.getElementById('password').value;
    const passwordConfirm = document.getElementById('password_confirmation').value;
    const phone = document.getElementById('phone').value;
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    
    // Validate full name
    if (!/^[A-Za-z ]{3,}$/.test(name)) {
        showError('Please enter a valid full name (letters only, minimum 3 characters)');
        return;
    }

    // Validate email
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        showError('Please enter a valid email address');
        return;
    }

    // Validate phone number
    if (!/^09\d{9}$/.test(phone)) {
        showError('Please enter a valid 11-digit phone number starting with 09');
        return;
    }

    // Validate password
    if (password !== passwordConfirm) {
        showError('Passwords do not match!');
        return;
    }

    if (!/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/.test(password)) {
        showError('Password must be at least 8 characters long and contain uppercase, lowercase, and numbers');
        return;
    }
    
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Creating Account...';
    
    const formData = new FormData(this);
    
    fetch('{{ route("register.submit") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': formData.get('_token'),
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            name: name,
            email: email,
            phone: phone,
            password: password,
            password_confirmation: passwordConfirm
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Store user data for login
            sessionStorage.setItem('registered_user', JSON.stringify({
                name: name,
                email: email,
                phone: phone,
                password: password, // In production, this should be handled differently
                passcode: data.passcode
            }));
            
            // Display passcode
            document.getElementById('passcodeDisplay').textContent = data.passcode;
            const passcodeModal = new bootstrap.Modal(document.getElementById('passcodeModal'));
            passcodeModal.show();
        } else {
            throw new Error(data.message || 'Registration failed');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showError(error.message || 'An error occurred during registration. Please try again.');
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-user-plus me-2"></i>Create Account';
    });
});

function showError(message) {
    // Create or get error alert
    let errorAlert = document.querySelector('.register-error-alert');
    if (!errorAlert) {
        errorAlert = document.createElement('div');
        errorAlert.className = 'alert alert-danger mt-3 register-error-alert';
        errorAlert.innerHTML = '<i class="fas fa-exclamation-triangle me-2"></i><span></span>';
        document.getElementById('registerForm').insertAdjacentElement('beforebegin', errorAlert);
    }
    
    // Show error message
    errorAlert.querySelector('span').textContent = message;
    errorAlert.classList.remove('d-none');

    // Hide error after 5 seconds
    setTimeout(() => {
        errorAlert.classList.add('d-none');
            }, 5000);
}
    });

    document.getElementById('copyPasscode').addEventListener('click', function() {
    const passcode = document.getElementById('passcodeDisplay').textContent;
    navigator.clipboard.writeText(passcode).then(() => {
        this.innerHTML = '<i class="fas fa-check me-2"></i>Passcode Copied!';
        this.classList.add('btn-success');
        this.classList.remove('btn-outline-primary');
        
        setTimeout(() => {
            this.innerHTML = '<i class="fas fa-copy me-2"></i>Copy Passcode';
            this.classList.remove('btn-success');
            this.classList.add('btn-outline-primary');
        }, 2000);
    });
});

// Format phone number input
document.getElementById('phone').addEventListener('input', function(e) {
    let value = this.value.replace(/\D/g, '');
    if (value.length > 0 && !value.startsWith('09')) {
        value = '09' + value.substring(2);
    }
    this.value = value.substring(0, 11);
});
    </script>
</body>
</html>