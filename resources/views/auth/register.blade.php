
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Disaster Risk Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .register-container {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            max-width: 370px;
            margin: 0 auto;
        }
        .register-header {
            background: linear-gradient(135deg, #45b7d1, #96c93d);
            color: white;
            padding: 2rem;
            text-align: center;
            position: relative;
        }
        .register-header h1 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
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
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            transform: translateY(-2px);
        }
        .btn-register {
            background: linear-gradient(135deg, #45b7d1, #96c93d);
            border: none;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
            background: linear-gradient(135deg, #3a9bb7, #7bb13c);
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
        @media (max-width: 576px) {
            .register-container {
                max-width: 98vw;
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="register-container my-5">
            <!-- Header -->
            <div class="register-header">
                <h1>Create Your Account</h1>
                <p>Sign up to access the Disaster Risk Dashboard</p>
            </div>
            <!-- Register Form -->
            <div class="p-4">
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
                <form method="POST" action="{{ route('register') }}" id="registerForm" onsubmit="return customRegister(event)">
                    @csrf
                    <div class="form-floating">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" required>
                        <label for="name"><i class="fas fa-user me-2"></i>Full Name</label>
                    </div>
                    <div class="form-floating">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                        <label for="email"><i class="fas fa-envelope me-2"></i>Email Address</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                        <label for="password_confirmation"><i class="fas fa-lock me-2"></i>Confirm Password</label>
                    </div>
                    <button type="submit" class="btn btn-register">
                        <i class="fas fa-user-plus me-2"></i>
                        Register
                    </button>
                </form>
                <div class="login-link">
                    <span>Already have an account? <a href="{{ route('login') }}">Login here</a></span>
                </div>
                <div class="footer-text">
                    <i class="fas fa-info-circle me-1"></i>
                    Emergency Hotline: <strong>911</strong> | Barangay Office: <strong>(052) XXX-XXXX</strong>
                    <br><small class="text-muted">© 2025 Barangay Ilawod Emergency Management System</small>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Demo only: Prevent actual submission and show a success message
        function customRegister(e) {
            e.preventDefault();
            alert('Registration successful! You can now log in.');
            window.location.href = "{{ route('login') }}";
            return false;
        }
    </script>
</body>
</html>