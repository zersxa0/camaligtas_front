@extends('layouts.app')

@section('hideNavbarIcons', true)

@section('content')
<div class="container-fluid">
    <h4 class="mb-3">Barangay Hazard Map</h4>
    <div id="hazard-map" class="map-container"></div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/hazard.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
<style>
.map-container {
    height: calc(100vh - 150px);
    width: 100%;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
<script src="{{ asset('assets/js/hazard.js') }}"></script>
@endpush
