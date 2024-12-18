@extends('template.master')

@section('title')
    {{ ucwords(str_replace('_', ' ', 'create_role')) }}
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route("role.index") }}">{{ ucwords(str_replace('_', ' ', 'role')) }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">@yield("title")</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">@yield('title')</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route("role.store") }}" method="POST">
                            @csrf @method("POST")

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="name">
                                    {{ ucwords(str_replace('_', ' ', 'name')) }}
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old("name") }}" required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label menu-section">{{ ucwords(str_replace('_', ' ', 'menus')) }}</label>
                                <div class="col-sm-10 menu-section">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="select_all">
                                        <label class="form-check-label" for="select_all">
                                            Select All
                                        </label>
                                    </div>
                                    <hr>
                                    <!-- Checkbox for each menu -->
                                    @foreach ($menus as $menu)
                                        <div class="form-check">
                                            <input class="form-check-input menu-checkbox" type="checkbox"
                                                name="menu_ids[]" value="{{ $menu->id }}"
                                                id="menu_{{ $menu->id }}">
                                            <label class="form-check-label" for="menu_{{ $menu->id }}">
                                                {{ $menu->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional_script')
    <script>
        document.getElementById('select_all').addEventListener('change', function() {
            let checkboxes = document.querySelectorAll('.menu-checkbox');
            checkboxes.forEach((checkbox) => {
                checkbox.checked = this.checked;
            });
        });
    </script>
@endsection
