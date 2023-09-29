@extends('backend.partial.app')

@section('content')
    @include('backend.partial.header')
    @include('backend.partial.sidebar')

    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-content">


            <!-- [ Main Content ] start -->
            <div class="">

                <div class="form-group col-lg-2 filter">
                    {{-- <label for="exampleFormControlSelect1">Filter</label> --}}
                    <select class="form-control filter-of-user-type " id="exampleFormControlSelect1">
                        <option value="0">All</option>
                        <option value="2">Provider</option>
                        <option value="3">Seeker</option>
                    </select>
                </div>
                <button class="btn btn-primary float-right text-end add-user"> <i class='feather icon-user-plus'></i> Add
                    User</button>
            </div>

            <div class="row mt-0 col-md-12">
                <!-- data-tabel start -->



                <div class="card-body border rounded mt-2">


                    <div class="table-responsive">

                        <table class="table table-bordered  text-center dataTables_filter table-striped"
                            id="selection-datatable" style="width:99%">
                            <thead>
                                <tr>
                                    <th>no</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Type</th>
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

    <!-- [ Model Add User ] Start -->

    <div id="exampleModalPopovers" class="modal fade add-user-modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalPopoversLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalPopoversLabel">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="javascript:void(0);" id="addUserForm">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Enter email" name="email">
                                    <span class="input-error" role="alert"> <strong
                                            add-data-input-error="email"></strong></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" placeholder="Name" name="name">
                                    <span class="input-error" role="alert"> <strong
                                            add-data-input-error="name"></strong></span>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1"
                                        placeholder="Password" name="password">
                                    <span class="input-error" role="alert"> <strong
                                            add-data-input-error="password"></strong></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">User Type</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="role">
                                        <option value="provider">Provider</option>
                                        <option value="seeker">Seeker</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary add-user-submit-btn float-right">Add
                            User</button>
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- [ End Model Content ] end -->



    <!-- [ Model Edit User ] Start -->
    <div id="exampleModalPopovers" class="modal fade edit-user-modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalPopoversLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalPopoversLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="javascript:void(0);" id="editUserForm">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" name="id">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Enter email" name="email">
                                    <span class="input-error" role="alert"> <strong
                                            edit-data-input-error="email"></strong></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" placeholder="Name" name="name">
                                    <span class="input-error" role="alert"> <strong
                                            edit-data-input-error="name"></strong></span>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1"
                                        placeholder="Password" name="password">
                                    <span class="input-error" role="alert"> <strong
                                            edit-data-input-error="password"></strong></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">User Type</label>
                                    <select class="form-control role-edit" id="exampleFormControlSelect1" name="role">
                                        <option value="provider">Provider</option>
                                        <option value="seeker">Seeker</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary edit-user-submit-btn float-right">Update
                            User</button>
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- [ End Model Content ] end -->
@endsection
@section('page-script')
    <script>
        $(".filter-of-user-type").change(function() {
            fetchUserData()
        });

        function fetchUserData() {
            var user_role_id = $(".filter-of-user-type").val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#selection-datatable').DataTable({
                "pagingType": 'full_numbers',
                "Processing": true,
                "serverSide": true,
                "bDestroy": true,
                "responsive": true,
                "order": [
                    [1, "desc"]
                ],
                "ajax": {
                    'type': 'post',
                    'url': "{{ route('admin.user.fetch') }}",
                    'data': {
                        user_role_id: user_role_id,
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'type',
                        name: 'type'
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
            fetchUserData();

        });
    </script>

    {{-- Add User Script --}}
    <script>
        // Model open
        $(document).on("click", ".add-user", function() {
            resetForm("#addUserForm", 'add');
            $(".add-user-modal").modal('show');
        });

        // Get Data from Form and send with ajax.
        $("#addUserForm").submit(function(event) {
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
            $(".add-user-submit-btn").text('Adding....');


            $.ajax({
                type: "POST",
                url: "{{ route('admin.user.store') }}",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {

                    if (response.status == 400) {
                        manageErrors(response.errors, "addUserForm", 'add');
                        $(".add-user-submit-btn").text('Add User');
                    } else if (response.status == 200) {
                        // Showing Success Message
                        triggerNotification('The User has been added.');

                        // Closing Modal
                        $('.add-user-modal').modal('hide');
                        // resetting form
                        resetForm("#addUserForm", 'add');

                        $(".add-user-submit-btn").text('Add User');
                        fetchUserData();
                    }
                },
                error: function(response, status, error) {
                    manageErrors(response.responseText, "addUserForm", 'add');
                    $(".add-user-submit-btn").text('Add User');
                }

            });
        });
    </script>


    {{-- Update User Script --}}
    <script>
        // Model open
        $(document).on("click", ".edit-user", function() {
            resetForm("#editUserForm", 'edit');
            var user_id = $(this).data("id");
            var formData = new FormData();
            formData.append('user_id', user_id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('admin.user.edit', ['id' => 1]) }}",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {
                    $.each(response.user_detail[0], function(index, value) {
                        if (index == 'role_id') {
                            if (value == 2) {
                                $("select[name*='role']").val('provider');
                            } else if (value == 3) {
                                $("select[name*='role']").val('seeker');
                            }
                        } else {

                            $("input[name*='" + index + "']").val(value);
                        }
                    });
                }
            });

            $(".edit-user-modal").modal('show');

        });
    </script>
    <script>
        $(document).on("click", ".delete-user", function() {

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this delete!",
                icon: 'warning',
                showCancelButton: true,
                closeModal: false,
                confirmButtonColor: "#172e60",
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
                    console.log(result);
                    const userId = $(this).data("id");
                    var formData = new FormData();
                    formData.append('userId', userId);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.user.delete') }}",
                        data: formData,
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.status == 200) {
                                triggerNotification('The User has been deleted.');
                                fetchUserData();
                            } else {
                                Swal.fire('Oops!', 'Something went wrong', 'error');
                            }
                        },
                        error: function(request, status, error) {
                            console.log(request.responseText);
                            Swal.fire('Oops!', 'Something went wrong', 'error');
                        }
                    });
                }
            })
        });
    </script>

    <script>
        function ChangeStatus(userId, status) {

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
                    formData.append('userId', userId);
                    formData.append('status', status);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.user.change_status') }}",
                        data: formData,
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.status == 200) {
                                if (status == 1) {
                                    triggerNotification("User activated successfully");
                                } else {
                                    triggerNotification("User inactivat successfully");
                                }
                                fetchUserData();
                            } else {
                                Swal.fire('Oops!', 'Something went wrong', 'error');
                            }
                        },
                        error: function(request, status, error) {
                            console.log(request.responseText);

                        }
                    });

                }
            })
        }
    </script>
@endsection
