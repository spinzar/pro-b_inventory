@extends('template.master')

@section('title')
    {{ ucwords(str_replace('_', ' ', 'create_inventory_movement')) }}
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('inventory_movement.index') }}">{{ ucwords(str_replace('_', ' ', 'inventory_movement')) }}</a></li>
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
                                    {{ ucwords(str_replace('_', ' ', 'date')) }}
                                </label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="date" name="date" value="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="inventory_movement_configuration_id">
                                    {{ ucwords(str_replace('_', ' ', 'type')) }}
                                </label>
                                <div class="col-sm-10">
                                    <select name="inventory_movement_configuration_id" id="inventory_movement_configuration_id" class="form-control select2" required>
                                        <option disabled selected>Select a Type:</option>
                                        @foreach($inventory_movement_configurations as $imc)
                                            <option value="{{ $imc->id }}">{{ $imc->name }}</option>
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
                                                    <select name="details[0][material_id]" class="form-control select2" required>
                                                        <option disabled selected>Select an Material:</option>
                                                        @foreach($materials as $material)
                                                            <option
                                                                value="{{ $material->id }}"
                                                                data-bulk_unit="{{ $material->bulk_unit->symbol }}"
                                                                data-retail_unit="{{ $material->retail_unit->symbol }}"
                                                            >{{ $material->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="bulk_unit_name"></span>
                                                        </div>
                                                        <input type="text" step="any" id="details[0][bulk_in]" name="details[0][bulk_in]" class="form-control number-separator" required>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="retail_unit_name"></span>
                                                        </div>
                                                        <input type="text" step="any" id="details[0][retail_in]" name="details[0][retail_in]" class="form-control number-separator" required>
                                                    </div>
                                                </td>
                                                <td></td>
                                                <td>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">{{ $setting->currency->symbol }}</span>
                                                        </div>
                                                        <input type="text" id="details[0][retail_in]" name="details[0][value]" class="form-control" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger remove-row">Remove</button>
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
                                                            <span class="input-group-text" id="basic-addon1">{{ $setting->currency->symbol }}</span>
                                                        </div>
                                                        <input type="text" id="total-credit" name="credit" class="form-control" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-3" id="submit-button" disabled>Save</button>
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
            document.addEventListener('DOMContentLoaded', function () {
                let rowCount = 1;

                function initializeSelect2() {
                    $('.select2').select2({
                        placeholder: "Select an Material",
                        theme: 'bootstrap',
                        width: '100%',
                    });
                }

                initializeSelect2();

                function updateTotals() {
                    let totalDebit = 0;
                    let totalCredit = 0;

                    // Ambil pemisah dari setting
                    const thousandSeparator = '{{ $setting->thousand_separator }}';
                    const decimalSeparator = '{{ $setting->decimal_separator }}';

                    // Hitung total debit
                    document.querySelectorAll('.debit').forEach(input => {
                        // Ganti pemisah ribuan dan desimal sebelum parsing
                        const value = input.value
                            .replace(new RegExp('\\' + thousandSeparator, 'g'), '') // Hapus pemisah ribuan
                            .replace(new RegExp('\\' + decimalSeparator, 'g'), '.'); // Ganti pemisah desimal menjadi titik
                        totalDebit += parseFloat(value) || 0;
                    });

                    // Hitung total kredit
                    document.querySelectorAll('.credit').forEach(input => {
                        const value = input.value
                            .replace(new RegExp('\\' + thousandSeparator, 'g'), '') // Hapus pemisah ribuan
                            .replace(new RegExp('\\' + decimalSeparator, 'g'), '.'); // Ganti pemisah desimal menjadi titik
                        totalCredit += parseFloat(value) || 0;
                    });

                    document.getElementById('total-debit').value = totalDebit.toLocaleString('{{ $setting->locale_string }}');
                    document.getElementById('total-credit').value = totalCredit.toLocaleString('{{ $setting->locale_string }}');

                    document.getElementById('submit-button').disabled = !(totalDebit > 0 && totalDebit === totalCredit);
                }

                document.getElementById('add-row').addEventListener('click', function () {
                    let tableBody = document.querySelector('#inventory_movement-details-table tbody');
                    let newRow = `
                        <tr>
                            <td>
                                <select name="details[${rowCount}][material_id]" class="form-control select2" required>
                                    <option disabled selected>Select an Material:</option>
                                    @foreach($materials as $material)
                                        <option value="{{ $material->id }}">{{ $material->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" name="details[${rowCount}][description]" class="form-control" placeholder="Description" required>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">{{ $setting->currency->symbol }}</span>
                                    </div>
                                    <input type="text" name="details[${rowCount}][debit]" class="form-control debit number-separator" step="0.01" value="0" required>
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">{{ $setting->currency->symbol }}</span>
                                    </div>
                                    <input type="text" name="details[${rowCount}][credit]" class="form-control credit number-separator" step="0.01" value="0" required>
                                </div>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger remove-row">Remove</button>
                            </td>
                        </tr>
                    `;
                    tableBody.insertAdjacentHTML('beforeend', newRow);
                    initializeSelect2();
                    easyNumberSeparator({
                        selector: '.number-separator',
                        separator: '{{ $setting->thousand_separator }}',
                        decimalSeparator: '{{ $setting->decimal_separator }}',
                    });
                    rowCount++;
                    updateTotals();
                });

                document.querySelector('#inventory_movement-details-table').addEventListener('click', function (e) {
                    if (e.target.classList.contains('remove-row')) {
                        e.target.closest('tr').remove();
                        updateTotals();
                    }
                });

                document.querySelector('#inventory_movement-details-table').addEventListener('input', function (e) {
                    if (e.target.classList.contains('debit') || e.target.classList.contains('credit')) {
                        updateTotals();
                    }
                });

                updateTotals();
            });
        </script>
    @endsection
@endsection
