<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password - Disaster Risk Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">

    <style>
        /* Background Video */
        #bgVideo {
            position: fixed;
            top: 0;
            left: 0;
            min-width: 100%;
            min-height: 100%;
            object-fit: cover;
            z-index: -2;
        }

        /* Overlay */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
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
            font-size: 3rem;
            font-weight: bold;
            letter-spacing: 2px;
            text-align: center;
            margin-top: -60px;
            color: white;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.7);
        }

        .title-camaligtas .camalig {
            color: #ff4d4d;
        }

        .title-camaligtas .tas {
            color: #4caf50;
        }

        .forgot-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.3);
            max-width: 400px;
            padding: 2.5rem 2rem;
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
                font-size: 1.8rem;
            }
        }
    </style>
</head>

<body>

    <!-- Background Video -->
    <video autoplay muted loop playsinline id="bgVideo">
        <source src="{{ asset('assets/video/forgot-video.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Overlay -->
    <div class="overlay"></div>

    <!-- Title -->
    <div class="title-camaligtas"><br>
        <span class="camalig">Camalig</span><span class="tas">tas</span>
    </div>

    <!-- Forgot Password Box -->
    <div class="forgot-container my-3">
        <div class="forgot-header">
            <h2>Forgot Password</h2>
            <p class="mb-0" style="font-size: 1rem; color: #888;">Enter your phone number to receive a reset code</p>
        </div>

        <form id="otpForm">
            <div class="form-floating">
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone Number" pattern="[0-9]{11}" required>
                <label for="phone">
                    <i class="fas fa-phone me-2"></i>Phone Number
                </label>
            </div>

            <button type="submit" class="btn btn-forgot">
                <i class="fas fa-sms me-2"></i> Send Code
            </button>
        </form>

        <div class="back-link">
            <a href="{{ url('login') }}"><i class="fas fa-arrow-left me-1"></i>Back to Login</a>
        </div>
    </div>

    <!-- OTP Modal -->
    <div class="modal fade" id="otpModal" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"><i class="fas fa-shield-alt me-2"></i>Verify OTP</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <p class="mb-2">We have sent a 6-digit code to your phone. Enter it below:</p>
            <input type="text" class="form-control mb-3" placeholder="Enter OTP" maxlength="6" pattern="[0-9]{6}" required>
            <div class="text-center">
                <button class="btn btn-success w-100 mb-2">
                    <i class="fas fa-check-circle me-2"></i> Verify
                </button>
                <p style="font-size: 0.9rem;">Didn't receive the code? <a href="#" class="text-danger" onclick="resendOtp()">Resend</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Video Speed -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const video = document.getElementById('bgVideo');
            video.playbackRate = 0.5;
        });
    </script>

    <!-- OTP Modal Logic -->
    <script>
        const otpForm = document.getElementById('otpForm');
        const otpModal = new bootstrap.Modal(document.getElementById('otpModal'));

        otpForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // Simulate sending OTP (In real app, send request to backend)
            setTimeout(() => {
                otpModal.show();
            }, 500);
        });

        function resendOtp() {
            alert('OTP resent successfully!');
        }
    </script>

</body>
</html>
