
@extends('layouts.app')

@section('hideSidebar', true)

@section('content')
<div class="container mt-4">
    <h2>Emergency Contacts Directory</h2>
    <p>Important contact information for emergency services and officials in Camalig, Albay</p>

    <div class="row mb-3">
        <div class="col-md-6">
            <select class="form-select" id="contactFilter" onchange="filterContacts()">
                <option value="all">View All Contacts</option>
                <option value="mdrrmo">MDRRMO</option>
                <option value="pnp">PNP</option>
                <option value="fire">Fire</option>
                <option value="health">Health</option>
                <option value="relief">Relief</option>
                <option value="lgu">LGU</option>
                <option value="volunteer">Volunteer</option>
                <option value="mayor">Mayor's Office</option>
                <option value="mayor">Barangay Officials</option>
            </select>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" id="contactSearch" placeholder="Search contacts..." onkeyup="filterContacts()">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered" id="contactsTable">
            <thead>
                <tr>
                    <th>Office Name</th>
                    <th>Address</th>
                    <th>Contact Number</th>
                </tr>
            </thead>
            <tbody>
                <tr data-type="mdrrmo">
                    <td>Municipal Disaster Risk Reduction and Management Office (MDRRMO) Camalig</td>
                    <td>Poblacion, Camalig, Albay</td>
                    <td>09473259363 / 09163294359</td>
                </tr>
                <tr data-type="pnp">
                    <td>Philippine National Police (PNP) Camalig</td>
                    <td>Poblacion, Camalig, Albay</td>
                    <td>09777808986</td>
                </tr>
                <tr data-type="fire">
                    <td>Bureau of Fire Protection (BFP) Camalig</td>
                    <td>Poblacion, Camalig, Albay</td>
                    <td>09178908823 / 09992265345</td>
                </tr>
                <tr data-type="health">
                    <td>Rural Health Unit (RHU) Camalig</td>
                    <td>Poblacion, Camalig, Albay</td>
                    <td>09178653935 / 09175591220</td>
                </tr>
                <tr data-type="health">
                    <td>Rapid Testing Facility and Isolation Facility Camalig</td>
                    <td>Community Training Center, Salugan, Camalig</td>
                    <td>09163233493</td>
                </tr>
                <tr data-type="health">
                    <td>Bicol Regional Training and Teaching Hospital (BRTTH)</td>
                    <td>Rizal St., Sagpon, Daraga, Albay</td>
                    <td>732 5555 / 732 5501</td>
                </tr>
                <tr data-type="lgu">
                    <td>Bureau of Jail Management and Penology (BJMP) Camalig</td>
                    <td>Poblacion, Camalig, Albay</td>
                    <td>09121524121</td>
                </tr>
                <tr data-type="lgu">
                    <td>Department of the Interior and Local Government (DILG) Camalig</td>
                    <td>Poblacion, Camalig, Albay</td>
                    <td>09273723791</td>
                </tr>
                <tr data-type="lgu">
                    <td>Albay Power and Energy (APEC)</td>
                    <td>W. Vinzons St., Old Albay District, Legazpi City, 4500 Albay</td>
                    <td>09292683904 / 09957296332</td>
                </tr>
                <tr data-type="mdrrmo">
                    <td>Barangay Disaster Risk Reduction and Management Committee (BDRRMC)/ Barangay Health Emergency Response Team (BHERT)</td>
                    <td>...</td>
                    <td>09063744630</td>
                </tr>
                <tr data-type="health">
                    <td>BOC - Holy Face Rehabilitation Center for Mental Health</td>
                    <td>Tabiguian, Tabaco City, Albay</td>
                    <td>09206915015</td>
                </tr>
                <tr data-type="volunteer">
                    <td>Simon of Cyrene Community Rehabilitation and Development Fdn, Inc.</td>
                    <td>286 Bañag, Daraga, Albay</td>
                    <td>(052)7420710 / (052)4312554</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script>
function filterContacts() {
    const filter = document.getElementById('contactFilter').value;
    const search = document.getElementById('contactSearch').value.toLowerCase();
    const rows = document.querySelectorAll('#contactsTable tbody tr');
    rows.forEach(row => {
        const type = row.getAttribute('data-type');
        const text = row.innerText.toLowerCase();
        const matchesType = (filter === 'all' || type === filter);
        const matchesSearch = text.includes(search);
        row.style.display = (matchesType && matchesSearch) ? '' : 'none';
    });
}
</script>
@endpush
@endsection