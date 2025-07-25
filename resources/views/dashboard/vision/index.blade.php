@extends('dashboard.layouts.app')
@push('css')
    <style>
        /* Custom Toggle Switch */
        .toggle-status {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .toggle-status input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: 0.4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            border-radius: 50%;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: 0.4s;
        }

        /* When the switch is checked */
        input:checked+.slider {
            background-color: #4CAF50;
        }

        input:checked+.slider:before {
            transform: translateX(26px);
        }

        .off-text {
            position: absolute;
            top: 6px;
            left: 10px;
            color: #ffffff;
            font-size: 12px;
            font-weight: bold;
        }

        .on-text {
            position: absolute;
            top: 6px;
            right: 10px;
            color: #ffffff;
            font-size: 12px;
            font-weight: bold;
        }
    </style>
@endpush
@section('content')
    <div id="kt_app_content_container" class="app-container  container-xxl ">
        <div class="card-toolbar mb-4">
            <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">

                <a href="{{ route('vision.create') }}" class="btn btn-sm btn-primary">
                    Add Vision
                </a>
            </div>
        </div>
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header border-1 pt-6">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <h4>Vision List</h4>
                    </div>
                    <!--end::Search-->
                </div>
                <!--begin::Card title-->

                <!--begin::Card toolbar-->
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="table-responsive theme-scrollbar">

                <!--begin::Table-->
                <table id="example1" class="table yajra-datatable">
                    <thead>
                        <tr class="text-start text-black-500 fw-bold fs-7 text-uppercase gs-0">
                            <th>S.N</th>
                            <th>Type</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th class="min-w-70px">Actions</th>
                        </tr>
                    </thead>

                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    $(function() {

        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('vision.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'type', name: 'type' },
                { data: 'title', name: 'title' },
                { 
                    data: 'status', 
                    name: 'status',
                    render: function(data, type, row) {
                        return `
                            <label class="toggle-status">
                                <input type="checkbox" class="status-toggle" 
                                    data-id="${row.id}" 
                                    data-model="vision" 
                                    ${data ? 'checked' : ''} />
                                <span class="slider">
                                    <span class="off-text">Off</span>
                                    <span class="on-text">On</span>
                                </span>
                            </label>
                        `;
                    },
                    orderable: false,
                    searchable: false
                },
                { 
                    data: 'created_at', 
                    name: 'created_at',
                    render: function(data) {
                        return data ? new Date(data).toISOString().split('T')[0] : '';
                    }
                },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });

        $(document).on('change', '.status-toggle', function() {
            const id = $(this).data('id');
            const model = $(this).data('model');
            const status = $(this).prop('checked') ? 1 : 0;
            const button = $(this);

            $.ajax({
                url: `toggle-status/${model}/${id}`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status
                },
                success: function(response) {
                    console.log('AJAX success:', response);
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Status updated successfully!',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    } else {
                        console.log('AJAX failure:', response.message);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                        });
                        button.prop('checked', !status);
                    }
                },
                error: function() {
                    console.log('AJAX error');
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while updating the status.',
                    });
                    button.prop('checked', !status);
                }
            });
        });

    });
</script>

@endpush
