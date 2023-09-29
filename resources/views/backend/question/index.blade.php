@php
    $modual_name = 'question';
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
                    Question</button>
            </div>

            <div class="row mt-0 col-md-12">
                <!-- data-tabel start -->

                <div class="card-body border rounded mt-2">
                    <div class="table-responsive">
                        <table class="table table-bordered  text-center dataTables_filter table-striped mb-3"
                            id="selection-datatable" style="width:99%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Question</th>
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
    <!-- [ Main Content ] end -->

    <!-- [ Model Add Question ] Start -->


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
                                    <label for="exampleInputEmail1">Question</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Enter Question" name="question">
                                    <span class="input-error" role="alert"> <strong
                                            add-data-input-error="question"></strong></span>
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

    <!-- [ End Add User Content ] end -->



    <!-- [ Model Edit User ] Start -->

    <div id="exampleModalPopovers" class="modal fade add-opction-modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalPopoversLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalPopoversLabel">Add Answer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <table class="table table-bordered text-center table-striped " style="width:99%"
                                id="option-table">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Answer</th>
                                        <th>Action</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="javascript:void(0);" id="addOptionForm">
                                <input type="hidden" name="question_id" id="question_id">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" id="question_name">
                                    </label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Enter Answer" name="option">
                                    <span class="input-error" role="alert"> <strong
                                            add-data-input-error="option"></strong></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1" id="service_id">Service</label>
                                    <select class="form-control" name="service_id">
                                        @foreach ($services_list as $services)
                                            <option value="{{ $services->id }}">{{ $services->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary add-option-submit-btn float-right">Add
                                        Answer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- [ End Edit User Content ] end -->




    <!-- [ Add Opction Model ] Start -->

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
                                    <label for="exampleInputEmail1">Enter question</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Enter question" name="question">
                                    <span class="input-error" role="alert"> <strong
                                            edit-data-input-error="question"></strong></span>
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
    <!-- [ End Add Opction Model Content ] end -->
@endsection
@section('page-script')
    <script>
        $("#addOptionForm").submit(function(event) {
            $(".add-option-submit-btn").text('Adding....');
            var data = $(this).serializeArray();
            var formData = new FormData();
            var question_id = $("#question_id").val();
            $.each(data, function(i, field) {
                formData.append(field.name, field.value);
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('option.store') }}",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == 400) {
                        manageErrors(response.errors, "#addOptionForm", 'add');
                        $(".add-option-submit-btn").text('Add Answer');
                    } else if (response.status == 200) {
                        resetForm("#addOptionForm", 'add');
                        $(".add-option-submit-btn").text('Add Option');
                        fetchOptionData(question_id);
                    }
                },
                error: function(response, status, error) {
                    console.log(response.responseText);
                    manageErrors(response.responseText, "addOptionForm", 'add');
                    $(".add-option-submit-btn").text('Add  Option');
                }

            });
        });



        function fetchOptionData(questionId) {
            $('#option-table').DataTable({
                "ajax": {
                    "url": "{{ route('option.fetch') }}",
                    "data": {
                        "questionId": questionId
                    }
                },
                "pagingType": 'full_numbers',
                "processing": true,
                "serverSide": true,
                "bDestroy": true,
                "responsive": true,
                "paging": false,
                "searching": false,
                "info": false,
                "order": [
                    [0, "desc"]
                ],

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'option',
                        name: 'option'
                    },
                    {
                        data: 'service',
                        name: 'service'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            })


        }
        $(document).on("click", ".add_option", function() {
            $(".add-opction-modal").modal('show');
            var questionId = $(this).attr('data-id');
            $("#question_id").val(questionId);

            var text = $(this).closest('tr').children('td:eq(1)').text();

            $("#question_name").text(text);
            // var formData = new FormData();
            // formData.append('id', questionId); // Question id

            //GetQuestionData(questionId);
            fetchOptionData(questionId);
        });


        $(document).on("click", "td .delete-option", function() {


            const Id = $(this).data("id");
            var formData = new FormData();
            formData.append('optionId', Id);
            var btn = this;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('option.delete') }}",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(response) {
                    $(Id).closest('tr').remove();
                    if (response.status == 200) {
                        $(btn).closest('tr').fadeOut("fast");
                        triggerNotification('The Question has been Deleted.');
                    } else {
                        triggerNotification('Something went wrong.');
                    }
                },
                error: function(request, status, error) {
                    console.log(request.responseText);
                    // triggerNotification('Something went wrong.');
                }
            });

        });
    </script>





    <script>
        // Uppercase convert 
        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
        // Model open
        const modual_name = "{{ $modual_name }}";
        const ucword_modual_name = capitalizeFirstLetter(modual_name);

        function fetchQuestionData() {
            $('#selection-datatable').DataTable({
                "pagingType": 'full_numbers',
                "Processing": true,
                "serverSide": true,
                "bDestroy": true,
                "responsive": true,
                "order": [
                    [0, "desc"]
                ],
                "ajax": "{{ route('admin.question.fetch') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'question',
                        name: 'question'
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
            fetchQuestionData();

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
                url: "{{ route('admin.question.store') }}",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {

                    if (response.status == 400) {
                        manageErrors(response.errors, "add" + modual_name + "Form", 'add');
                        $(".add-user-submit-btn").text('Add User');
                    } else if (response.status == 200) {
                        // Showing Success Message
                        triggerNotification('The Question has been added.');

                        // Swal.fire('Added!', 'The Question has been added.', 'success');

                        // Closing Modal
                        $('.add-' + modual_name + '-modal').modal('hide');
                        // resetting form
                        resetForm("#add" + ucword_modual_name + "Form", 'add');

                        $(".add-user-submit-btn").text('Add ' + modual_name);
                        fetchQuestionData();
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
            var questionId = $(this).data("id");
            var formData = new FormData();
            formData.append('questionId', questionId);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('admin.question.edit') }}",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {
                    $.each(response.user_detail[0], function(index, value) {
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
                url: "{{ route('admin.question.update') }}",
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
                        triggerNotification('The Question has been updated successfully.');

                        // Swal.fire('Update!', 'The Question has been Update.', 'success');

                        // Closing Modal
                        $('.edit-' + modual_name + '-modal').modal('hide');
                        // resetting form
                        resetForm("#edit" + ucword_modual_name + "Form", 'edit');

                        $(".edit-" + modual_name + "-submit-btn").text('Update ' + ucword_modual_name);
                        fetchQuestionData();
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
                confirmButtonColor: "#172e60",
                cancelButtonColor: "#DD6B55",
                showCancelButton: true,
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

                    const userId = $(this).data("id");
                    var formData = new FormData();
                    formData.append('questionId', userId);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.question.delete') }}",
                        data: formData,
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.status == 200) {
                                triggerNotification('The Question has been Deleted.');

                                Swal.fire('Deleted!', 'The Question has been deleted.',
                                    'success');
                                fetchQuestionData();
                            } else {
                                triggerNotification('Something went wrong.');
                            }
                        },
                        error: function(request, status, error) {
                            triggerNotification('Something went wrong.');
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
                    formData.append('id', questionId); // Question id
                    formData.append('status', status);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.question.change_status') }}",
                        data: formData,
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.status == 200) {

                                if (status == 0) {
                                    triggerNotification("Question activated successfully");
                                } else {
                                    triggerNotification("Question inactivat successfully");
                                }

                                // Swal.fire("Status Changed!", "User Status has been changed."),
                                fetchQuestionData();
                            } else {
                                triggerNotification('Something went wrong.');
                            }
                        },
                        error: function(request, status, error) {
                            console.log(request.responseText);
                            triggerNotification('Something went wrong.');
                        }
                    });
                }
            });
        }
    </script>
@endsection
