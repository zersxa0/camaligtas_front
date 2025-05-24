
@extends('layouts.app')

@section('hideSidebar', true)

@section('content')
<div class="container mt-4">
    <h2>Evacuation Centers</h2>
    <p>Filter by Purok to view nearby evacuation centers, manage their status, coordinators, and view activity logs.</p>

    <div class="row mb-3">
        <div class="col-md-4">
            <label for="purokFilter" class="form-label">Filter by Purok</label>
            <select class="form-select" id="purokFilter" onchange="filterCenters()">
                <option value="all">All Puroks</option>
                <option value="1">Purok 1</option>
                <option value="2">Purok 2</option>
                <option value="3">Purok 3</option>
                <option value="4">Purok 4</option>
                <option value="5">Purok 5</option>
            </select>
        </div>
        <div class="col-md-4">
            <button class="btn btn-info mt-4" onclick="showMapCenter()">Show Map Center per Purok</button>
        </div>
        <div class="col-md-4 text-end">
            <button class="btn btn-primary mt-4" onclick="openCoordinatorModal('add')">Add Coordinator</button>
        </div>
    </div>

    <div class="table-responsive mb-4">
        <table class="table table-bordered" id="centersTable">
            <thead>
                <tr>
                    <th>Center Name</th>
                    <th>Purok</th>
                    <th>Status</th>
                    <th>Coordinator</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example static data, replace with dynamic data from DB -->
                <tr data-purok="1" data-contact="09171234567">
                    <td>Camalig Central School</td>
                    <td>Purok 1</td>
                    <td>
                        <select class="form-select form-select-sm" onchange="setStatus(this)">
                            <option value="open">Open</option>
                            <option value="full">Full</option>
                            <option value="closed">Closed</option>
                        </select>
                    </td>
                    <td>Juan Dela Cruz</td>
                    <td>
                        <button class="btn btn-sm btn-secondary" onclick="openCoordinatorModal('edit', this)">Edit</button>
                        <button class="btn btn-sm btn-danger" onclick="openCoordinatorModal('delete', this)">Delete</button>
                    </td>
                </tr>
                <tr data-purok="2" data-contact="09179876543">
                    <td>Barangay Hall 2</td>
                    <td>Purok 2</td>
                    <td>
                        <select class="form-select form-select-sm" onchange="setStatus(this)">
                            <option value="open">Open</option>
                            <option value="full">Full</option>
                            <option value="closed">Closed</option>
                        </select>
                    </td>
                    <td>Maria Santos</td>
                    <td>
                        <button class="btn btn-sm btn-secondary" onclick="openCoordinatorModal('edit', this)">Edit</button>
                        <button class="btn btn-sm btn-danger" onclick="openCoordinatorModal('delete', this)">Delete</button>
                    </td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>

    <div class="card mb-4">
        <div class="card-header fw-bold">Evacuation Center Activity Logs</div>
        <div class="card-body" style="max-height: 250px; overflow-y: auto;">
            <ul class="list-group" id="logsList">
                <!-- Logs will be dynamically loaded from the database -->
            </ul>
        </div>
    </div>
</div>

<!-- Coordinator Modal -->
<div class="modal fade" id="coordinatorModal" tabindex="-1" aria-labelledby="coordinatorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="coordinatorForm">
        <div class="modal-header">
          <h5 class="modal-title" id="coordinatorModalLabel">Coordinator</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Fields for add/edit coordinator -->
          <div id="coordinatorFormFields">
            <div class="mb-3">
              <label for="coordinatorName" class="form-label">Coordinator Name</label>
              <input type="text" class="form-control" id="coordinatorName" name="coordinatorName" required>
            </div>
            <div class="mb-3">
              <label for="coordinatorContact" class="form-label">Contact Number</label>
              <input type="text" class="form-control" id="coordinatorContact" name="coordinatorContact" required>
            </div>
          </div>
          <!-- Delete confirmation -->
          <div id="deleteConfirmation" class="text-danger d-none">
            Are you sure you want to delete this coordinator?
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" id="coordinatorSaveBtn">Save</button>
          <button type="button" class="btn btn-danger d-none" id="coordinatorDeleteBtn">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>

@push('scripts')
<script>
let editingRow = null;

function filterCenters() {
    const purok = document.getElementById('purokFilter').value;
    document.querySelectorAll('#centersTable tbody tr').forEach(row => {
        if (purok === 'all' || row.getAttribute('data-purok') === purok) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}
function setStatus(select) {
    // Here you would send an AJAX request to update status in DB and add a log entry
    // No log is added here since logs should come from DB
}
function showMapCenter() {
    // Show map modal or redirect to map view (implement as needed)
    alert('Show Map Center per Purok feature');
}

// Modal logic for add/edit/delete coordinator
function openCoordinatorModal(action, btn = null) {
    const modal = new bootstrap.Modal(document.getElementById('coordinatorModal'));
    const formFields = document.getElementById('coordinatorFormFields');
    const deleteConfirmation = document.getElementById('deleteConfirmation');
    const saveBtn = document.getElementById('coordinatorSaveBtn');
    const deleteBtn = document.getElementById('coordinatorDeleteBtn');
    const nameInput = document.getElementById('coordinatorName');
    const contactInput = document.getElementById('coordinatorContact');

    editingRow = null;

    if (action === 'add') {
        document.getElementById('coordinatorModalLabel').innerText = 'Add Coordinator';
        formFields.classList.remove('d-none');
        deleteConfirmation.classList.add('d-none');
        saveBtn.classList.remove('d-none');
        deleteBtn.classList.add('d-none');
        nameInput.value = '';
        contactInput.value = '';
    } else if (action === 'edit') {
        document.getElementById('coordinatorModalLabel').innerText = 'Edit Coordinator';
        formFields.classList.remove('d-none');
        deleteConfirmation.classList.add('d-none');
        saveBtn.classList.remove('d-none');
        deleteBtn.classList.add('d-none');
        if (btn) {
            editingRow = btn.closest('tr');
            nameInput.value = editingRow.children[3].innerText;
            contactInput.value = editingRow.getAttribute('data-contact') || '';
        }
    } else if (action === 'delete') {
        document.getElementById('coordinatorModalLabel').innerText = 'Delete Coordinator';
        formFields.classList.add('d-none');
        deleteConfirmation.classList.remove('d-none');
        saveBtn.classList.add('d-none');
        deleteBtn.classList.remove('d-none');
        if (btn) {
            editingRow = btn.closest('tr');
        }
    }
    modal.show();
}

// Prevent form submission for demo
document.getElementById('coordinatorForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const name = document.getElementById('coordinatorName').value;
    const contact = document.getElementById('coordinatorContact').value;
    if (editingRow) {
        // Edit mode: update the row in the table
        editingRow.children[3].innerText = name;
        editingRow.setAttribute('data-contact', contact);
    } else {
        // Add mode: you would add a new row here (not implemented for demo)
    }
    bootstrap.Modal.getInstance(document.getElementById('coordinatorModal')).hide();
});
document.getElementById('coordinatorDeleteBtn').addEventListener('click', function() {
    if (editingRow) {
        editingRow.remove();
    }
    bootstrap.Modal.getInstance(document.getElementById('coordinatorModal')).hide();
});
</script>
@endpush
@endsection