@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h4 class="mb-3">Barangay Hazard Map</h4>
    <div id="hazard-map" class="map-container"></div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/hazard.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/js/hazard.js') }}"></script>
@endpush
