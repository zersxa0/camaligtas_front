
@extends('layouts.app')
@section('hideSidebar', true)
@section('hideNavbarLinks', true)

@section('content')
<div class="container-fluid mt-4">
    <h2>Welcome, User!</h2>
    <p>Barangay Ilawod Disaster Risk Management Dashboard</p>

    <!-- Navigation Tabs -->
    <ul class="nav nav-tabs mb-3" id="userTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="maps-tab" data-bs-toggle="tab" data-bs-target="#maps" type="button" role="tab">Disaster Maps</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tickets-tab" data-bs-toggle="tab" data-bs-target="#tickets" type="button" role="tab">Support Tickets</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="notifications-tab" data-bs-toggle="tab" data-bs-target="#notifications" type="button" role="tab">Notifications</button>
        </li>
    </ul>

    <div class="tab-content" id="userTabsContent">
        <!-- Maps Tab -->
        <div class="tab-pane fade show active" id="maps" role="tabpanel">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-map-marked-alt me-2"></i>Barangay Ilawod Disaster Risk Map</span>
                    <div class="btn-group btn-group-sm" role="group">
                        <button type="button" class="btn btn-outline-secondary hazard-btn" data-hazard="none">Clear All</button>
                        <button type="button" class="btn btn-outline-primary hazard-btn active" data-hazard="all">All Hazards</button>
                        <button type="button" class="btn btn-outline-danger hazard-btn" data-hazard="flood">Flood</button>
                        <button type="button" class="btn btn-outline-warning hazard-btn" data-hazard="landslide">Landslide</button>
                        <button type="button" class="btn btn-outline-info hazard-btn" data-hazard="fire">Fire</button>
                        <button type="button" class="btn btn-outline-secondary hazard-btn" data-hazard="ashfall">Ashfall</button>
                        <button type="button" class="btn btn-outline-dark hazard-btn" data-hazard="lahar">Lahar</button>
                        <button type="button" class="btn btn-outline-success hazard-btn" data-hazard="mudflow">Mudflow</button>
                        <button type="button" class="btn btn-outline-primary hazard-btn" data-hazard="wind">Strong Wind</button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="row g-0">
                        <div class="col-lg-3 col-md-4 d-none d-md-block">
                            <div class="legend-panel p-3" style="height: 600px; overflow-y: auto; background: #f8f9fa; border-right: 1px solid #dee2e6;">
                                <h6 class="fw-bold mb-3"><i class="fas fa-list me-2"></i>LEGEND</h6>
                                
                                <!-- Nutritional Color Code -->
                                <div class="legend-section mb-4">
                                    <h6 class="fw-bold text-primary">Nutritional Color Code</h6>
                                    <div class="legend-items">
                                        <div class="legend-item mb-1"><span class="legend-square" style="background: white; border: 1px solid #000;"></span>With stunted children</div>
                                        <div class="legend-item mb-1"><span class="legend-square" style="background: black;"></span>With wasted children</div>
                                        <div class="legend-item mb-1"><span class="legend-square" style="background: yellow;"></span>With underweight children</div>
                                        <div class="legend-item mb-1"><span class="legend-square" style="background: red;"></span>With severely underweight children</div>
                                        <div class="legend-item mb-1"><span class="legend-square" style="background: green;"></span>With normal children</div>
                                        <div class="legend-item mb-1"><span class="legend-square" style="background: orange;"></span>With overweight children</div>
                                        <div class="legend-item mb-1"><span class="legend-square" style="background: pink;"></span>With pregnant</div>
                                        <div class="legend-item mb-1"><span class="legend-square" style="background: gray;"></span>With lactating mother</div>
                                        <div class="legend-item mb-1"><span class="legend-square" style="background: darkgreen;"></span>Infants exclusively breastfeed</div>
                                        <div class="legend-item mb-1"><span class="legend-square" style="background: lightcoral;"></span>Infants with complementary foods</div>
                                        <div class="legend-item mb-1"><span class="legend-square" style="background: lightorange;"></span>Large family size household</div>
                                        <div class="legend-item mb-1"><span class="legend-square" style="background: lightblue;"></span>Without sanitary toilet</div>
                                        <div class="legend-item mb-1"><span class="legend-square" style="background: lightyellow;"></span>With senior citizen</div>
                                        <div class="legend-item mb-1"><span class="legend-square" style="background: lightpurple;"></span>With PWD</div>
                                        <div class="legend-item mb-1"><span class="legend-square" style="background: lightgreen;"></span>With Senior Citizen/PWD</div>
                                    </div>
                                </div>

                                <!-- Purok Markers -->
                                <div class="legend-section mb-4">
                                    <h6 class="fw-bold text-success">Purok Home Markers</h6>
                                    <div class="legend-items">
                                        <div class="legend-item mb-1"><span style="color: black; font-size: 16px;">🏠</span> Purok 1</div>
                                        <div class="legend-item mb-1"><span style="color: orange; font-size: 16px;">🏠</span> Purok 2</div>
                                        <div class="legend-item mb-1"><span style="color: blue; font-size: 16px;">🏠</span> Purok 3</div>
                                        <div class="legend-item mb-1"><span style="color: purple; font-size: 16px;">🏠</span> Purok 4</div>
                                        <div class="legend-item mb-1"><span style="color: green; font-size: 16px;">🏠</span> Purok 5</div>
                                    </div>
                                </div>

                                <!-- Risk Levels -->
                                <div class="legend-section mb-4">
                                    <h6 class="fw-bold text-danger">Risk Levels</h6>
                                    <div class="legend-items">
                                        <div class="legend-item mb-1"><span class="legend-square" style="background: red;"></span>High Risk</div>
                                        <div class="legend-item mb-1"><span class="legend-square" style="background: orange;"></span>Medium Risk</div>
                                        <div class="legend-item mb-1"><span class="legend-square" style="background: yellow;"></span>Low Risk</div>
                                    </div>
                                </div>

                                <!-- Infrastructure -->
                                <div class="legend-section mb-4">
                                    <h6 class="fw-bold text-info">Infrastructure</h6>
                                    <div class="legend-items">
                                        <div class="legend-item mb-1"><span style="font-size: 16px;">⛪</span> Chapel</div>
                                        <div class="legend-item mb-1"><span style="font-size: 16px;">🏛️</span> Barangay Hall</div>
                                        <div class="legend-item mb-1"><span style="font-size: 16px;">🏫</span> School</div>
                                        <div class="legend-item mb-1"><span style="font-size: 16px;">🌉</span> Bridge</div>
                                        <div class="legend-item mb-1"><span style="font-size: 16px;">⚰️</span> Cemetery</div>
                                        <div class="legend-item mb-1"><span style="font-size: 16px;">🛣️</span> Road Sign</div>
                                        <div class="legend-item mb-1"><span style="font-size: 16px;">🚧</span> Boundary Sign</div>
                                        <div class="legend-item mb-1"><span style="color: #0066CC; font-weight: bold;">——</span> Rivers</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-8 col-12">
                            <div id="disaster-map" style="height: 600px; width: 100%;"></div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <h6><i class="fas fa-palette me-2"></i>Risk Levels</h6>
                            <div class="d-flex flex-wrap gap-3">
                                <span><span style="width: 20px; height: 15px; background: red; display: inline-block; margin-right: 5px; border: 1px solid #ccc;"></span>High Risk</span>
                                <span><span style="width: 20px; height: 15px; background: orange; display: inline-block; margin-right: 5px; border: 1px solid #ccc;"></span>Medium Risk</span>
                                <span><span style="width: 20px; height: 15px; background: yellow; display: inline-block; margin-right: 5px; border: 1px solid #ccc;"></span>Low Risk</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6><i class="fas fa-home me-2"></i>Purok Home Markers</h6>
                            <div class="d-flex flex-wrap gap-3">
                                <span><span style="color: black; font-size: 16px; margin-right: 5px;">🏠</span>Purok 1</span>
                                <span><span style="color: orange; font-size: 16px; margin-right: 5px;">🏠</span>Purok 2</span>
                                <span><span style="color: blue; font-size: 16px; margin-right: 5px;">🏠</span>Purok 3</span>
                                <span><span style="color: purple; font-size: 16px; margin-right: 5px;">🏠</span>Purok 4</span>
                                <span><span style="color: green; font-size: 16px; margin-right: 5px;">🏠</span>Purok 5</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tickets Tab -->
        <div class="tab-pane fade" id="tickets" role="tabpanel">
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-plus-circle me-2"></i>Submit Support Ticket
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info" role="alert">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Note:</strong> You can submit one ticket per week. Next submission available: <span id="nextSubmissionDate">January 15, 2025</span>
                            </div>
                            <form id="ticketForm">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="ticketType" class="form-label">Issue Type</label>
                                        <select class="form-select" id="ticketType" required>
                                            <option value="">Select issue type...</option>
                                            <option value="emergency">🚨 Emergency Report</option>
                                            <option value="hazard">⚠️ Hazard Observation</option>
                                            <option value="infrastructure">🏗️ Infrastructure Issue</option>
                                            <option value="technical">💻 Technical Support</option>
                                            <option value="feedback">💬 Feedback/Suggestion</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="ticketPriority" class="form-label">Priority Level</label>
                                        <select class="form-select" id="ticketPriority" required>
                                            <option value="low">🟢 Low - General inquiry</option>
                                            <option value="medium">🟡 Medium - Non-urgent issue</option>
                                            <option value="high">🟠 High - Urgent matter</option>
                                            <option value="critical">🔴 Critical - Emergency</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="ticketLocation" class="form-label">Location</label>
                                    <select class="form-select" id="ticketLocation">
                                        <option value="">Select location...</option>
                                        <option value="purok1">Purok 1 - Riverside</option>
                                        <option value="purok2">Purok 2 - Central</option>
                                        <option value="purok3">Purok 3 - Hillside</option>
                                        <option value="purok4">Purok 4 - Agricultural</option>
                                        <option value="purok5">Purok 5 - Eastern</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="ticketSubject" class="form-label">Subject</label>
                                    <input type="text" class="form-control" id="ticketSubject" placeholder="Brief description of the issue" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ticketMessage" class="form-label">Description</label>
                                    <textarea class="form-control" id="ticketMessage" rows="4" placeholder="Detailed description of the issue or concern..." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100" id="submitTicketBtn">
                                    <i class="fas fa-paper-plane me-2"></i>Submit Ticket
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-list me-2"></i>My Tickets
                        </div>
                        <div class="card-body">
                            <div class="ticket-list" style="max-height: 400px; overflow-y: auto;">
                                <div class="ticket-item border rounded p-3 mb-3">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-warning">Medium</span>
                                        <small class="text-muted">2 hours ago</small>
                                    </div>
                                    <h6 class="mb-2">Blocked Drainage in Purok 2</h6>
                                    <p class="text-muted small mb-2">The drainage system near the chapel is blocked causing water accumulation.</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-info">In Progress</span>
                                        <code class="small">#TK-2025-001</code>
                                    </div>
                                </div>
                                <div class="ticket-item border rounded p-3 mb-3">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-success">Low</span>
                                        <small class="text-muted">1 day ago</small>
                                    </div>
                                    <h6 class="mb-2">Request for Emergency Contact Update</h6>
                                    <p class="text-muted small mb-2">Please update the emergency contact list with new numbers.</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-success">Resolved</span>
                                        <code class="small">#TK-2025-002</code>
                                    </div>
                                </div>
                                <div class="ticket-item border rounded p-3 mb-3">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-danger">High</span>
                                        <small class="text-muted">3 days ago</small>
                                    </div>
                                    <h6 class="mb-2">Landslide Risk Area Observation</h6>
                                    <p class="text-muted small mb-2">Noticed cracks on the hillside area in Purok 3 after recent rains.</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-warning">Under Review</span>
                                        <code class="small">#TK-2025-003</code>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Notifications Tab -->
        <div class="tab-pane fade" id="notifications" role="tabpanel">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-bell me-2"></i>Notifications & Alerts
                </div>
                <div class="card-body">
                    <ul>
                        <li>Emergency Weather Alert: Heavy rainfall warning issued.</li>
                        <li>Ticket Update: Your ticket #TK-2025-001 has been assigned.</li>
                        <li>Scheduled Maintenance: Siren system maintenance on Saturday.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize the map
    const map = L.map('disaster-map').setView([13.1421, 123.6857], 15);
    
    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Layer groups for different hazards
    const hazardLayers = {
        flood: L.layerGroup(),
        landslide: L.layerGroup(),
        fire: L.layerGroup(),
        ashfall: L.layerGroup(),
        lahar: L.layerGroup(),
        mudflow: L.layerGroup(),
        wind: L.layerGroup()
    };

    // Purok markers with colors according to legend
    const purokMarkers = {
        purok1: { lat: 13.1445, lng: 123.6840, color: '#000000', name: 'Purok 1 - Riverside' },
        purok2: { lat: 13.1440, lng: 123.6860, color: '#FFA500', name: 'Purok 2 - Central' },
        purok3: { lat: 13.1435, lng: 123.6880, color: '#0000FF', name: 'Purok 3 - Hillside' },
        purok4: { lat: 13.1425, lng: 123.6855, color: '#800080', name: 'Purok 4 - Agricultural' },
        purok5: { lat: 13.1430, lng: 123.6900, color: '#008000', name: 'Purok 5 - Eastern' }
    };

    // Add purok markers with home icons
    Object.keys(purokMarkers).forEach(purokId => {
        const purok = purokMarkers[purokId];
        L.marker([purok.lat, purok.lng], {
            icon: L.divIcon({
                className: 'purok-home-marker',
                html: `<div style="color: ${purok.color}; font-size: 20px; text-shadow: 1px 1px 2px rgba(0,0,0,0.7);">🏠</div>`,
                iconSize: [25, 25],
                iconAnchor: [12, 12]
            })
        }).bindPopup(`<strong>${purok.name}</strong><br>Click to view purok details`).addTo(map);
    });

    // Hazard zones data based on legend colors
    const hazardData = {
        flood: [
            {
                name: "Riverside Flood Zone",
                coordinates: [[13.1435, 123.6840], [13.1430, 123.6865], [13.1415, 123.6870], [13.1410, 123.6845], [13.1435, 123.6840]],
                risk: "High",
                color: "#FF0000",
                fillColor: "#FF0000"
            },
            {
                name: "Central Flood Area",
                coordinates: [[13.1425, 123.6850], [13.1420, 123.6875], [13.1405, 123.6880], [13.1400, 123.6855], [13.1425, 123.6850]],
                risk: "Medium",
                color: "#FFA500",
                fillColor: "#FFA500"
            },
            {
                name: "Agricultural Area",
                coordinates: [[13.1415, 123.6840], [13.1410, 123.6865], [13.1395, 123.6870], [13.1400, 123.6845], [13.1415, 123.6840]],
                risk: "Low",
                color: "#FFFF00",
                fillColor: "#FFFF00"
            }
        ],
        landslide: [
            {
                name: "Hillside Landslide Zone",
                coordinates: [[13.1445, 123.6875], [13.1440, 123.6885], [13.1430, 123.6880], [13.1435, 123.6870], [13.1445, 123.6875]],
                risk: "High",
                color: "#8B4513",
                fillColor: "#8B4513"
            }
        ],
        fire: [
            {
                name: "Dense Residential Fire Zone",
                coordinates: [[13.1425, 123.6860], [13.1420, 123.6875], [13.1410, 123.6870], [13.1415, 123.6855], [13.1425, 123.6860]],
                risk: "High",
                color: "#FF0000",
                fillColor: "#FF0000"
            }
        ],
        ashfall: [
            {
                name: "Ashfall Risk Area",
                coordinates: [[13.1430, 123.6855], [13.1425, 123.6870], [13.1415, 123.6875], [13.1420, 123.6860], [13.1430, 123.6855]],
                risk: "High",
                color: "#FFA500",
                fillColor: "#FFA500"
            }
        ],
        lahar: [
            {
                name: "Lahar Flow Path",
                coordinates: [[13.1440, 123.6845], [13.1435, 123.6870], [13.1425, 123.6875], [13.1430, 123.6850], [13.1440, 123.6845]],
                risk: "High",
                color: "#FF0000",
                fillColor: "#FF0000"
            }
        ],
        mudflow: [
            {
                name: "Mudflow Risk Area",
                coordinates: [[13.1420, 123.6865], [13.1415, 123.6880], [13.1405, 123.6885], [13.1410, 123.6870], [13.1420, 123.6865]],
                risk: "High",
                color: "#FF0000",
                fillColor: "#FF0000"
            }
        ],
        wind: [
            {
                name: "Strong Wind Risk Area",
                coordinates: [[13.1415, 123.6840], [13.1410, 123.6865], [13.1395, 123.6870], [13.1400, 123.6845], [13.1415, 123.6840]],
                risk: "High",
                color: "#FF0000",
                fillColor: "#FF0000"
            }
        ]
    };

    // Create hazard polygons
    Object.keys(hazardData).forEach(hazardType => {
        hazardData[hazardType].forEach(zone => {
            const polygon = L.polygon(zone.coordinates, {
                color: zone.color,
                fillColor: zone.fillColor,
                fillOpacity: 0.4,
                weight: 2
            }).bindPopup(`<strong>${zone.name}</strong><br>Risk Level: ${zone.risk}`);
            
            hazardLayers[hazardType].addLayer(polygon);
        });
    });

    // Add infrastructure icons according to legend
    const infrastructure = [
        { lat: 13.1410, lng: 123.6845, icon: "⛪", name: "Ilawod Chapel", type: "chapel" },
        { lat: 13.1435, lng: 123.6890, icon: "🏛️", name: "Barangay Hall", type: "barangay_hall" },
        { lat: 13.1421, lng: 123.6857, icon: "🏫", name: "Ilawod Elementary School", type: "school" },
        { lat: 13.1425, lng: 123.6855, icon: "🌉", name: "Main Bridge", type: "bridge" },
        { lat: 13.1415, lng: 123.6865, icon: "🌉", name: "Secondary Bridge", type: "bridge" },
        { lat: 13.1405, lng: 123.6875, icon: "⚰️", name: "Cemetery", type: "cemetery" },
        { lat: 13.1440, lng: 123.6850, icon: "🛣️", name: "Road Sign", type: "road_sign" },
        { lat: 13.1430, lng: 123.6885, icon: "🚧", name: "Boundary Sign", type: "boundary_sign" }
    ];

    // Add infrastructure markers
    infrastructure.forEach(item => {
        L.marker([item.lat, item.lng], {
            icon: L.divIcon({
                className: `infrastructure-marker ${item.type}`,
                html: item.icon,
                iconSize: [25, 25],
                iconAnchor: [12, 12]
            })
        }).bindPopup(`<strong>${item.name}</strong><br>Type: ${item.type.replace('_', ' ')}`).addTo(map);
    });

    // Add rivers
    const riverCoordinates = [
        [[13.1435, 123.6840], [13.1430, 123.6865], [13.1415, 123.6870], [13.1400, 123.6880]],
        [[13.1420, 123.6835], [13.1415, 123.6850], [13.1410, 123.6865]]
    ];

    riverCoordinates.forEach(coords => {
        L.polyline(coords, {
            color: '#0066CC',
            weight: 4,
            opacity: 0.8
        }).bindPopup('Yawa River').addTo(map);
    });

    // Show all hazards initially
    Object.values(hazardLayers).forEach(layer => {
        map.addLayer(layer);
    });

    // Hazard control buttons
    document.querySelectorAll('.hazard-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const hazardType = this.dataset.hazard;
            
            // Update button states
            document.querySelectorAll('.hazard-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Clear all layers
            Object.values(hazardLayers).forEach(layer => {
                map.removeLayer(layer);
            });
            
            // Show selected hazard, all, or none
            if (hazardType === 'all') {
                Object.values(hazardLayers).forEach(layer => {
                    map.addLayer(layer);
                });
            } else if (hazardType === 'none') {
                // Keep all layers cleared - show only base map with infrastructure
            } else if (hazardLayers[hazardType]) {
                map.addLayer(hazardLayers[hazardType]);
            }
        });
    });

    // Ticket submission limit functionality
    const ticketForm = document.getElementById('ticketForm');
    const submitBtn = document.getElementById('submitTicketBtn');
    let lastSubmissionDate = localStorage.getItem('lastTicketSubmission');
    
    function checkTicketSubmissionLimit() {
        if (lastSubmissionDate) {
            const lastDate = new Date(lastSubmissionDate);
            const today = new Date();
            const daysDiff = Math.floor((today - lastDate) / (1000 * 60 * 60 * 24));
            
            if (daysDiff < 7) {
                const nextDate = new Date(lastDate.getTime() + (7 * 24 * 60 * 60 * 1000));
                document.getElementById('nextSubmissionDate').textContent = nextDate.toLocaleDateString();
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-clock me-2"></i>Wait for Next Week';
                return false;
            }
        }
        return true;
    }
    
    // Check limit on page load
    checkTicketSubmissionLimit();
    
    // Handle ticket form submission
    if (ticketForm) {
        ticketForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!checkTicketSubmissionLimit()) {
                alert('You can only submit one ticket per week. Please wait until next submission date.');
                return;
            }
            
            // Get form data
            const formData = {
                type: document.getElementById('ticketType').value,
                priority: document.getElementById('ticketPriority').value,
                location: document.getElementById('ticketLocation').value,
                subject: document.getElementById('ticketSubject').value,
                message: document.getElementById('ticketMessage').value
            };
            
            // Validate form
            if (!formData.type || !formData.priority || !formData.subject || !formData.message) {
                alert('Please fill in all required fields.');
                return;
            }
            
            // Show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Submitting...';
            
            // Simulate submission
            setTimeout(() => {
                // Store submission date
                localStorage.setItem('lastTicketSubmission', new Date().toISOString());
                
                // Generate ticket ID
                const ticketId = 'TK-' + new Date().getFullYear() + '-' + String(Math.floor(Math.random() * 1000)).padStart(3, '0');
                
                // Reset form
                ticketForm.reset();
                
                // Update UI
                checkTicketSubmissionLimit();
                
                // Show success message
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-success alert-dismissible fade show mt-3';
                alertDiv.innerHTML = `
                    <i class="fas fa-check-circle me-2"></i>
                    <strong>Success!</strong> Your ticket ${ticketId} has been submitted successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;
                ticketForm.parentNode.insertBefore(alertDiv, ticketForm);
                
                // Auto-hide after 5 seconds
                setTimeout(() => {
                    if (alertDiv.parentNode) {
                        alertDiv.remove();
                    }
                }, 5000);
                
            }, 2000);
        });
    }
});

// Add responsive styles
const style = document.createElement('style');
style.textContent = `
    .legend-square {
        width: 15px;
        height: 15px;
        display: inline-block;
        margin-right: 8px;
        border: 1px solid #ccc;
    }
    
    .legend-item {
        display: flex;
        align-items: center;
        font-size: 0.9rem;
        padding: 2px 0;
    }
    
    .legend-section {
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 1rem;
    }
    
    .legend-section:last-child {
        border-bottom: none;
    }
    
    @media (max-width: 768px) {
        .legend-panel {
            display: none !important;
        }
        
        .btn-group {
            flex-wrap: wrap;
        }
        
        .btn-group .btn {
            margin: 2px;
            font-size: 0.8rem;
        }
        
        .card-footer {
            font-size: 0.85rem;
        }
        
        .card-footer .d-flex {
            flex-direction: column;
            gap: 1rem;
        }
    }
    
    @media (max-width: 576px) {
        .container-fluid {
            padding: 10px;
        }
        
        .card-header .btn-group {
            display: none;
        }
        
        .ticket-item {
            font-size: 0.9rem;
        }
        
        .badge {
            font-size: 0.7rem;
        }
    }
`;
document.head.appendChild(style);
</script>
@endpush