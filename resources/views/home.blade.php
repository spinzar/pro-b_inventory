@extends('template.master')

@section('content')

<h1 class="h3 mb-4 text-gray-800">Home</h1>

<!-- Jumbotron Section -->
{{-- <div class="jumbotron jumbotron-fluid bg-light text-center mb-4">
    <div class="container">
        <h1 class="display-4">Welcome to the {{ $setting->app_name }}</h1>
        <p class="lead">Manage your finances effectively with our comprehensive tools and features.</p>
    </div>
</div> --}}

<div class="row">
    <!-- Dashboard -->
    @php $permissionsNeeded = ['dashboard']; $hasAccess = array_intersect($permissionsNeeded, $setting->list_of_permission); @endphp
    @if ($hasAccess)
    <div class="col-lg-4">
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h5 class="m-0 font-weight-bold text-danger">Dashboard</h5>
            </div>
            <div class="card-body">
                <p>Overview of key financial metrics, recent activities, and performance summaries in one place.</p>
                <a href="{{ route('dashboard') }}" class="btn btn-danger">Go to Dashboard</a>
            </div>
        </div>
    </div>
    @endif

    <!-- Settings -->
    @php $permissionsNeeded = ['setting.index']; $hasAccess = array_intersect($permissionsNeeded, $setting->list_of_permission); @endphp
    @if ($hasAccess)
    <div class="col-lg-4">
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h5 class="m-0 font-weight-bold text-danger">Settings</h5>
            </div>
            <div class="card-body">
                <p>Configure system settings, including application preferences and global settings for your organization.</p>
                <a href="{{ route('setting.index') }}" class="btn btn-danger">Manage Settings</a>
            </div>
        </div>
    </div>
    @endif

    <!-- Roles -->
    @php $permissionsNeeded = ['role.index']; $hasAccess = array_intersect($permissionsNeeded, $setting->list_of_permission); @endphp
    @if ($hasAccess)
    <div class="col-lg-4">
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h5 class="m-0 font-weight-bold text-danger">Roles</h5>
            </div>
            <div class="card-body">
                <p>Define and manage user roles and permissions within the system to control access to specific features.</p>
                <a href="{{ route('role.index') }}" class="btn btn-danger">Manage Roles</a>
            </div>
        </div>
    </div>
    @endif

    <!-- Users -->
    @php $permissionsNeeded = ['user.index']; $hasAccess = array_intersect($permissionsNeeded, $setting->list_of_permission); @endphp
    @if ($hasAccess)
    <div class="col-lg-4">
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h5 class="m-0 font-weight-bold text-danger">Users</h5>
            </div>
            <div class="card-body">
                <p>Manage user accounts and profiles for individuals who have access to the system.</p>
                <a href="{{ route('user.index') }}" class="btn btn-danger">Manage Users</a>
            </div>
        </div>
    </div>
    @endif

    <!-- Activity Log -->
    @php $permissionsNeeded = ['activity_log.index']; $hasAccess = array_intersect($permissionsNeeded, $setting->list_of_permission); @endphp
    @if ($hasAccess)
    <div class="col-lg-4">
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h5 class="m-0 font-weight-bold text-danger">Activity Log</h5>
            </div>
            <div class="card-body">
                <p>Review system activity logs to track user actions, monitor changes, and ensure data integrity.</p>
                <a href="{{ route('activity_log.index') }}" class="btn btn-danger">View Activity Logs</a>
            </div>
        </div>
    </div>
    @endif

</div>

@endsection
