// Global variables for map management
let map;
let hazardLayers = {};
let purokLayers = {};
let evacuationLayers = {};
let routeLayers = {};
let legendControl;
let riversLayer = {};
let landmarksLayer = {};
let mainMarker;

// Initialize map when DOM is loaded
document.addEventListener("DOMContentLoaded", function () {
    initializeMap();
    loadMapData();
    setupEventListeners();
});

// Initialize the Leaflet map
function initializeMap() {
    map = L.map('hazard-map').setView([13.1421, 123.6857], 15); // Barangay Ilawod, Camalig

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Add main barangay marker
    mainMarker = L.marker([13.1421, 123.6857])
        .addTo(map)
        .bindPopup("Barangay Ilawod, Camalig, Albay")
        .openPopup();

    // Initialize legend control
    legendControl = L.control({position: 'bottomright'});
    legendControl.onAdd = function(map) {
        let div = L.DomUtil.create('div', 'legend');
        div.innerHTML = '<h4>Hazard Legend</h4>';
        return div;
    };
}

// Load all map data
function loadMapData() {
    // Load hazard zones data
    if (typeof hazardZonesData !== 'undefined') {
        initializeHazardLayers();
    }
    
    // Load purok boundaries data
    if (typeof purokBoundariesData !== 'undefined') {
        initializePurokLayers();
    }
    
    // Load evacuation centers data
    if (typeof evacuationCentersData !== 'undefined') {
        initializeEvacuationLayers();
    }
    
    // Initialize rivers and landmarks layers
    initializeRiversAndBridges();
    initializeLandmarks();
}

// Initialize hazard layers
function initializeHazardLayers() {
    Object.keys(hazardZonesData).forEach(hazardType => {
        hazardLayers[hazardType] = L.layerGroup();
        
        hazardZonesData[hazardType].forEach(zone => {
            let polygon = L.polygon(zone.coordinates, {
                color: zone.color,
                fillColor: zone.fillColor,
                fillOpacity: 0.4,
                weight: 2
            }).bindPopup(`${zone.name}<br>Risk Level: ${zone.riskLevel}`);
            
            hazardLayers[hazardType].addLayer(polygon);
        });
    });
}

// Initialize purok boundary layers
function initializePurokLayers() {
    Object.keys(purokBoundariesData).forEach(purokId => {
        let purok = purokBoundariesData[purokId];
        purokLayers[purokId] = L.polygon(purok.coordinates, {
            color: '#000080',
            fillColor: '#4169E1',
            fillOpacity: 0.2,
            weight: 2,
            dashArray: '5, 5'
        }).bindPopup(`${purok.name}<br>Population: ${purok.population}<br>Households: ${purok.households}`);
    });
}

// Initialize evacuation center layers
function initializeEvacuationLayers() {
    evacuationLayers = L.layerGroup();
    
    evacuationCentersData.forEach(center => {
        let marker = L.marker([center.lat, center.lng], {
            icon: L.divIcon({
                className: 'evacuation-marker',
                html: '🏫',
                iconSize: [30, 30],
                iconAnchor: [15, 15]
            })
        }).bindPopup(`
            <strong>${center.name}</strong><br>
            Capacity: ${center.capacity} people<br>
            Type: ${center.type}<br>
            Contact: ${center.contact}
        `);
        
        evacuationLayers.addLayer(marker);
    });
}

// Setup event listeners for sidebar controls
function setupEventListeners() {
    // Hazard checkboxes
    document.querySelectorAll('.hazard-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            let hazardType = this.dataset.hazard;
            toggleHazardLayer(hazardType, this.checked);
        });
    });

    // Purok checkboxes - allow only one selection at a time
    document.querySelectorAll('.purok-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            let purokId = this.dataset.purok;
            
            if (purokId !== 'all' && this.checked) {
                // Uncheck all other individual purok checkboxes
                document.querySelectorAll('.purok-checkbox:not([data-purok="all"])').forEach(cb => {
                    if (cb !== this) {
                        cb.checked = false;
                        let otherPurokId = cb.dataset.purok;
                        if (purokLayers[otherPurokId] && map.hasLayer(purokLayers[otherPurokId])) {
                            map.removeLayer(purokLayers[otherPurokId]);
                        }
                    }
                });
                // Uncheck "All Puroks"
                document.getElementById('layerAllPuroks').checked = false;
            }
            
            togglePurokLayer(purokId, this.checked);
        });
    });

    // Evacuation centers checkbox
    document.getElementById('layerEvac').addEventListener('change', function() {
        toggleEvacuationCenters(this.checked);
    });

    // Rivers and bridges checkbox
    document.getElementById('layerRiver').addEventListener('change', function() {
        toggleRiversAndBridges(this.checked);
    });

    // Landmarks checkbox
    document.getElementById('layerLandmarks').addEventListener('change', function() {
        toggleLandmarks(this.checked);
    });
}

// Toggle hazard layers
function toggleHazardLayer(hazardType, show) {
    if (hazardLayers[hazardType]) {
        if (show) {
            map.addLayer(hazardLayers[hazardType]);
            updateLegend();
        } else {
            map.removeLayer(hazardLayers[hazardType]);
            updateLegend();
        }
    }
}

