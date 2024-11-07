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
        @php
            $permissionsNeeded = ['dashboard'];
            $hasAccess = array_intersect($permissionsNeeded, $setting->list_of_permission);
        @endphp
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
        @php
            $permissionsNeeded = ['setting.index'];
            $hasAccess = array_intersect($permissionsNeeded, $setting->list_of_permission);
        @endphp
        @if ($hasAccess)
            <div class="col-lg-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h5 class="m-0 font-weight-bold text-danger">Settings</h5>
                    </div>
                    <div class="card-body">
                        <p>Configure system settings, including application preferences and global settings for your
                            organization.</p>
                        <a href="{{ route('setting.index') }}" class="btn btn-danger">Manage Settings</a>
                    </div>
                </div>
            </div>
        @endif

        <!-- Roles -->
        @php
            $permissionsNeeded = ['role.index'];
            $hasAccess = array_intersect($permissionsNeeded, $setting->list_of_permission);
        @endphp
        @if ($hasAccess)
            <div class="col-lg-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h5 class="m-0 font-weight-bold text-danger">Roles</h5>
                    </div>
                    <div class="card-body">
                        <p>Define and manage user roles and permissions within the system to control access to specific
                            features.</p>
                        <a href="{{ route('role.index') }}" class="btn btn-danger">Manage Roles</a>
                    </div>
                </div>
            </div>
        @endif

        <!-- Users -->
        @php
            $permissionsNeeded = ['user.index'];
            $hasAccess = array_intersect($permissionsNeeded, $setting->list_of_permission);
        @endphp
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
        @php
            $permissionsNeeded = ['activity_log.index'];
            $hasAccess = array_intersect($permissionsNeeded, $setting->list_of_permission);
        @endphp
        @if ($hasAccess)
            <div class="col-lg-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h5 class="m-0 font-weight-bold text-danger">Activity Log</h5>
                    </div>
                    <div class="card-body">
                        <p>Review system activity logs to track user actions, monitor changes, and ensure data integrity.
                        </p>
                        <a href="{{ route('activity_log.index') }}" class="btn btn-danger">View Activity Logs</a>
                    </div>
                </div>
            </div>
        @endif

        <!-- Warehouse -->
        @php
            $permissionsNeeded = ['warehouse.index'];
            $hasAccess = array_intersect($permissionsNeeded, $setting->list_of_permission);
        @endphp
        @if ($hasAccess)
            <div class="col-lg-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h5 class="m-0 font-weight-bold text-danger">Warehouse</h5>
                    </div>
                    <div class="card-body">
                        <p>Manage and monitor warehouse inventory, track incoming and outgoing goods, and ensure stock
                            accuracy.</p>
                        <a href="{{ route('warehouse.index') }}" class="btn btn-danger">View Warehouse</a>
                    </div>
                </div>
            </div>
        @endif

        <!-- Unit -->
        @php
            $permissionsNeeded = ['unit.index'];
            $hasAccess = array_intersect($permissionsNeeded, $setting->list_of_permission);
        @endphp
        @if ($hasAccess)
            <div class="col-lg-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h5 class="m-0 font-weight-bold text-danger">Unit</h5>
                    </div>
                    <div class="card-body">
                        <p>Define and manage measurement units used in inventory and transactions.</p>
                        <a href="{{ route('unit.index') }}" class="btn btn-danger">View Units</a>
                    </div>
                </div>
            </div>
        @endif

        <!-- Brand -->
        @php
            $permissionsNeeded = ['brand.index'];
            $hasAccess = array_intersect($permissionsNeeded, $setting->list_of_permission);
        @endphp
        @if ($hasAccess)
            <div class="col-lg-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h5 class="m-0 font-weight-bold text-danger">Brand</h5>
                    </div>
                    <div class="card-body">
                        <p>Manage brands associated with materials, enhancing categorization and reporting.</p>
                        <a href="{{ route('brand.index') }}" class="btn btn-danger">View Brands</a>
                    </div>
                </div>
            </div>
        @endif

        <!-- Material Category -->
        @php
            $permissionsNeeded = ['material_category.index'];
            $hasAccess = array_intersect($permissionsNeeded, $setting->list_of_permission);
        @endphp
        @if ($hasAccess)
            <div class="col-lg-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h5 class="m-0 font-weight-bold text-danger">Material Category</h5>
                    </div>
                    <div class="card-body">
                        <p>Organize materials by category for streamlined inventory management and reporting.</p>
                        <a href="{{ route('material_category.index') }}" class="btn btn-danger">View Material
                            Categories</a>
                    </div>
                </div>
            </div>
        @endif

        <!-- Business -->
        @php
            $permissionsNeeded = ['business.index'];
            $hasAccess = array_intersect($permissionsNeeded, $setting->list_of_permission);
        @endphp
        @if ($hasAccess)
            <div class="col-lg-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h5 class="m-0 font-weight-bold text-danger">Business</h5>
                    </div>
                    <div class="card-body">
                        <p>Manage business settings, profiles, and configurations essential for operations.</p>
                        <a href="{{ route('business.index') }}" class="btn btn-danger">View Business</a>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection
