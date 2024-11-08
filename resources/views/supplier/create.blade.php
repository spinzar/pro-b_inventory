@extends('template.master')

@section('title')
    {{ ucwords(str_replace('_', ' ', 'create_supplier')) }}
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route("supplier.index") }}">{{ ucwords(str_replace('_', ' ', 'supplier')) }}</a></li>
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
                        <form action="{{ route("supplier.store") }}" method="POST">
                            @csrf
                            @method("POST")

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="name">
                                    {{ ucwords(str_replace('_', ' ', 'name')) }}
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old("name") }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="business_id">
                                    {{ ucwords(str_replace('_', ' ', 'business')) }}
                                </label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" id="business_id" name="business_id" required autofocus>
                                        <option disabled selected>Select an supplier group:</option>
                                        @foreach ($businesss as $business)
                                            <option value="{{ $business->id }}">{{ ucwords(str_replace('_', ' ', $business->name)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="address">
                                    {{ ucwords(str_replace('_', ' ', 'address')) }}
                                </label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="address" name="address" required>{{ old("address") }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="phone">
                                    {{ ucwords(str_replace('_', ' ', 'phone')) }}
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old("phone") }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="email">
                                    {{ ucwords(str_replace('_', ' ', 'email')) }}
                                </label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old("email") }}">
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#business_id').select2({
            theme: 'bootstrap',
            placeholder: "Select an supplier group"
        });
    });
</script>
@endsection
