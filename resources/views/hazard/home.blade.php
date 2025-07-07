@extends('layouts.app')
@section('hideSidebar', true)

@section('content')
<style>
    .content-wrapper {
        padding-top: 48px;
        width: 100%;
        height: calc(100vh - 48px);
        background-color: #f8f9fa;
        overflow-y: auto;
    }

    /* Banner section */
    .banner-section {
        background: #0066cc;
        padding: 0.75rem;
        height: auto;
        max-height: 30vh;
    }

    .banner-container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .banner-text {
        color: white;
        flex: 1;
    }

    .banner-title {
        font-size: min(1.1rem, 3vw);
        font-weight: bold;
        margin-bottom: 0.25rem;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .banner-subtitle {
        font-size: min(0.85rem, 2.5vw);
        opacity: 0.9;
        margin-bottom: 0.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .banner-image {
        width: min(100px, 20vw);
        height: auto;
        border-radius: 6px;
        object-fit: cover;
    }

    /* Types of Disaster Button */
    .disaster-btn {
        background-color: #0066cc;
        color: white;
        border: 1px solid white;
        padding: 0.35rem 0.75rem;
        border-radius: 4px;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: min(0.85rem, 2.5vw);
    }

    .disaster-btn:hover {
        background-color: white;
        color: #0066cc;
    }

    /* Overview Cards */
    .overview-container {
        max-width: 1200px;
        margin: 0.75rem auto;
        padding: 0 0.75rem;
        height: calc(70vh - 48px);
        overflow-y: auto;
    }

    .overview-title {
        font-size: 1.1rem;
        font-weight: bold;
        margin-bottom: 0.75rem;
        color: #333;
    }

    .alert-card {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        height: auto;
        margin-bottom: 0.75rem;
    }

    .alert-header {
        padding: 0.5rem 0.75rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
    }

    .alert-header.danger {
        background-color: #dc3545;
        color: white;
    }

    .alert-header.warning {
        background-color: #ffc107;
        color: #000;
    }

    .alert-body {
        padding: 0.75rem;
    }

    .alert-title {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 0.35rem;
        font-size: 0.9rem;
    }

    .alert-time {
        font-size: 0.8rem;
        color: #6c757d;
    }

    .alert-description {
        font-size: 0.85rem;
        margin-bottom: 0.5rem;
        color: #333;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .badge {
        padding: 0.25rem 0.5rem;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: normal;
        margin-right: 0.35rem;
    }

    .badge-medical {
        background-color: #17a2b8 !important;
        color: white;
    }

    /* Grid adjustments */
    .row {
        margin-right: -0.375rem;
        margin-left: -0.375rem;
    }

    .col-md-6 {
        padding-right: 0.375rem;
        padding-left: 0.375rem;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .banner-section {
            max-height: 35vh;
        }

        .banner-container {
            flex-direction: column;
            text-align: center;
        }

        .banner-image {
            width: 80px;
            margin: 0.5rem auto 0;
        }

        .overview-container {
            height: calc(65vh - 48px);
        }

        .alert-title {
            flex-direction: column;
            gap: 0.25rem;
        }
    }

    @media (max-width: 576px) {
        .content-wrapper {
            height: 100vh;
        }

        .banner-section {
            padding: 0.5rem;
        }

        .overview-container {
            padding: 0 0.5rem;
            margin: 0.5rem auto;
        }

        .alert-card {
            margin-bottom: 0.5rem;
        }
    }
</style>

<div class="content-wrapper">
    <!-- Banner Section -->
    <div class="banner-section">
        <div class="banner-container">
            <div class="banner-text">
                <h1 class="banner-title">GIS-Based Disaster Risk Mapping for identifying Disaster Prone Areas in Brgy. Ilawod, Camalig, Albay.</h1>
                <p class="banner-subtitle">Stay informed and prepared for natural disasters with real-time alerts and comprehensive hazard mapping.</p>
                <button class="disaster-btn" id="showDisasterTypesBtn">
                    <i class="fas fa-layer-group"></i>
                    Types of Disaster
                </button>
            </div>
            <img src="{{ asset('assets/img/disaster_banner.jpg') }}" alt="Disaster Banner" class="banner-image">
        </div>
    </div>

    <!-- Disaster Types Section (Initially Hidden) -->
    <div id="disasterTypesSection" style="display: none;">
        <div class="overview-container">
            <h2 class="overview-title">Common Disaster Types</h2>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="alert-card">
                        <div class="alert-header danger"><i class="fas fa-house-damage"></i> Earthquake</div>
                        <div class="alert-body">
                            <p class="alert-description">Sudden shaking of the ground caused by the passage of seismic waves through Earth's rocks.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="alert-card">
                        <div class="alert-header warning"><i class="fas fa-cloud-showers-heavy"></i> Flood</div>
                        <div class="alert-body">
                            <p class="alert-description">An overflow of a large amount of water beyond its normal limits, especially over what is normally dry land.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="alert-card">
                        <div class="alert-header danger"><i class="fas fa-wind"></i> Typhoon / Hurricane</div>
                        <div class="alert-body">
                            <p class="alert-description">A mature tropical cyclone that develops between 180° and 100°E in the Northern Hemisphere.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="alert-card">
                        <div class="alert-header warning"><i class="fas fa-fire"></i> Fire</div>
                        <div class="alert-body">
                            <p class="alert-description">A process in which substances combine chemically with oxygen from the air and typically give out bright light, heat, and smoke.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="alert-card">
                        <div class="alert-header danger"><i class="fas fa-volcano"></i> Volcanic Eruption</div>
                        <div class="alert-body">
                            <p class="alert-description">The expulsion of gases, rock fragments, and molten lava from a volcano.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="alert-card">
                        <div class="alert-header warning"><i class="fas fa-smog"></i> Landslide</div>
                        <div class="alert-body">
                            <p class="alert-description">The movement of a mass of rock, debris, or earth down a slope.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Overview Section -->
    <div class="overview-container">
        <h2 class="overview-title">Disaster Risk Overview</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="alert-card">
                    <div class="alert-header danger">
                        <i class="fas fa-exclamation-triangle"></i>
                        Active Alerts
                    </div>
                    <div class="alert-body">
                        <div class="alert-title">
                            <strong>Flood Watch</strong>
                            <span class="alert-time">1 minute ago</span>
                        </div>
                        <p class="alert-description">
                            Increased water levels in the Ilawod River due to rainfall. Residents should prepare for possible evacuation.
                        </p>
                        <div>
                            <span class="badge bg-primary">Missing</span>
                            <span class="badge badge-medical">Medical</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="alert-card">
                    <div class="alert-header warning">
                        <i class="fas fa-exclamation-circle"></i>
                        High Risk Areas
                    </div>
                    <div class="alert-body">
                        <div class="alert-title">
                            <strong>Ilawod RiverBank Area</strong>
                            <span class="badge bg-danger">High Risk</span>
                        </div>
                        <p class="alert-description">
                            Highly flood prone areas with historical flood depths 1-2 meters during typhoons.
                        </p>
                        <div>
                            <span class="badge bg-primary">Missing</span>
                            <span class="badge badge-medical">Medical</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Barangay Selection Buttons -->
        <div class="mt-4">
            <h3 class="overview-title">Select Barangay</h3>
            <p> To see or download demographic by data visualization or table format</p>
            <div class="row g-3">
                <div class="col-md-2 col-sm-4 col-6">
                    <button class="btn btn-primary w-100 p-3" onclick="navigateToBarangay('ilawod')">
                        <i class="fas fa-map-marker-alt fa-2x mb-2 d-block"></i>
                        <strong>Ilawod</strong>
                    </button>
                </div>
                <div class="col-md-2 col-sm-4 col-6">
                    <button class="btn btn-outline-primary w-100 p-3" onclick="navigateToBarangay('sua')">
                        <i class="fas fa-map-marker-alt fa-2x mb-2 d-block"></i>
                        <strong>Sua</strong>
                    </button>
                </div>
                <div class="col-md-2 col-sm-4 col-6">
                    <button class="btn btn-outline-primary w-100 p-3" onclick="navigateToBarangay('barangay1')">
                        <i class="fas fa-map-marker-alt fa-2x mb-2 d-block"></i>
                        <strong>Barangay 1</strong>
                    </button>
                </div>
                <div class="col-md-2 col-sm-4 col-6">
                    <button class="btn btn-outline-primary w-100 p-3" onclick="navigateToBarangay('barangay2')">
                        <i class="fas fa-map-marker-alt fa-2x mb-2 d-block"></i>
                        <strong>Barangay 2</strong>
                    </button>
                </div>
                <div class="col-md-2 col-sm-4 col-6">
                    <button class="btn btn-outline-primary w-100 p-3" onclick="navigateToBarangay('barangay3')">
                        <i class="fas fa-map-marker-alt fa-2x mb-2 d-block"></i>
                        <strong>Barangay 3</strong>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const showDisasterTypesBtn = document.getElementById('showDisasterTypesBtn');
        const disasterTypesSection = document.getElementById('disasterTypesSection');

        if (showDisasterTypesBtn && disasterTypesSection) {
            showDisasterTypesBtn.addEventListener('click', function() {
                if (disasterTypesSection.style.display === 'none') {
                    disasterTypesSection.style.display = 'block';
                    disasterTypesSection.scrollIntoView({ behavior: 'smooth' });
                } else {
                    disasterTypesSection.style.display = 'none';
                }
            });
        }
    });

    function navigateToBarangay(barangay) {
        window.location.href = '/' + barangay;
    }
</script>
@endsection