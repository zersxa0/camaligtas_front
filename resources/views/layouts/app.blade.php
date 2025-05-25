<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Disaster Risk Dashboard</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/hazard.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">

    @stack('styles')

    <style>
       #sidebar {
    width: 250px;
    height: calc(100vh - 56px);
    background-color: #343a40;
    color: white;
    position: fixed;
    top: 56px;
    left: -250px;
    transition: all 0.3s ease;
    z-index: 1030;
    overflow-y: auto;
}

#sidebar.active {
    left: 0;
}

#content {
    margin-left: 0;
    margin-top: 56px;
    padding: 20px;
    width: 100%;
    z-index: 0;
}
    </style>
</head>
<body>
    <link rel="stylesheet" href="{{ asset('assets/css/hazard.css') }}">
<script src="{{ asset('assets/js/hazard.js') }}"></script>
<script src="{{ asset('assets/js/data/hazard-zones.js') }}"></script>
<script src="{{ asset('assets/js/data/hazard-zones.js') }}"></script>
<script src="{{ asset('assets/js/data/purok-boundaries.js') }}"></script>
<script src="{{ asset('assets/js/data/evacuation-centers.js') }}"></script>

<!-- Main Application Script -->
<script src="{{ asset('assets/js/hazard.js') }}"></script>
    @include('components.navbar')

    @hasSection('hideSidebar')
        {{-- Sidebar hidden --}}
    @else
        <div id="sidebar">
            @include('components.sidebar')
        </div>
    @endif

    <div id="content" class="pt-4">
        @yield('content')
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggleBtn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');

        if (toggleBtn && sidebar && content) {
            toggleBtn.addEventListener('click', function () {
                sidebar.classList.toggle('active');
                content.classList.toggle('shifted');
            });
        }
    });
    </script>

    @stack('scripts')
</body>
</html>