// Toggle purok layers
function togglePurokLayer(purokId, show) {
    if (purokId === 'all') {
        // Handle "All Puroks" checkbox
        Object.keys(purokLayers).forEach(id => {
            if (show) {
                map.addLayer(purokLayers[id]);
            } else {
                map.removeLayer(purokLayers[id]);
            }
        });
        
        // Update individual purok checkboxes
        document.querySelectorAll('.purok-checkbox:not([data-purok="all"])').forEach(cb => {
            cb.checked = show;
        });
    } else {
        // Handle individual purok checkbox
        if (purokLayers[purokId]) {
            if (show) {
                map.addLayer(purokLayers[purokId]);
                // Move main marker to purok center
                updateMainMarkerPosition(purokId);
            } else {
                map.removeLayer(purokLayers[purokId]);
                // Return marker to default position
                updateMainMarkerPosition(null);
            }
        }
        
        // Don't update "All Puroks" checkbox for individual selections
        // Keep individual purok selections independent
    }
    
    // Update evacuation routes if evacuation centers are visible
    if (document.getElementById('layerEvac').checked) {
        updateEvacuationRoutes();
    }
}

// Simplified purok checkbox management - no automatic "All Puroks" updates
function updateAllPuroksCheckbox() {
    // Keep this function but don't auto-update to maintain independence
    // Individual puroks work independently from "All Puroks"
}

// Toggle evacuation centers
function toggleEvacuationCenters(show) {
    if (show) {
        map.addLayer(evacuationLayers);
        updateEvacuationRoutes();
    } else {
        map.removeLayer(evacuationLayers);
        clearEvacuationRoutes();
    }
}

// Update evacuation routes based on selected puroks
function updateEvacuationRoutes() {
    clearEvacuationRoutes();
    
    let selectedPuroks = getSelectedPuroks();
    
    selectedPuroks.forEach(purokId => {
        let route = calculateEvacuationRoute(purokId);
        if (route) {
            routeLayers[purokId] = L.polyline(route.coordinates, {
                color: '#FF0000',
                weight: 3,
                opacity: 0.7,
                dashArray: '10, 10'
            }).bindPopup(`Evacuation Route from ${route.from} to ${route.to}`);
            
            map.addLayer(routeLayers[purokId]);
        }
    });
}

// Get list of selected purok IDs
function getSelectedPuroks() {
    let selected = [];
    document.querySelectorAll('.purok-checkbox:not([data-purok="all"]):checked').forEach(cb => {
        selected.push(cb.dataset.purok);
    });
    return selected;
}

// Calculate evacuation route for a purok
function calculateEvacuationRoute(purokId) {
    if (!purokBoundariesData[purokId] || !evacuationCentersData) {
        return null;
    }
    
    let purok = purokBoundariesData[purokId];
    let purokCenter = calculateCentroid(purok.coordinates);
    
    // Find nearest evacuation center
    let nearestCenter = null;
    let minDistance = Infinity;
    
    evacuationCentersData.forEach(center => {
        let distance = calculateDistance(purokCenter, [center.lat, center.lng]);
        if (distance < minDistance) {
            minDistance = distance;
            nearestCenter = center;
        }
    });
    
    if (nearestCenter) {
        return {
            coordinates: [purokCenter, [nearestCenter.lat, nearestCenter.lng]],
            from: purok.name,
            to: nearestCenter.name
        };
    }
    
    return null;
}

// Calculate centroid of a polygon
function calculateCentroid(coordinates) {
    let lat = 0, lng = 0;
    coordinates.forEach(coord => {
        lat += coord[0];
        lng += coord[1];
    });
    return [lat / coordinates.length, lng / coordinates.length];
}

// Calculate distance between two points (simple Euclidean)
function calculateDistance(point1, point2) {
    let dx = point1[0] - point2[0];
    let dy = point1[1] - point2[1];
    return Math.sqrt(dx * dx + dy * dy);
}

// Clear all evacuation routes
function clearEvacuationRoutes() {
    Object.keys(routeLayers).forEach(purokId => {
        map.removeLayer(routeLayers[purokId]);
        delete routeLayers[purokId];
    });
}

// Initialize rivers and bridges layer
function initializeRiversAndBridges() {
    riversLayer = L.layerGroup();
    
    // Add river lines based on the area
    let riverCoordinates = [
        [[13.1435, 123.6840], [13.1430, 123.6865], [13.1415, 123.6870], [13.1400, 123.6880]],
        [[13.1420, 123.6835], [13.1415, 123.6850], [13.1410, 123.6865]]
    ];
    
    riverCoordinates.forEach(coords => {
        let river = L.polyline(coords, {
            color: '#0066CC',
            weight: 4,
            opacity: 0.8
        }).bindPopup('Yawa River');
        riversLayer.addLayer(river);
    });
    
    // Add bridge markers
    let bridges = [
        {lat: 13.1425, lng: 123.6855, name: "Main Bridge"},
        {lat: 13.1415, lng: 123.6865, name: "Secondary Bridge"}
    ];
    
    bridges.forEach(bridge => {
        let marker = L.marker([bridge.lat, bridge.lng], {
            icon: L.divIcon({
                className: 'bridge-marker',
                html: '🌉',
                iconSize: [25, 25],
                iconAnchor: [12, 12]
            })
        }).bindPopup(bridge.name);
        riversLayer.addLayer(marker);
    });
}

