<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password - Disaster Risk Dashboard</title>
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
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 0rem;
            letter-spacing: 2px;
            text-align: center;
            margin-top: -60px;
        }
        .title-camaligtas .camalig {
            color: #e53935;
        }
        .title-camaligtas .tas {
            color: #43a047;
        }
        .forgot-container {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
            border: 1px solid #f1f1f1;
            max-width: 400px;
            margin: 0 auto;
            padding: 2.5rem 2rem 2rem 2rem;
        }
        .forgot-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .forgot-header h2 {
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
        .btn-forgot {
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
        .btn-forgot:hover {
            background: rgb(124, 36, 35);
            color:rgb(255, 255, 255);
        }
        .back-link {
            text-align: center;
            margin-top: 1rem;
        }
        .back-link a {
            color: #43a047;
            text-decoration: underline;
            font-size: 0.95rem;
        }
        @media (max-width: 576px) {
            .forgot-container {
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
    <div class="forgot-container my-3">
        <div class="forgot-header">
            <h2>Forgot Password</h2>
            <p class="mb-0" style="font-size: 1rem; color: #888;">Enter your email to reset your password</p>
        </div>
        <form method="POST" action="#">
            <div class="form-floating">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                <label for="email">
                    <i class="fas fa-envelope me-2"></i>Email Address
                </label>
            </div>
            <button type="submit" class="btn btn-forgot">
                <i class="fas fa-paper-plane me-2"></i> Send Reset Link
            </button>
        </form>
        <div class="back-link">
            <a href="{{ url('login') }}"><i class="fas fa-arrow-left me-1"></i>Back to Login</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 