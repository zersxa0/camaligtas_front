<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Disaster Risk Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
    <style>
        body {
            background: #e9ecef; /* simple gray */
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
            color: #e53935; /* red */
        }
        .title-camaligtas .tas {
            color: #43a047; /* green */
        }
        .login-container {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
            border: 1px solid #f1f1f1;
            max-width: 400px;
            margin: 0 auto;
            padding: 2.5rem 2rem 2rem 2rem;
        }
        .login-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .login-header h2 {
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
        .btn-login {
            background: linear-gradient(90deg, #e53935 0%, #fff 100%);
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
        .btn-login:hover {
            background: linear-gradient(90deg, #b71c1c 0%, #fff 100%);
            color: #e53935;
        }
        .role-dropdown {
            margin-bottom: 1.2rem;
        }
        .alert {
            border-radius: 12px;
            border: none;
        }
        .footer-text {
            text-align: center;
            color: #6c757d;
            font-size: 0.85rem;
            margin-top: 1.5rem;
        }
        .signup-link {
            text-align: center;
            margin-top: 0rem;
        }
        @media (max-width: 576px) {
            .login-container {
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
    <!-- Title outside the form -->
    <div class="title-camaligtas"><br>
        <span class="camalig">Camalig</span><span class="tas">tas</span>
    </div>
    <div class="login-container my-3">
        <!-- Login Header inside the form -->
        <div class="login-header">
            <h2>Login</h2>
            <p class="mb-0" style="font-size: 1rem; color: #888;">Disaster Risk Dashboard</p>
        </div>
        <!-- Login Form -->
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

        <form method="POST" action="{{ route('login') }}" id="loginForm" onsubmit="return customLogin(event)">
            @csrf

            <!-- Role Dropdown -->
            <div class="role-dropdown">
                <label for="roleSelect" class="form-label"><i class="fas fa-user-tag me-2"></i>Select Role</label>
                <select class="form-select" id="roleSelect" name="role" required onchange="toggleSignupLink()">
                    <option value="" selected disabled>Select your role</option>
                    <option value="superadmin">Super Admin</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            
            <!-- Username -->
            <div class="form-floating">
                <input type="text" class="form-control @error('username') is-invalid @enderror" 
                       id="username" name="username" placeholder="Username" value="{{ old('username') }}" required>
                <label for="username">
                    <i class="fas fa-user me-2"></i>Username
                </label>
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Password -->
            <div class="form-floating">
                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                       id="password" name="password" placeholder="Password" required>
                <label for="password">
                    <i class="fas fa-lock me-2"></i>Password
                </label>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Remember Me -->
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">
                    Remember me for 30 days
                </label>
            </div>
            
            <!-- Login Button -->
            <button type="submit" class="btn btn-login" id="loginBtn">
                <i class="fas fa-sign-in-alt me-2"></i> Access Dashboard
            </button>
            
        </form>
        
        <!-- Sign Up Link for User -->
        <div class="signup-link" id="signupLink" style="display:none;">
            <span>Don't have an account? <a href="{{ route('register') }}">Sign up here</a></span>
        </div>
        
        <!-- Footer -->
        <div class="footer-text">
            <i class="fas fa-info-circle me-1"></i>
            Emergency Hotline: <strong>911</strong> | Barangay Office: <strong>(052) XXX-XXXX</strong>
            <br><small class="text-muted">© 2025 Barangay Ilawod Emergency Management System</small>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSignupLink() {
            const role = document.getElementById('roleSelect').value;
            document.getElementById('signupLink').style.display = (role === 'user') ? 'block' : 'none';
        }

        // Custom login for demo
        function customLogin(e) {
            e.preventDefault();
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value;
            const role = document.getElementById('roleSelect').value;

            if (role === 'superadmin' && username === 'superadmin@gmail.com' && password === 'adminpass') {
                window.location.href = "{{ route('hazard.home') }}";
                return false;
            }
            if (role === 'admin' && username === 'admin@gmail.com' && password === 'adminpass') {
                window.location.href = "{{ route('hazard.home') }}";
                return false;
            }
            if (role === 'user' && username === 'sarah@gmail.com' && password === '123') {
                window.location.href = "/user/user-dashboard";
                return false;
            }
            if (role === 'user') {
                alert('Please sign up if you do not have an account, or log in if you already have one.');
                return false;
            }
            alert('Invalid credentials. Try the correct email and password for your role.');
            return false;
        }
    </script>
</body>
</html>