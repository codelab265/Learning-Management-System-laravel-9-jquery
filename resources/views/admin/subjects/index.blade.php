@extends('layout.admin.app')
@section('title', 'Subjects');

@section('body')
    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">
                    @yield('title')
                </h4>
            </div>
            <div class="d-flex align-items-center flex-wrap text-nowrap">

                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#create">
                    <i data-feather="plus-circle" width="24" height="24"></i>
                    Create
                </button>
            </div>
            @include('admin.subjects.create')
        </div>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table id="dataTablePayroll" class="table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Class</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Semester</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade bs-modal-md in" id="customModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">UPDATE</h5>
                        <button type="button" class="btn text-danger" data-bs-dismiss="modal" aria-label="btn-close">
                            <i data-feather="x-circle"></i>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        Loading...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="editSaveButton">Save</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('scripts')
        <script>
            $(document).ready(function() {
                var table;
                loadTable();

                $('body').on('click', '.deleteButton', function() {
                    var id = $(this).data('id');
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You will not be able to recover the deleted user!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel please!",
                        closeOnConfirm: true,
                        closeOnCancel: true
                    }).then((result) => {
                        if (result.value) {

                            var url = "{{ route('admin.subjects.destroy', ':id') }}";
                            url = url.replace(':id', id)


                            var token = "{{ csrf_token() }}";

                            $.easyAjax({
                                type: 'POST',
                                url: url,
                                data: {
                                    '_token': token,
                                    '_method': 'DELETE',
                                    'id': id
                                },
                                success: function(response) {
                                    if (response.status == "success") {
                                        $.unblockUI();
                                        table._fnDraw();
                                    }
                                }
                            });
                        }
                    });
                });



                function loadTable() {

                    table = $('#dataTablePayroll').dataTable({
                        "lengthMenu": [
                            [10, 25, 50, 100, 200, -1],
                            [10, 25, 50, 100, 200, "All"]
                        ],
                        scrollY: false,
                        buttons: true,
                        responsive: true,
                        processing: true,
                        serverSide: true,
                        destroy: true,
                        stateSave: true,
                        ajax: "{{ route('admin.subjects.index') }}",

                        columns: [{
                                data: 'DT_RowIndex',
                                orderable: false,
                                searchable: false
                            },
                            {
                                data: 'class_id',
                                name: 'class_id'
                            },

                            {
                                data: 'subject_code',
                                name: 'subject_code'
                            },
                            {
                                data: 'subject_name',
                                name: 'subject_name'
                            },
                            {
                                data: 'semester',
                                name: 'semester'
                            },
                            {
                                data: 'action',
                                name: 'action'
                            },
                        ]
                    });
                }

                $('body').on('click', '#createSaveButton', function() {

                    $.easyAjax({
                        url: '{{ route('admin.subjects.store') }}',
                        type: "POST",
                        container: '#createForm',
                        data: $('#createForm').serialize(),
                        success: function(response) {
                            if (response.status == 'success') {
                                loadTable();
                                $('#createForm')[0].reset();
                            }
                        }
                    })


                })

                $('body').on('click', '#editSaveButton', function() {
                    var id = $('#subject-id').val();

                    var url = "{{ route('admin.subjects.update', ':id') }}"
                    url = url.replace(':id', id);
                    $.easyAjax({
                        url: url,
                        type: "PATCH",
                        container: '#editForm',
                        data: $('#editForm').serialize(),
                        success: function(response) {
                            if (response.status == "success") {
                                $.unblockUI();
                                table._fnDraw();
                                $('#customModal').modal('hide')
                            }

                        }
                    })


                })


                $('body').on('click', '.editButton', function() {

                    var subjectId = $(this).data('id');
                    var url = '{{ route('admin.subjects.edit', ':id') }}';
                    url = url.replace(':id', subjectId);
                    $.ajaxModal('#customModal', url);

                })
            });
        </script>
    @endpush
