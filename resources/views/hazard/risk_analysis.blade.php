
@extends('layouts.app')

@section('hideSidebar', true)

@section('content')
<div class="container mt-4">
    <h2>Risk Analysis</h2>
    <p>View and analyze hazard risks for different barangays. Select a barangay to see detailed risk data and recommendations.</p>

    <div class="row align-items-end mb-3">
        <div class="col-md-4">
            <label for="hazardType" class="form-label">Hazard Type</label>
            <select class="form-select" id="hazardType">
                <option selected disabled>Select Hazard</option>
                <option value="flood">Flood</option>
                <option value="landslide">Landslide</option>
                <option value="volcanic">Volcanic</option>
                <option value="ashfall">Ashfall</option>
                <option value="lahar">Lahar</option>
                <option value="mudflow">Mudflow</option>
                <option value="fire">Fire</option>
                <option value="wind">Wind</option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="purokName" class="form-label">Purok Name</label>
            <select class="form-select" id="purokName">
                <option selected disabled>Select Purok</option>
                <option value="1">Purok 1</option>
                <option value="2">Purok 2</option>
                <option value="3">Purok 3</option>
                <option value="4">Purok 4</option>
                <option value="5">Purok 5</option>
            </select>
        </div>
        <div class="col-md-4 text-end">
            <small class="text-muted">Last update: <span id="lastUpdate">{{ now()->format('Y-m-d H:i:s') }}</span></small>
        </div>
    </div>

    <div class="mb-3">
        <br><h5 class="mt-4">Risk Summary</h5>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-md-4">
            <div class="card border-primary" style="background-color: #cfe2ff;">
                <div class="card-body">
                    <h6 class="card-title">Hazard Level (per Purok)</h6>
                    <p class="card-text" id="hazardLevel"></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-warning" style="background-color: #fff3cd;">
                <div class="card-body">
                    <h6 class="card-title">Vulnerability Index</h6>
                    <p class="card-text" id="vulnerabilityIndex"></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-success" style="background-color: #d1e7dd;">
                <div class="card-body">
                    <h6 class="card-title">Population & Risk</h6>
                    <p class="card-text" id="populationRisk"></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-info" style="background-color: #cff4fc;">
                <div class="card-body">
                    <h6 class="card-title">Infrastructure Risk</h6>
                    <p class="card-text" id="infraRisk"></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-secondary" style="background-color: #e2e3e5;">
                <div class="card-body">
                    <h6 class="card-title">Vulnerability Data</h6>
                    <p class="card-text" id="vulnerabilityData"></p>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <button class="btn btn-primary me-2" id="showTableBtn" onclick="document.getElementById('riskTableWrapper').classList.toggle('d-none')">Show Table</button>
        <button class="btn btn-success" id="downloadBtn" onclick="downloadCSV()">Download Risk Report</button>
    </div>

    <div id="riskTableWrapper" class="d-none mb-3">
        <div class="table-responsive">
            <table class="table table-bordered" id="riskTable">
                <thead>
                    <tr>
                        <th>Purok</th>
                        <th>Hazard Exposure</th>
                        <th>Population</th>
                        <th>Vulnerable Group</th>
                        <th>Infrastructure at Risk</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data rows will be dynamically inserted here from your database -->
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
function downloadCSV() {
    let csv = [];
    const rows = document.querySelectorAll("#riskTable tr");
    for (let row of rows) {
        let cols = Array.from(row.querySelectorAll("th,td")).map(col => `"${col.innerText}"`);
        csv.push(cols.join(","));
    }
    const csvFile = new Blob([csv.join("\n")], { type: "text/csv" });
    const downloadLink = document.createElement("a");
    downloadLink.download = "risk_report.csv";
    downloadLink.href = window.URL.createObjectURL(csvFile);
    downloadLink.style.display = "none";
    document.body.appendChild(downloadLink);
    downloadLink.click();
    document.body.removeChild(downloadLink);
}
</script>
@endpush

@endsection