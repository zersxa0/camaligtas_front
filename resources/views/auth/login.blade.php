
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
        .btn-login:hover {
            background: rgb(124, 36, 35);
            color:rgb(255, 255, 255);
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
    <div class="title-camaligtas"><br>
        <span class="camalig">Camalig</span><span class="tas">tas</span>
    </div>
    <div class="login-container my-3">
        <div class="login-header">
            <h2>Login</h2>
            <p class="mb-0" style="font-size: 1rem; color: #888;">Sign In to your account</p>
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
        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle me-2"></i>
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}" id="loginForm" onsubmit="return handleLogin(event)">
            @csrf
            <div class="role-dropdown">
                <label for="roleSelect" class="form-label"><i class="fas fa-user-tag me-2"></i>Select Role</label>
                <select class="form-select" id="roleSelect" name="role" required>
                    <option value="" selected disabled>Select your role</option>
                    <option value="superadmin" {{ old('role') === 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User</option>
                </select>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control @error('username') is-invalid @enderror" 
                       id="username" name="username" placeholder="Username" value="{{ old('username') }}" required>
                <label for="username">
                    <i class="fas fa-user me-2"></i>Username or Email
                </label>
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
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
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">
                    Remember me for 30 days
                </label>
            </div>
            <button type="submit" class="btn btn-login" id="loginBtn">
                <i class="fas fa-sign-in-alt me-2"></i> Access Dashboard
            </button>
        </form>
        <div class="footer-text">
            <i class="fas fa-info-circle me-1"></i>
            Emergency Hotline: <strong>911</strong> | Barangay Office: <strong>(052) XXX-XXXX</strong>
            <br><small class="text-muted">© 2025 Barangay Ilawod Emergency Management System</small>
        </div>
    </div>

    <!-- Sign Up Modal -->
    <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="signupModalLabel"><i class="fas fa-user-plus me-2"></i>Sign Up</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center">
            <p>Don't have an account? Sign up now to access the dashboard.</p>
            <a href="{{ route('register') }}" class="btn btn-success">
            
                <i class="fas fa-user-plus me-2"></i>Go to Sign Up
            </a>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
function handleLogin(event) {
    const role = document.getElementById('roleSelect').value;
    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value;

    // Superadmin
    if (role === 'superadmin' && username === 'superadmin@gmail.com' && password === 'superadmin123') {
        event.preventDefault();
        document.getElementById('loginBtn').innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Accessing Dashboard...';
        setTimeout(() => {
            window.location.href = '/superadmin/manage_users';
        }, 1000);
        return false;
    }

    // Admin
    if (role === 'admin' && username === 'admin@gmail.com' && password === 'admin123') {
        event.preventDefault();
        document.getElementById('loginBtn').innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Accessing Dashboard...';
        setTimeout(() => {
            window.location.href = '/admin/dashboard';
        }, 1000);
        return false;
    }

    // User
    if (role === 'user' && username === 'sarah@gmail.com' && password === 'sarah123') {
        event.preventDefault();
        document.getElementById('loginBtn').innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Accessing Dashboard...';
        setTimeout(() => {
            window.location.href = '/user/dashboard';
        }, 1000);
        return false;
    }

    // For all other credentials, allow normal form submission (if you want)
    return true;
}

// Show sign up modal when "User" is selected
document.getElementById('roleSelect').addEventListener('change', function() {
    if (this.value === 'user') {
        var signupModal = new bootstrap.Modal(document.getElementById('signupModal'));
        signupModal.show();
    }
});
</script>
</body>
</html>