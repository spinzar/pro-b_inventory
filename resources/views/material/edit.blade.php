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
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old("name", $material->name) }}" required>
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
                                        <option disabled>Select a bulk unit</option>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}" {{ old('bulk_unit_id', $material->bulk_unit_id) == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('bulk_unit_id')
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
                                        <option disabled>Select a retail unit</option>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}" {{ old('retail_unit_id', $material->retail_unit_id) == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
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
                                        <option disabled>Select a brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ old('brand_id', $material->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="material_category_id">
                                    {{ ucwords(str_replace('_', ' ', 'material category')) }}
                                </label>
                                <div class="col-sm-10">
                                    <select class="form-control select2 @error('material_category_id') is-invalid @enderror" id="material_category_id" name="material_category_id" required>
                                        <option disabled>Select a material category</option>
                                        @foreach ($material_categories as $category)
                                            <option value="{{ $category->id }}" {{ old('material_category_id', $material->material_category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
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
                                    <input type="text" class="form-control @error('bulk_barcode') is-invalid @enderror" id="bulk_barcode" name="bulk_barcode" value="{{ old("bulk_barcode", $material->bulk_barcode) }}">
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
                                    <input type="text" class="form-control @error('retail_barcode') is-invalid @enderror" id="retail_barcode" name="retail_barcode" value="{{ old("retail_barcode", $material->retail_barcode) }}">
                                    @error('retail_barcode')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="buy_price">
                                    {{ ucwords(str_replace('_', ' ', 'buy price')) }}
                                </label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control number-separator @error('buy_price') is-invalid @enderror" id="buy_price" name="buy_price" value="{{ old("buy_price", $material->buy_price) }}" step="0.01" required>
                                    @error('buy_price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="sell_price">
                                    {{ ucwords(str_replace('_', ' ', 'sell price')) }}
                                </label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control number-separator @error('sell_price') is-invalid @enderror" id="sell_price" name="sell_price" value="{{ old("sell_price", $material->sell_price) }}" step="0.01" required>
                                    @error('sell_price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
