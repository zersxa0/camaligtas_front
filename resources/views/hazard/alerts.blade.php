
@extends('layouts.app')

@section('hideSidebar', true)

@php
    // Prevent undefined variable error if $alerts is not passed
    $alerts = $alerts ?? collect();
    $today = $today ?? \Carbon\Carbon::now()->format('Y-m-d');
@endphp

@section('content')
<div class="container mt-4">
    <h2>Alerts</h2>
    <p>See the latest disaster alerts and warnings for Camalig. Stay updated and take necessary precautions.</p>

    <div class="row" style="min-height: 70vh;">
        <!-- Create New Alert (Left Column, now wider) -->
        <div class="col-lg-7 col-md-7 mb-4 d-flex flex-column" style="height: 100%;">
            <div class="card mb-4 flex-grow-1">
                <div class="card-header fw-bold">Create New Alert</div>
                <div class="card-body">
                    <form>
                        <div class="mb-2">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" placeholder="Enter alert title">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Hazard Type</label>
                            <input type="text" class="form-control" placeholder="Enter hazard type">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Alert Level</label>
                            <select class="form-select" aria-label="Alert Level">
                                <option selected disabled>Select alert level</option>
                                <option value="Blue">Blue</option>
                                <option value="White">White</option>
                                <option value="Red">Red</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Alert Description</label>
                            <textarea class="form-control" rows="3" placeholder="Enter alert description"></textarea>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Date</label>
                            <input type="datetime-local" class="form-control">
                        </div>
                        <div class="mb-3 form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="alertActive" checked>
                            <label class="form-check-label" for="alertActive">Active</label>
                        </div>
                        <button type="submit" class="btn btn-danger w-100">Create Alert</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Active Alerts and Alert Level Guide (Right Column, now narrower) -->
        <div class="col-lg-5 col-md-5 d-flex flex-column" style="height: 100%;">
            <div class="card mb-4 flex-grow-1" style="min-height: 300px; max-height: 350px;">
                <div class="card-header fw-bold">Active Alerts</div>
                <div class="card-body p-2" style="overflow-y: auto; max-height: 250px;">
                    {{-- Debug output to help you see what is being compared --}}
                    @foreach($alerts as $alert)
                        <div style="font-size:12px;color:#888;">
                            Alert: {{ $alert->title }} | data-date: {{ \Carbon\Carbon::parse($alert->date)->format('Y-m-d') }} | $today: {{ $today }} | active: {{ $alert->active }}
                        </div>
                    @endforeach
                    @forelse($alerts as $alert)
                        <div class="mb-2 border-bottom pb-2 disaster-alert"
                             data-title="{{ $alert->title }}"
                             data-description="{{ $alert->description }}"
                             data-hazard="{{ $alert->hazard_type }}"
                             data-level="{{ $alert->level }}"
                             data-date="{{ \Carbon\Carbon::parse($alert->date)->format('Y-m-d') }}">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="fw-bold">{{ $alert->title }}</span>
                                    @if($alert->level === 'Red')
                                        <span class="badge bg-danger ms-2">Red</span>
                                    @elseif($alert->level === 'Blue')
                                        <span class="badge bg-primary ms-2">Blue</span>
                                    @elseif($alert->level === 'White')
                                        <span class="badge bg-light text-dark border ms-2">White</span>
                                    @endif
                                </div>
                                <small class="text-muted">{{ $alert->created_at->format('Y-m-d H:i') }}</small>
                            </div>
                            <div class="text-muted small mb-1">{{ $alert->description }}</div>
                            <div>
                                <label class="form-check-label me-2">Active</label>
                                <input type="checkbox" {{ $alert->active ? 'checked' : '' }} disabled>
                            </div>
                        </div>
                    @empty
                        <div class="text-muted text-center">No active alerts.</div>
                    @endforelse
                </div>
            </div>
            <!-- Alert Level Guide (Lower Right) -->
            <div class="card mt-auto">
                <div class="card-header fw-bold">Alert Level Guide</div>
                <div class="card-body p-2">
                    <div class="mb-2 d-flex align-items-center">
                        <span class="badge bg-light text-dark border me-2" style="width:60px;">White</span>
                        <div>
                            <span class="fw-bold">Monitoring</span>
                            <div class="small text-muted">No immediate threat. Situation is being monitored.</div>
                        </div>
                    </div>
                    <div class="mb-2 d-flex align-items-center">
                        <span class="badge bg-primary me-2" style="width:60px;">Blue</span>
                        <div>
                            <span class="fw-bold">Alert</span>
                            <div class="small text-muted">Potential threat identified. Stay alert and prepared.</div>
                        </div>
                    </div>
                    <div class="mb-2 d-flex align-items-center">
                        <span class="badge bg-danger me-2" style="width:60px;">Red</span>
                        <div>
                            <span class="fw-bold">Warning</span>
                            <div class="small text-muted">Immediate threat. Take action and follow instructions.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function playBeep() {
    var beep = new Audio('https://actions.google.com/sounds/v1/alarms/alarm_clock.ogg');
    beep.play();
}

document.addEventListener('DOMContentLoaded', function() {
    const today = "{{ $today }}";
    let found = false;
    document.querySelectorAll('.disaster-alert').forEach(function(alertDiv) {
        const alertDate = alertDiv.getAttribute('data-date');
        // Compare only the date part (alertDate is already Y-m-d)
        if (alertDate === today && !found) {
            found = true;
            playBeep();
            const title = alertDiv.getAttribute('data-title');
            const desc = alertDiv.getAttribute('data-description');
            const hazard = alertDiv.getAttribute('data-hazard');
            const level = alertDiv.getAttribute('data-level');
            setTimeout(function() {
                alert(
                    "ALERT: " + title + "\n" +
                    "Hazard: " + hazard + "\n" +
                    "Level: " + level + "\n" +
                    "Description: " + desc
                );
            }, 500);
        }
    });
});
</script>
@endpush