@extends('layouts.app')
@section('hideSidebar', true)

@section('content')
<div class="container mt-4">
    <h2>
        Welcome, Admin!
    </h2>
    <p>This dashboard provides real-time information and tools for disaster risk management in Camalig.</p>
    <div class="card mt-4">
        <div class="card-header bg-primary text-white">
            Admin Actions
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">View</li>
                <li class="list-group-item">Update</li>
                <li class="list-group-item">Delete</li>
                <li class="list-group-item">Manage Access</li>
                <li class="list-group-item">Send Live Notification</li>
            </ul>
        </div>
    </div>
</div>
@endsection