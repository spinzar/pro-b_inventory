@extends('template.master')

@section('title')
    {{ ucwords(str_replace('_', ' ', 'create inventory movement')) }}
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a
                        href="{{ route('inventory_movement.index') }}">{{ ucwords(str_replace('_', ' ', 'inventory movement')) }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">@yield('title')</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('inventory_movement.store') }}" method="POST" id="inventory_movement-form">
                            @csrf
                            @method('POST')

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="date">
                                    Date
                                </label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="date" name="date"
                                        value="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="inventory_movement_configuration_id">
                                    Type
                                </label>
                                <div class="col-sm-10">
                                    <select name="inventory_movement_configuration_id"
                                        id="inventory_movement_configuration_id" class="form-control select2" required>
                                        <option disabled selected>Select a Type:</option>
                                        @foreach ($inventory_movement_configurations as $imc)
                                            <option value="{{ $imc->id }}" data-stock="{{ $imc->stock }}">
                                                {{ $imc->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="inventory_movement-details-table">
                                            <thead>
                                                <tr>
                                                    <th style="width: 40%;">Material</th>
                                                    <th style="width: 10%;">In</th>
                                                    <th style="width: 10%;">Out</th>
                                                    <th style="width: 25%;">Value</th>
                                                    <th style="width: 15%;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <select name="details[0][material_id]"
                                                            class="form-control select2 material-select" onChange="updateUnits(this)" required>
                                                            <option disabled selected>Select a Material:</option>
                                                            @foreach ($materials as $material)
                                                                <option value="{{ $material->id }}"
                                                                    data-bulk_unit="{{ $material->bulk_unit->symbol }}"
                                                                    data-retail_unit="{{ $material->retail_unit->symbol }}
                                                                ">
                                                                    {{ $material->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text bulk_unit_name"></span>
                                                            </div>
                                                            <input type="text" step="any" name="details[0][bulk_in]"
                                                                class="form-control number-separator bulk_in" required>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text retail_unit_name"></span>
                                                            </div>
                                                            <input type="text" step="any"
                                                                name="details[0][retail_in]"
                                                                class="form-control number-separator retail_in" required>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text bulk_unit_name"></span>
                                                            </div>
                                                            <input type="text" step="any" name="details[0][bulk_out]"
                                                                class="form-control number-separator bulk_out" required>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text retail_unit_name"></span>
                                                            </div>
                                                            <input type="text" step="any"
                                                                name="details[0][retail_out]"
                                                                class="form-control number-separator retail_out" required>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span
                                                                    class="input-group-text">{{ $setting->currency->symbol }}</span>
                                                            </div>
                                                            <input type="text" name="details[0][value]"
                                                                class="form-control" readonly>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button"
                                                            class="btn btn-danger remove-row">Remove</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <button type="button" id="add-row" class="btn btn-success mt-3">Add Row</button>

                                    <div class="table-responsive">
                                        <table class="table table-bordered mt-4">
                                            <thead>
                                                <tr>
                                                    <th>Total Value</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span
                                                                    class="input-group-text">{{ $setting->currency->symbol }}</span>
                                                            </div>
                                                            <input type="text" id="total-credit" name="credit"
                                                                class="form-control" readonly>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-3" id="submit-button"
                                        disabled>Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('additional_script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function initializeSelect2() {
                $('.select2').select2({
                    theme: 'bootstrap',
                    width: '100%',
                });
            }
            initializeSelect2();
        });

        function updateUnits(selectElement) {
            const bulkUnit = selectElement.options[selectElement.selectedIndex].getAttribute('data-bulk_unit');
            const retailUnit = selectElement.options[selectElement.selectedIndex].getAttribute('data-retail_unit');
            const row = selectElement.closest('tr');
            row.querySelector('.bulk_unit_name').textContent = bulkUnit || '';
            row.querySelector('.retail_unit_name').textContent = retailUnit || '';
        }

            // Delegated event handling for material-select change
            document.getElementById('inventory_movement-details-table').addEventListener('change', function(event) {
                if (event.target.classList.contains('material-select')) {
                    console.log("Yes");
                }
                else {
                    console.log("No");
                }
            });

            document.getElementById('add-row').addEventListener('click', function() {
                const tableBody = document.querySelector('#inventory_movement-details-table tbody');
                let rowCount = tableBody.children.length;
                let newRow = `
                    <tr>
                        <td>
                            <select name="details[${rowCount}][material_id]" class="form-control select2 material-select" required>
                                <option disabled selected>Select a Material:</option>
                                @foreach ($materials as $material)
                                    <option value="{{ $material->id }}" data-bulk_unit="{{ $material->bulk_unit->symbol }}" data-retail_unit="{{ $material->retail_unit->symbol }}">{{ $material->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bulk_unit_name"></span>
                                </div>
                                <input type="text" step="any" name="details[${rowCount}][bulk_in]" class="form-control number-separator bulk_in" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text retail_unit_name"></span>
                                </div>
                                <input type="text" step="any" name="details[${rowCount}][retail_in]" class="form-control number-separator retail_in" required>
                            </div>
                        </td>
                        <td>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bulk_unit_name"></span>
                                </div>
                                <input type="text" step="any" name="details[${rowCount}][bulk_out]" class="form-control number-separator bulk_out" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text retail_unit_name"></span>
                                </div>
                                <input type="text" step="any" name="details[${rowCount}][retail_out]" class="form-control number-separator retail_out" required>
                            </div>
                        </td>
                        <td>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ $setting->currency->symbol }}</span>
                                </div>
                                <input type="text" name="details[${rowCount}][value]" class="form-control" readonly>
                            </div>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger remove-row">Remove</button>
                        </td>
                    </tr>
                `;
                tableBody.insertAdjacentHTML('beforeend', newRow);
                initializeSelect2();
            });
    </script>
@endsection

@endsection
