@extends('layouts.app')

@section('hideSidebar', true)

@section('content')
<div class="container my-5" style="max-width: 400px;">
    <div class="card shadow">
        <div class="card-body text-center">
            <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
            <h2 class="mt-4 mb-3">Registration Successful!</h2>
            <div class="alert alert-info">
                <p class="mb-2">Your Passcode:</p>
                <div class="d-flex align-items-center justify-content-center gap-2">
                    <span id="passcodeText" style="font-size: 2rem; letter-spacing: 3px; font-family: monospace;">{{ $passcode }}</span>
                    <button class="btn btn-sm btn-outline-primary" onclick="copyPasscode()">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>
            </div>
            <p class="text-muted mb-4">Please save this passcode. You'll need it to log in.</p>
            <a href="{{ route('login') }}" class="btn btn-success w-100">
                <i class="fas fa-sign-in-alt me-2"></i>Go to Login
            </a>
        </div>
    </div>
</div>

<script>
function copyPasscode() {
    const passcode = document.getElementById('passcodeText').textContent;
    navigator.clipboard.writeText(passcode).then(() => {
        const btn = event.target.closest('button');
        const originalHtml = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check"></i>';
        btn.classList.add('btn-success');
        btn.classList.remove('btn-outline-primary');
        setTimeout(() => {
            btn.innerHTML = originalHtml;
            btn.classList.remove('btn-success');
            btn.classList.add('btn-outline-primary');
        }, 2000);
    });
}
</script>
@endsection