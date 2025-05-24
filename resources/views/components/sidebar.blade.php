<div class="accordion bg-dark text-white" id="sidebarAccordion" >

    <!-- Barangay Map Link -->
    <div class="p-2">
        <a class="nav-link text-white" href="{{ route('hazard.map') }}">
            📍 Barangay Hazard Map
        </a>
    </div>

    <!-- All Hazards Section -->
    <div class="accordion-item bg-dark border-0">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed bg-secondary text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHazards">
                All Hazards
            </button>
        </h2>
        <div id="collapseHazards" class="accordion-collapse collapse">
            <div class="accordion-body text-white">
                <div class="form-check">
                    <input class="form-check-input hazard-checkbox" type="checkbox" id="hazardFlood" data-hazard="flood">
                    <label class="form-check-label" for="hazardFlood">Flood</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hazard-checkbox" type="checkbox" id="hazardLandslide" data-hazard="landslide">
                    <label class="form-check-label" for="hazardLandslide">Landslide</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hazard-checkbox" type="checkbox" id="hazardVolcanic" data-hazard="volcanic">
                    <label class="form-check-label" for="hazardVolcanic">Volcanic</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hazard-checkbox" type="checkbox" id="hazardAshfall" data-hazard="ashfall">
                    <label class="form-check-label" for="hazardAshfall">Ashfall</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hazard-checkbox" type="checkbox" id="hazardLahar" data-hazard="lahar">
                    <label class="form-check-label" for="hazardLahar">Lahar</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hazard-checkbox" type="checkbox" id="hazardMudflow" data-hazard="mudflow">
                    <label class="form-check-label" for="hazardMudflow">Mudflow</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hazard-checkbox" type="checkbox" id="hazardFire" data-hazard="fire">
                    <label class="form-check-label" for="hazardFire">Fire</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input hazard-checkbox" type="checkbox" id="hazardWind" data-hazard="wind">
                    <label class="form-check-label" for="hazardWind">Wind</label>
                </div>
            </div>
        </div>
    </div>

    <!-- Map Layers Section -->
    <div class="accordion-item bg-dark border-0">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed bg-secondary text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLayers">
                Map Layers
            </button>
        </h2>
        <div id="collapseLayers" class="accordion-collapse collapse">
            <div class="accordion-body text-white">
                <div class="form-check">
                    <input class="form-check-input purok-checkbox" type="checkbox" id="layerAllPuroks" data-purok="all">
                    <label class="form-check-label" for="layerAllPuroks">All Puroks</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input purok-checkbox" type="checkbox" id="layerPurok1" data-purok="purok1">
                    <label class="form-check-label" for="layerPurok1">Purok 1</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input purok-checkbox" type="checkbox" id="layerPurok2" data-purok="purok2">
                    <label class="form-check-label" for="layerPurok2">Purok 2</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input purok-checkbox" type="checkbox" id="layerPurok3" data-purok="purok3">
                    <label class="form-check-label" for="layerPurok3">Purok 3</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input purok-checkbox" type="checkbox" id="layerPurok4" data-purok="purok4">
                    <label class="form-check-label" for="layerPurok4">Purok 4</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input purok-checkbox" type="checkbox" id="layerPurok5" data-purok="purok5">
                    <label class="form-check-label" for="layerPurok5">Purok 5</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="layerEvac">
                    <label class="form-check-label" for="layerEvac">Evacuation Centers</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="layerRiver">
                    <label class="form-check-label" for="layerRiver">Rivers & Bridges</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="layerLandmarks">
                    <label class="form-check-label" for="layerLandmarks">Landmarks</label>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Alerts Button -->
    <div class="p-3">
        <a href="#" class="btn btn-danger w-100">⚠️ Active Alerts</a>
    </div>

    <!-- Map Legend Section -->
    <div class="accordion-item bg-dark border-0">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed bg-secondary text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLegend">
                Map Legend
            </button>
        </h2>
        <div id="collapseLegend" class="accordion-collapse collapse">
            <div class="accordion-body text-white">
                <div id="hazard-legend" class="legend-container">
                    <!-- Legend will be populated dynamically -->
                </div>
            </div>
        </div>
    </div>

    <!-- Map Information Section -->
    <div class="accordion-item bg-dark border-0">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed bg-secondary text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseInfo">
                Map Information
            </button>
        </h2>
        <div id="collapseInfo" class="accordion-collapse collapse">
            <div class="accordion-body text-white">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="infoLegend">
                    <label class="form-check-label" for="infoLegend">Risk Level Legend</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="infoTypes">
                    <label class="form-check-label" for="infoTypes">Disaster Types</label>
                </div>
            </div>
        </div>
    </div>

</div>
