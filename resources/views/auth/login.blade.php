<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Disaster Risk Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">

    <style>
        #bgVideo {
            position: fixed;
            top: 0;
            left: 0;
            min-width: 100%;
            min-height: 100%;
            object-fit: cover;
            z-index: -2;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(44, 44, 44, 0.5);
            backdrop-filter: blur(4px);
            z-index: -1;
        }

        body {
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
            letter-spacing: 2px;
            text-align: center;
            margin-top: -120px;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }

        .title-camaligtas .camalig {
            color: #ff4d4d;
        }

        .title-camaligtas .tas {
            color: #4caf50;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.3);
            max-width: 400px;
            padding: 2.5rem 2rem;
        }

        .login-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .login-header h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #333;
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

        .alert {
            border-radius: 12px;
            border: none;
        }

        .signup-link {
            text-align: center;
        }

        @media (max-width: 576px) {
            .login-container {
                max-width: 95vw;
                padding: 1.5rem;
            }
            .title-camaligtas {
                font-size: 2.5rem;
            }
        }
    </style>
</head>

<body>

    <!-- Background Video -->
    <video autoplay muted loop playsinline id="bgVideo">
        <source src="{{ asset('assets/video/login-video.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Overlay -->
    <div class="overlay"></div>

    <!-- Title -->
    <div class="title-camaligtas">
        <br>
        <span class="camalig">Camalig</span><span class="tas">tas</span>
    </div>

    <!-- Login Box -->
    <div class="login-container">
        <div class="login-header">
            <h2>Login</h2>
            <p style="font-size: 1rem; color: #888;">Sign In with your Phone Number</p>
        </div>

        <!-- Session Alerts -->
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

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" id="loginForm" onsubmit="return handleLogin(event)">
            @csrf
            <div class="form-floating">
                <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                       id="phone" name="phone" placeholder="Phone Number" pattern="[0-9]{11}" 
                       value="{{ old('phone') }}" required>
                <label for="phone">
                    <i class="fas fa-phone me-2"></i> Phone Number
                </label>
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating">
                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                       id="password" name="password" placeholder="Password" required>
                <label for="password">
                    <i class="fas fa-lock me-2"></i> Password
                </label>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-login" id="loginBtn">
                <i class="fas fa-sign-in-alt me-2"></i> Access Dashboard
            </button>
        </form>

        <div class="signup-link">
            <a href="{{ url('forgot_password') }}" style="color: #e53935; text-decoration: underline; font-size: 0.95rem;">Forgot Password?</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Slow Down Video -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const video = document.getElementById('bgVideo');
            video.playbackRate = 0.5;
        });
    </script>

    <!-- Login Simulation Script -->
    <script>
        function handleLogin(event) {
            const phone = document.getElementById('phone').value.trim();
            const password = document.getElementById('password').value;

            // Superadmin
            if (phone === '09876543210' && password === 'superadmin123') {
                event.preventDefault();
                document.getElementById('loginBtn').innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Accessing...';
                setTimeout(() => {
                    window.location.href = '/superadmin/manage_users';
                }, 1000);
                return false;
            }

            // Admin
            if (phone === '09123456789' && password === 'admin123') {
                event.preventDefault();
                document.getElementById('loginBtn').innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Accessing...';
                setTimeout(() => {
                    window.location.href = '/admin/dashboard';
                }, 1000);
                return false;
            }

            // User
            if (phone === '09112233445' && password === 'user123') {
                event.preventDefault();
                document.getElementById('loginBtn').innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Accessing...';
                setTimeout(() => {
                    window.location.href = '/user/dashboard';
                }, 1000);
                return false;
            }

            return true;
        }
    </script>

</body>
</html>
