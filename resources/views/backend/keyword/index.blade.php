@php
    $modual_name = 'keyword';
@endphp
@extends('backend.partial.app')

@section('content')
    @include('backend.partial.header')
    @include('backend.partial.sidebar')

    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-content">


            <!-- [ Main Content ] start -->
            <div class="">
                <button class="btn btn-primary float-right text-end add-{{ $modual_name }}"> <i
                        class='feather icon-plus-square'></i> Add
                    {{ ucwords($modual_name) }}</button>
            </div>

            <div class="row mt-0 col-md-12">
                <!-- data-tabel start -->

                <div class="card-body border rounded mt-2">
                    <div class="table-responsive">
                        <table class="table table-bordered  text-center dataTables_filter table-striped mb-3"
                            id="selection-datatable" style="width:99%">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Keyword</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Customer overview end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>

    @include('backend.partial.header')
    <!-- [ Main Content ] end -->










    <!-- [ Model Add ] Start -->
    <div id="exampleModalPopovers" class="modal fade add-{{ $modual_name }}-modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalPopoversLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalPopoversLabel">Add {{ ucwords($modual_name) }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="javascript:void(0);" id="add{{ ucwords($modual_name) }}Form">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Keyword</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Enter Keyword" name="keyword">
                                    <span class="input-error" role="alert"> <strong
                                            add-data-input-error="keyword"></strong></span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary add-user-submit-btn float-right">Add
                            {{ $modual_name }}</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- [ Model Add End ] end -->


    <!-- [ Model Add ] start -->
    <div id="exampleModalPopovers" class="modal fade edit-{{ $modual_name }}-modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalPopoversLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalPopoversLabel">Edit {{ ucwords($modual_name) }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="javascript:void(0);" id="edit{{ ucwords($modual_name) }}Form">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">

                                <input type="hidden" name="id">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Keyword</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Enter Keyword" name="keyword">
                                    <span class="input-error" role="alert"> <strong
                                            edit-data-input-error="keyword"></strong></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary edit-user-submit-btn float-right">Update
                            {{ ucwords($modual_name) }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- [Model Content End ] end -->
@endsection

@section('page-script')
    <script>
        // Uppercase convert 
        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
        // Model open
        const modual_name = "{{ $modual_name }}";
        const ucword_modual_name = capitalizeFirstLetter(modual_name);

        function fetchKeywordData() {
            $('#selection-datatable').DataTable({
                "pagingType": 'full_numbers',
                "Processing": true,
                "serverSide": true,
                "bDestroy": true,
                "responsive": true,
                "order": [
                    [0, "desc"]
                ],
                "ajax": "{{ route('admin.keyword.fetch') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'keyword',
                        name: 'keyword'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            })
        }
        $(document).ready(function() {
            fetchKeywordData();
        });
    </script>

    {{-- Add User Script --}}
    <script>
        $(document).on("click", '.add-' + modual_name, function() {
            resetForm("#add" + ucword_modual_name + "Form", 'add');
            $(".add-" + modual_name + "-modal").modal('show');
        });


        // Get Data from Form and send with ajax.
        $("#add" + ucword_modual_name + "Form").submit(function(event) {

            var add_user_data = $(this).serializeArray();
            var formData = new FormData();

            $.each(add_user_data, function(i, field) {
                formData.append(field.name, field.value);
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(".add-" + modual_name + "-submit-btn").text('Adding....');


            $.ajax({
                type: "POST",
                url: "{{ route('admin.keyword.store') }}",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {

                    if (response.status == 400) {
                        manageErrors(response.errors, "add" + modual_name + "Form", 'add');
                        $(".add-user-submit-btn").text('Add Keyword');
                    } else if (response.status == 200) {
                        // Showing Success Message
                        triggerNotification('The Keyword has been added');
                        // Swal.fire('Added!', 'The Subscription has been added.', 'success');


                        // Closing Modal
                        $('.add-' + modual_name + '-modal').modal('hide');
                        // resetting form
                        resetForm("#add" + ucword_modual_name + "Form", 'add');

                        $(".add-user-submit-btn").text('Add ' + modual_name);
                        fetchKeywordData();
                    }
                },
                error: function(response, status, error) {
                    manageErrors(response.responseText, "add" + ucword_modual_name + "Form", 'add');
                    $(".add-" + modual_name + "-submit-btn").text('Add ' + ucword_modual_name);
                }
            });
        });
    </script>




    {{-- Update User Script --}}
    <script>
        // Model open
        $(document).on("click", ".edit-" + modual_name + "", function() {
            resetForm("#edit" + ucword_modual_name + "Form", 'edit');
            var id = $(this).data("id");
            var formData = new FormData();
            formData.append('id', id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('admin.keyword.edit') }}",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                confirmButtonColor: "#172e60",
                cancelButtonColor: "#DD6B55",
                success: function(response) {
                    $.each(response.detail[0], function(index, value) {
                        $("input[name*='" + index + "']").val(value);
                    });
                }
            });

            $(".edit-" + modual_name + "-modal").modal('show');

        });


        // Get Data from Form and send with ajax.
        $("#edit" + ucword_modual_name + "Form").submit(function(event) {

            var edit_question_data = $(this).serializeArray();

            var formData = new FormData();
            $.each(edit_question_data, function(i, field) {
                formData.append(field.name, field.value);
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".edit-" + modual_name + "-submit-btn").text('Updating....');

            $.ajax({
                type: "POST",
                url: "{{ route('admin.keyword.update') }}",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == 400) {
                        manageErrors(response.errors, "edit" + ucword_modual_name + "Form", 'edit');
                        $(".edit-" + modual_name + "-submit-btn").text('Edit ' + ucword_modual_name);
                    } else if (response.status == 200) {
                        // Showing Success Message
                        triggerNotification('The Keyword has been updated successfully');
                        // Swal.fire('Update!', 'The Subscription has been Update.', 'success');

                        // Closing Modal
                        $('.edit-' + modual_name + '-modal').modal('hide');
                        // resetting form
                        resetForm("#edit" + ucword_modual_name + "Form", 'edit');

                        $(".edit-" + modual_name + "-submit-btn").text('Update ' + ucword_modual_name);
                        fetchKeywordData();
                    }
                },
                error: function(response, status, error) {
                    manageErrors(response.responseText, "edit" + ucword_modual_name + "Form", 'edit');
                    $(".edit-" + modual_name + "-submit-btn").text('Update ' + modual_name);
                }

            });
        });
    </script>





    {{-- Delete Question Script --}}
    <script>
        $(document).on("click", ".delete-" + modual_name + "", function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this delete!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: "#172e60",
                cancelButtonColor: "#DD6B55",
                closeModal: false,
                confirmButtonText: 'Yes, delete it!',
                showClass: {
                    popup: 'slow-animation-show'
                },
                hideClass: {
                    popup: 'slow-animation-hide'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const id = $(this).data("id");
                    var formData = new FormData();
                    formData.append('id', id);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.keyword.delete') }}",
                        data: formData,
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.status == 200) {
                                // Swal.fire('Deleted!', 'The Subscription has been deleted.',
                                //     'success');

                                triggerNotification(
                                    'The Keyword has been deleted.');

                                fetchKeywordData();

                            } else {
                                triggerNotification('Something went wrong');
                                // Swal.fire('Oops!', 'Something went wrong', 'error');
                            }
                        },
                        error: function(request, status, error) {
                            triggerNotification('Something went wrong');
                            // Swal.fire('Oops!', 'Something went wrong', 'error');
                        }
                    });
                }
            })

        });
    </script>

    {{-- Change Question Status --}}
    <script>
        function ChangeStatus(questionId, status) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to change this status!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: "#172e60",
                cancelButtonColor: "#DD6B55",

                closeModal: false,
                confirmButtonText: 'Yes, change it!',
                showClass: {
                    popup: 'slow-animation-show'
                },
                hideClass: {
                    popup: 'slow-animation-hide'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    var formData = new FormData();
                    formData.append('id', questionId); // Service id
                    formData.append('status', status);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.keyword.change_status') }}",
                        data: formData,
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.status == 200) {
                                if (status == 1) {
                                    triggerNotification("Keyword activated successfully");
                                } else {
                                    triggerNotification("Keyword inactivat successfully");
                                }

                                fetchKeywordData();
                            }
                        },
                        error: function(request, status, error) {
                            triggerNotification('Something went wrong');
                        }
                    });
                }
            })
        }
    </script>


    {{-- Opction Add Script --}}
@endsection