// Toggle rivers and bridges
function toggleRiversAndBridges(show) {
    if (show) {
        map.addLayer(riversLayer);
    } else {
        map.removeLayer(riversLayer);
    }
}

// Initialize landmarks layer
function initializeLandmarks() {
    landmarksLayer = L.layerGroup();
    
    // Add landmarks based on your legend requirements
    let landmarks = [
        {lat: 13.1410, lng: 123.6845, name: "Ilawod Chapel", icon: "⛪", type: "chapel"},
        {lat: 13.1435, lng: 123.6890, name: "Barangay Hall", icon: "🏛️", type: "barangay_hall"},
        {lat: 13.1421, lng: 123.6857, name: "Ilawod Elementary School", icon: "🏫", type: "school"},
        {lat: 13.1405, lng: 123.6875, name: "Cemetery", icon: "⚰️", type: "cemetery"},
        {lat: 13.1440, lng: 123.6850, name: "Road Sign", icon: "🛣️", type: "road_sign"},
        {lat: 13.1430, lng: 123.6885, name: "Boundary Sign", icon: "🚧", type: "boundary_sign"}
    ];
    
    landmarks.forEach(landmark => {
        let marker = L.marker([landmark.lat, landmark.lng], {
            icon: L.divIcon({
                className: `landmark-marker ${landmark.type}`,
                html: landmark.icon,
                iconSize: [25, 25],
                iconAnchor: [12, 12]
            })
        }).bindPopup(`<strong>${landmark.name}</strong><br>Type: ${landmark.type.replace('_', ' ')}`);
        landmarksLayer.addLayer(marker);
    });
}

// Toggle landmarks
function toggleLandmarks(show) {
    if (show) {
        map.addLayer(landmarksLayer);
    } else {
        map.removeLayer(landmarksLayer);
    }
}

// Update legend based on active hazard layers
function updateLegend() {
    let legendContent = '<h4>Active Hazards</h4>';
    let hasActiveLayers = false;
    
    Object.keys(hazardLayers).forEach(hazardType => {
        if (map.hasLayer(hazardLayers[hazardType])) {
            let hazardData = hazardZonesData[hazardType];
            if (hazardData && hazardData.length > 0) {
                let color = hazardData[0].fillColor;
                legendContent += `<div class="legend-item">
                    <span class="legend-color" style="background-color: ${color}"></span>
                    <span class="legend-label">${hazardType.charAt(0).toUpperCase() + hazardType.slice(1)}</span>
                </div>`;
                hasActiveLayers = true;
            }
        }
    });
    
    if (hasActiveLayers) {
        if (!map.hasLayer(legendControl)) {
            legendControl.addTo(map);
        }
        document.querySelector('.legend').innerHTML = legendContent;
    } else {
        if (map.hasLayer(legendControl)) {
            map.removeControl(legendControl);
        }
    }
    
    // Update sidebar legend
    updateSidebarLegend();
}

// Update sidebar legend
function updateSidebarLegend() {
    let legendContainer = document.getElementById('hazard-legend');
    let legendContent = '';
    
    Object.keys(hazardLayers).forEach(hazardType => {
        if (map.hasLayer(hazardLayers[hazardType])) {
            let hazardData = hazardZonesData[hazardType];
            if (hazardData && hazardData.length > 0) {
                let color = hazardData[0].fillColor;
                legendContent += `<div class="legend-item mb-2">
                    <span class="legend-color me-2" style="display: inline-block; width: 20px; height: 20px; background-color: ${color}; border: 1px solid #ccc;"></span>
                    <span class="legend-label">${hazardType.charAt(0).toUpperCase() + hazardType.slice(1)}</span>
                </div>`;
            }
        }
    });
    
    if (legendContent === '') {
        legendContent = '<p class="text-muted">No hazards currently displayed</p>';
    }
    
    legendContainer.innerHTML = legendContent;
}

// Update main marker position based on selected purok
function updateMainMarkerPosition(purokId) {
    if (purokId && purokBoundariesData[purokId]) {
        // Move marker to center of selected purok
        let purok = purokBoundariesData[purokId];
        let purokCenter = calculateCentroid(purok.coordinates);
        mainMarker.setLatLng(purokCenter);
        mainMarker.setPopupContent(`${purok.name}<br>Population: ${purok.population}<br>Households: ${purok.households}`);
        map.setView(purokCenter, 16); // Zoom in a bit
    } else {
        // Return to default Barangay Ilawod position
        mainMarker.setLatLng([13.1421, 123.6857]);
        mainMarker.setPopupContent("Barangay Ilawod, Camalig, Albay");
        map.setView([13.1421, 123.6857], 15); // Default zoom
    }
}
