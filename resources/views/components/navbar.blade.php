
<nav class="navbar navbar-dark fixed-top py-0" style="background-color:rgb(2, 141, 255);">
    <div class="container-fluid d-flex align-items-center justify-content-between">
        <!-- Left: Hamburger + Logo + Title + Main Nav Links -->
        <div class="d-flex align-items-center">
            @hasSection('hideSidebar')
                {{-- Hide burger icon --}}
            @else
                <button class="btn btn-outline-light me-2" id="toggleSidebar" style="font-size: 20px;">
                    &#9776;
                </button>
            @endif
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('assets/img/logo_camalig.png') }}" width="40" class="me-2" alt="Logo">
                <span style="font-family: 'Lobster', cursive; font-size: 2rem;">
                    <span style="color: #e53935;">Camalig</span><span style="color: #43a047;">tas</span>
                </span>
            </a>
            @if (!View::hasSection('hideNavbarLinks'))
            <ul class="navbar-nav flex-row gap-5 align-items-center mb-0" style="margin-left: 5rem;">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('hazard.map') }}">Barangay Hazard Map</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('risk.analysis') }}">Risk Analysis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('alerts') }}">Alerts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('sms') }}">SMS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('contacts') }}">Contacts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('evacuation') }}">Evacuation</a>
                </li>
            </ul>
            @endif
        </div>
        <!-- Right: Profile + Logout -->
        <div class="d-flex align-items-center">
            <ul class="navbar-nav flex-row gap-4 align-items-center mb-0">
                <!-- Manage Profile Icon -->
                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center" href="{{ route('hazard.profile') }}" title="Manage Profile">
                        <i class="fas fa-user-circle fa-lg"></i>
                    </a>
                </li>
                <!-- Logout Icon -->
                <li class="nav-item">
                    <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link text-white p-0" title="Logout">
                            <i class="fas fa-sign-out-alt fa-lg"></i>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>