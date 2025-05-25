
@extends('layouts.app')
@section('hideSidebar', true)

@section('content')
<div class="container-fluid px-0" style="background: #1976d2;">
    <div class="row g-0 align-items-center" style="padding: 1.5rem 1rem; margin-left: 20px;">
        <div class="col-md-8">
            <h5 class="text-white fw-bold mb-2">
                GIS-Based Disaster Risk Mapping for identifying Disaster Prone Areas in Brgy. Ilawod, Camalig, Albay.
            </h5>
            <p class="text-white mb-2" style="font-size: 1rem;">
                Stay informed and prepared for natural disasters with real-time alerts and comprehensive hazard mapping.
            </p>
            <button id="showDisasterTypesBtn" class="btn btn-light fw-bold" style="font-size: 1.2rem;">
                <i class="fas fa-layer-group me-2"></i>Types of Disaster
            </button>
        </div>
        <div class="col-md-4 text-end d-none d-md-block">
            <img src="{{ asset('assets/img/disaster_banner.jpg') }}" alt="Disaster Banner" style="max-width: 230px; border-radius: 20px;">
        </div>
    </div>
</div>

<!-- Types of Disaster Section (hidden by default, separate from overview) -->
<div class="container my-4" id="disasterTypesSection" style="display: none;">
    <h2 class="fw-bold mb-4">Types of Disaster</h2>
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="p-3 border rounded text-center">
                <span class="d-block mb-2" style="font-size:2rem; color:#1976d2;">
                    <i class="fas fa-water"></i>
                </span>
                <span class="fw-bold">Flood</span>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="p-3 border rounded text-center">
                <span class="d-block mb-2" style="font-size:2rem; color:#388e3c;">
                    <i class="fas fa-mountain"></i>
                </span>
                <span class="fw-bold">Landslide</span>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="p-3 border rounded text-center">
                <span class="d-block mb-2" style="font-size:2rem; color:#e53935;">
                    <i class="fas fa-fire"></i>
                </span>
                <span class="fw-bold">Volcanic</span>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="p-3 border rounded text-center">
                <span class="d-block mb-2" style="font-size:2rem; color:#bdb76b;">
                    <i class="fas fa-cloud"></i>
                </span>
                <span class="fw-bold">Ashfall</span>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="p-3 border rounded text-center">
                <span class="d-block mb-2" style="font-size:2rem; color:#795548;">
                    <i class="fas fa-water"></i>
                </span>
                <span class="fw-bold">Lahar</span>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="p-3 border rounded text-center">
                <span class="d-block mb-2" style="font-size:2rem; color:#607d8b;">
                    <i class="fas fa-tint"></i>
                </span>
                <span class="fw-bold">Mudflow</span>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="p-3 border rounded text-center">
                <span class="d-block mb-2" style="font-size:2rem; color:#ff9800;">
                    <i class="fas fa-fire-alt"></i>
                </span>
                <span class="fw-bold">Fire</span>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="p-3 border rounded text-center">
                <span class="d-block mb-2" style="font-size:2rem; color:#03a9f4;">
                    <i class="fas fa-wind"></i>
                </span>
                <span class="fw-bold">Wind</span>
            </div>
        </div>
    </div>
</div>
<!-- End Types of Disaster Section -->

<div class="container my-4">
    <h2 class="fw-bold mb-4">Disaster Risk Overview</h2>
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="bg-danger text-white fw-bold px-3 py-2 rounded-top" style="font-size: 1.1rem;">
                <i class="fas fa-exclamation-triangle me-2"></i>Active Alerts
            </div>
            <div class="border rounded-bottom p-3">
                <div class="mb-2">
                    <strong>Flood Watch</strong>
                    <span class="text-muted float-end" style="font-size: 0.9rem;">1 minute ago</span>
                </div>
                <div>
                    Increased water levels in the Ilawod River due to rainfall. Residents should prepare for possible evacuation.
                </div>
                <div class="mt-2">
                    <span class="badge bg-primary">Missing</span>
                    <span class="badge bg-info text-dark">Medical</span>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="bg-warning fw-bold px-3 py-2 rounded-top" style="font-size: 1.1rem;">
                <i class="fas fa-exclamation-circle me-2"></i>High Risk Areas
            </div>
            <div class="border rounded-bottom p-3">
                <div class="mb-2">
                    <strong>Ilawod RiverBank Area</strong>
                    <span class="badge bg-danger float-end">High Risk</span>
                </div>
                <div>
                    Highly flood prone areas with historical flood depths 1-2 meters during typhoons.
                </div>
                <div class="mt-2">
                    <span class="badge bg-primary">Missing</span>
                    <span class="badge bg-info text-dark">Medical</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('showDisasterTypesBtn').addEventListener('click', function() {
        var section = document.getElementById('disasterTypesSection');
        if (section.style.display === 'none') {
            section.style.display = 'block';
            section.scrollIntoView({ behavior: 'smooth' });
        } else {
            section.style.display = 'none';
        }
    });
</script>
@endsection