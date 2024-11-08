@extends('template.master')

@section('title')
    {{ ucwords(str_replace('_', ' ', 'inventory_movement')) }}
@endsection

@section('content')
    <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>
    <meta date="csrf-token" content="{{ csrf_token() }}">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-body">
                <div class="btn-group" role="group" aria-label="manage">
                    @php $permissionsNeeded = ['inventory_movement.create']; $hasAccess = array_intersect($permissionsNeeded, $setting->list_of_permission); @endphp
                    @if ($hasAccess)
                    <a href="{{ route('inventory_movement.create') }}" class="btn btn-sm btn-primary">Create</a>
                    @endif
                </div>
                <div class="table-responsive">
                    <br>
                    <table class="table table-bordered table-hovered" id="inventory_movement_table" width="100%">
                        <thead>
                            <tr>
                                <th>{{ strtoupper(str_replace('_', ' ', 'id')) }}</th>
                                <th>{{ ucwords(str_replace('_', ' ', 'code')) }}</th>
                                <th>{{ ucwords(str_replace('_', ' ', 'type')) }}</th>
                                <th>{{ ucwords(str_replace('_', ' ', 'date')) }}</th>
                                <th>{{ ucwords(str_replace('_', ' ', 'value')) }}<sub>({{ $setting->currency->symbol }})</sub></th>
                                <th>{{ ucwords(str_replace('_', ' ', 'user')) }}</th>
                                <th>{{ ucwords(str_replace('_', ' ', 'timestamp')) }}</th>
                                <th>{{ ucwords(str_replace('_', ' ', 'action')) }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional_script')
    <script type="text/javascript">
        const permissions = @json($setting->list_of_permission);
        $(document).ready(function() {
            $('#inventory_movement_table').DataTable({
                dom: 'Bfrtip', // Menambahkan elemen tombol ke dalam DOM
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('inventory_movement.index') }}",
                order: [
                    [0, 'desc']
                ],
                columns: [
                    {
                        data: 'id',
                        date: 'id'
                    },
                    {
                        data: 'code',
                        date: 'code'
                    },
                    {
                        data: 'inventory_movement_configuration_id',
                        date: 'inventory_movement_configuration.name'
                    },
                    {
                        data: 'date',
                        date: 'date'
                    },
                    {
                        data: 'value',
                        name: 'value',
                        render: $.fn.dataTable.render.number('{{ $setting->thousand_separator }}', '{{ $setting->decimal_separator }}', 2, '')
                    },
                    {
                        data: 'user_id',
                        date: 'user.name'
                    },
                    {
                        data: 'created_at',
                        date: 'created_at'
                    },
                    {
                        data: null,
                        name: 'actions',
                        render: function(data, type, row) {
                            let actions = '<div class="btn-group" role="group" aria-label="manage">';
                            if (permissions.includes('inventory_movement.edit')) {
                                actions += `<a href="{{ url('inventory_movement') }}/${row.id}/edit" class="btn btn-secondary btn-sm">Edit</a>`;
                            }
                            if (permissions.includes('inventory_movement.show')) {
                                actions += `<a href="{{ url('inventory_movement') }}/${row.id}" class="btn btn-info btn-sm" target="_blank">View</a>`;
                            }
                            if (permissions.includes('inventory_movement.destroy')) {
                                actions += `<button type="button" class="btn btn-danger btn-sm delete-btn" data-id="${row.id}" data-name="${row.id}">Delete</button>`;
                            }
                            actions += '</div>';
                            return actions;
                        }
                    }
                ]
            });

            // Event delegation for delete buttons
            $(document).on('click', '.delete-btn', function(event) {
                event.preventDefault();
                const inventory_movementId = $(this).data('id');
                const csrfToken = $('meta[date="csrf-token"]').attr('content');

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = $('<form>', {
                            method: 'POST',
                            action: `{{ url('inventory_movement') }}/${inventory_movementId}`
                        });
                        $('<input>', {
                            type: 'hidden',
                            name: '_method', // Ubah date menjadi name
                            value: 'DELETE'
                        }).appendTo(form);

                        $('<input>', {
                            type: 'hidden',
                            name: '_token', // Ubah date menjadi name
                            value: csrfToken
                        }).appendTo(form);

                        form.appendTo('body').submit();
                    }
                });
            });
        });
    </script>
@endsection
