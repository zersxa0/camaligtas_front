
<nav class="navbar navbar-dark bg-primary fixed-top py-1">
    <div class="container-fluid d-flex align-items-center justify-content-between">
        <!-- Left: Hamburger + Logo + Title -->
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
                <span>CAMALIGTAS</span>
            </a>
            <!-- Navigation Links -->
            @if (!View::hasSection('hideNavbarLinks'))
            <ul class="navbar-nav flex-row gap-5 justify-content-center" style="margin-left: 8rem;">
                <li class="nav-item ms-5" style="margin-left: 4rem;">
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
        <!-- Right: Logout -->
        <div>
            <form id="logoutForm" action="{{ route('login') }}" method="GET" style="display:inline;">
                <button type="submit" class="btn btn-outline-light">Logout</button>
            </form>
        </div>
    </div>
</nav>