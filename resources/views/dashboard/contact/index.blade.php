@extends('dashboard.layouts.app')

@push('css')
    <!-- Add any custom CSS here if needed -->
@endpush

@section('content')
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card-toolbar mb-4">
            <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                <!-- You can add buttons here if needed, e.g., for adding messages -->
            </div>
        </div>
        <div class="card">
            <div class="card-header border-1 pt-6">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <h4>Messages Lists</h4>
                    </div>
                </div>
            </div>
            <div class="table-responsive theme-scrollbar">
                <table id="example1" class="table yajra-datatable">
                    <thead>
                        <tr class="text-start text-black-500 fw-bold fs-7 text-uppercase gs-0">
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th class="min-w-70px">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(function() {
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('contact.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'subject', name: 'subject' },
                    { data: 'message', name: 'message' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });
    </script>
@endpush
