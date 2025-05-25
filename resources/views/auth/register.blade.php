
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
            <input type="hidden" id="passcode" name="passcode">
            <button type="submit" class="btn btn-register">
                <i class="fas fa-user-plus me-2"></i>
                Register
            </button>
        </form>
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
    <script>
        function generatePasscode(length = 6) {
            let chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
            let passcode = '';
            for (let i = 0; i < length; i++) {
                passcode += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            return passcode;
        }
        function customRegister(e) {
            e.preventDefault();
            let passcode = generatePasscode();
            document.getElementById('passcode').value = passcode;
            document.getElementById('passcodeBox').classList.remove('d-none');
            document.getElementById('passcodeBox').innerHTML =
                '<b>Your registration passcode:</b> <span class="text-danger" style="font-size:1.3rem;">' + passcode + '</span><br>Save this passcode. You will need it to log in.';
            setTimeout(function() {
                window.location.href = "{{ route('login') }}";
            }, 5000);
            return false;
        }
    </script>
</body>
</html>