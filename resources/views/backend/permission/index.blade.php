@php
    $modual_name = 'permission';
@endphp
@extends('backend.partial.app')

@section('content')
    @include('backend.partial.header')
    @include('backend.partial.sidebar')

    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-content">

            <div class="row mt-0 col-md-12">
                <!-- data-tabel start -->

                <div class="card-body border rounded mt-2">
                    <div class="table-responsive">
                        <table class="table table-bordered  text-center dataTables_filter table-striped mb-3"
                            id="selection-datatable" style="width:99%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Modual Name</th>
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




    <!-- [ Model Add Subscription ] Start -->
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
                                    <label for="exampleInputEmail1">Price</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Enter Subscription Price" name="price">
                                    <span class="input-error" role="alert"> <strong
                                            add-data-input-error="price"></strong></span>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Description</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Enter Description" name="description">
                                    <span class="input-error" role="alert"> <strong
                                            add-data-input-error="description"></strong></span>
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
    <!-- [ Model Add Question ] end -->


    <!-- [ End Add User Content ] start -->
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
                                    <label for="exampleInputEmail1" id='permissionLabel'></label>

                                    <div class="row ml-3 col-md-12">
                                        <div class="custom-control col-md-6 custom-switch">
                                            <input type="checkbox" class="custom-control-input type_2" id="customswitch1"
                                                name="provider">
                                            <label class="custom-control-label" for="customswitch1">Provider</label>
                                        </div>

                                        <div class="custom-control col-md-6 custom-switch">
                                            <input type="checkbox" class="custom-control-input type_3" id="customswitch2"
                                                name="seeker">
                                            <label class="custom-control-label" for="customswitch2">Seeker</label>
                                        </div>
                                    </div>

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
    <!-- [ End Add service Model Content ] end -->
@endsection

@section('page-script')
    <script>
        var getUrl = "{{ route('admin.permission.fetch') }}";
        var editUrl = "{{ route('admin.permission.edit') }}";
        var updateUrl = "{{ route('admin.permission.update') }}";
        var deleteUrl = "{{ route('admin.permission.delete') }}";
        var changeStatusUrl = "{{ route('admin.permission.change_status') }}";


        // Model open
        const modual_name = "{{ $modual_name }}";
        const ucword_modual_name = capitalizeFirstLetter(modual_name);

        function fetchSubscriptionData() {
            $('#selection-datatable').DataTable({
                "pagingType": 'full_numbers',
                "Processing": true,
                "serverSide": true,
                "bDestroy": true,
                "responsive": true,
                "order": [
                    [0, "desc"]
                ],
                "ajax": getUrl,
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            })
        }
        $(document).ready(function() {
            fetchSubscriptionData();
        });
    </script>



    {{-- Update Permission Script --}}
    <script>
        // Model open
        $(document).on("click", ".edit-" + modual_name + "", function() {
            resetForm("#edit" + ucword_modual_name + "Form", 'edit');
            var id = $(this).data("id");
            var labelValue = $(this).data("label");
            var formData = new FormData();

            formData.append('id', id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: editUrl,
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {
                    $("input[name*='id']").val(response.detail[0].id);
                    var a = $.parseJSON(response.detail[0].roll_ids);
                    $.each(a, function(index, value) {
                        $(".type_"+value).prop("checked", true)
                    });
                }   
            });

            $('#permissionLabel').text(labelValue + ' Premission');
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
                url: updateUrl,
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
                        triggerNotification('The Permission has been updated successfully');

                        // Closing Modal
                        $('.edit-' + modual_name + '-modal').modal('hide');
                        // resetting form
                        resetForm("#edit" + ucword_modual_name + "Form", 'edit');

                        $(".edit-" + modual_name + "-submit-btn").text('Update ' + ucword_modual_name);
                        fetchSubscriptionData();
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
                closeModal: false, confirmButtonColor: "#172e60",
                cancelButtonColor: "#DD6B55",
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
                        url: deleteUrl,
                        data: formData,
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.status == 200) {
                                // Swal.fire('Deleted!', 'The Subscription has been deleted.',
                                //     'success');

                                triggerNotification('The Permission has been deleted.');

                                fetchSubscriptionData();

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
                showCancelButton: true, confirmButtonColor: "#172e60",
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
                        url: changeStatusUrl,
                        data: formData,
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.status == 200) {
                                triggerNotification('Permission Status Change succcesfully');
                                fetchSubscriptionData();
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
