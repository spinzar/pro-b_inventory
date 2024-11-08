@extends('template.master')

@section('title')
    {{ ucwords(str_replace('_', ' ', 'edit_material')) }}
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route("material.index") }}">{{ ucwords(str_replace('_', ' ', 'material')) }}</a></li>
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
                        <form action="{{ route("material.update", $material->id) }}" method="POST">
                            @csrf
                            @method("PUT")

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="name">
                                    {{ ucwords(str_replace('_', ' ', 'name')) }}
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $material->name }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="bulk_unit_id">
                                    {{ ucwords(str_replace('_', ' ', 'bulk unit')) }}
                                </label>
                                <div class="col-sm-10">
                                    <select class="form-control select2 @error('bulk_unit_id') is-invalid @enderror" id="bulk_unit_id" name="bulk_unit_id" required>
                                        <option disabled selected>Select a bulk unit</option>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}" {{ $unit->id == $material->bulk_unit_id ? 'selected' : '' }}>
                                                {{ ucwords(str_replace('_', ' ', $unit->name)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('bulk_unit_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="contains">
                                    {{ ucwords(str_replace('_', ' ', 'contains')) }}
                                </label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control @error('contains') is-invalid @enderror" id="contains" name="contains" value="{{ $material->contains }}" required>
                                    @error('contains')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="retail_unit_id">
                                    {{ ucwords(str_replace('_', ' ', 'retail unit')) }}
                                </label>
                                <div class="col-sm-10">
                                    <select class="form-control select2 @error('retail_unit_id') is-invalid @enderror" id="retail_unit_id" name="retail_unit_id" required>
                                        <option disabled selected>Select a retail unit</option>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}" {{ $unit->id == $material->retail_unit_id ? 'selected' : '' }}>
                                                {{ ucwords(str_replace('_', ' ', $unit->name)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('retail_unit_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="brand_id">
                                    {{ ucwords(str_replace('_', ' ', 'brand')) }}
                                </label>
                                <div class="col-sm-10">
                                    <select class="form-control select2 @error('brand_id') is-invalid @enderror" id="brand_id" name="brand_id" required>
                                        <option disabled selected>Select a brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ $brand->id == $material->brand_id ? 'selected' : '' }}>
                                                {{ ucwords(str_replace('_', ' ', $brand->name)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="material_category_id">
                                    {{ ucwords(str_replace('_', ' ', 'material_category')) }}
                                </label>
                                <div class="col-sm-10">
                                    <select class="form-control select2 @error('material_category_id') is-invalid @enderror" id="material_category_id" name="material_category_id" required>
                                        <option disabled selected>Select a material_category</option>
                                        @foreach ($material_categories as $material_category)
                                            <option value="{{ $material_category->id }}" {{ $material_category->id == $material->material_category_id ? 'selected' : '' }}>
                                                {{ ucwords(str_replace('_', ' ', $material_category->name)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('material_category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="bulk_barcode">
                                    {{ ucwords(str_replace('_', ' ', 'bulk barcode')) }}
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('bulk_barcode') is-invalid @enderror" id="bulk_barcode" name="bulk_barcode" value="{{ $material->bulk_barcode }}">
                                    @error('bulk_barcode')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="retail_barcode">
                                    {{ ucwords(str_replace('_', ' ', 'retail barcode')) }}
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('retail_barcode') is-invalid @enderror" id="retail_barcode" name="retail_barcode" value="{{ $material->retail_barcode }}">
                                    @error('retail_barcode')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="bulk_buy_price">
                                    {{ ucwords(str_replace('_', ' ', 'bulk_buy_price')) }}<sub>({{ $setting->currency->symbol }})</sub>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control number-separator @error('bulk_buy_price') is-invalid @enderror" id="bulk_buy_price" name="bulk_buy_price" value="{{ $material->bulk_buy_price }}" step="0.01" required>
                                    @error('bulk_buy_price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="retail_buy_price">
                                    {{ ucwords(str_replace('_', ' ', 'retail_buy_price')) }}<sub>({{ $setting->currency->symbol }})</sub>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control number-separator @error('retail_buy_price') is-invalid @enderror" id="retail_buy_price" name="retail_buy_price" value="{{ $material->retail_buy_price }}" step="0.01" required>
                                    @error('retail_buy_price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="bulk_sell_price">
                                    {{ ucwords(str_replace('_', ' ', 'bulk_sell_price')) }}<sub>({{ $setting->currency->symbol }})</sub>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control number-separator @error('bulk_sell_price') is-invalid @enderror" id="bulk_sell_price" name="bulk_sell_price" value="{{ $material->bulk_sell_price }}" step="0.01">
                                    @error('bulk_sell_price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="retail_sell_price">
                                    {{ ucwords(str_replace('_', ' ', 'retail_sell_price')) }}<sub>({{ $setting->currency->symbol }})</sub>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control number-separator @error('retail_sell_price') is-invalid @enderror" id="retail_sell_price" name="retail_sell_price" value="{{ $material->retail_sell_price }}" step="0.01">
                                    @error('retail_sell_price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
        $('#bulk_unit_id, #retail_unit_id, #brand_id, #material_category_id').select2({
            theme: 'bootstrap',
            placeholder: "Select an option"
        });
    });
    easyNumberSeparator({
        selector: '.number-separator',
        separator: '{{ $setting->thousand_separator }}',
        decimalSeparator: '{{ $setting->decimal_separator }}',
    });
</script>
@endsection
