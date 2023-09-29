@php
$modual_name = 'setting';
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
                                <th>Title</th>
                                <th>Value</th>
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
                                <label for="exampleInputEmail1" id='settingLabel'></label>

                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="Set Value" name="value">
                                <span class="input-error" role="alert"> <strong
                                        edit-data-input-error="value"></strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary edit-user-submit-btn float-right">Update
                            {{ ucwords($modual_name) }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- [ End Add service Model Content ] end -->
@endsection

@section('page-script')
<script>
    var getUrl = "{{ route('admin.setting.fetch') }}";
        var editUrl = "{{ route('admin.setting.edit') }}";
        var updateUrl = "{{ route('admin.setting.update') }}";


        // Model open
        const modual_name = "{{ $modual_name }}";
        const ucword_modual_name = capitalizeFirstLetter(modual_name);

        function fetchSettingData() {
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
                        data: 'value',
                        name: 'value'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
            })
        }
        $(document).ready(function() {
            fetchSettingData();
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

                    $.each(response.detail[0], function(index, value) {
                        if (index == 'title') {
                            $("#settingLabel").text(value);
                        } else {
                            $("input[name*='" + index + "']").val(value);
                        }
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
                        triggerNotification('Setting has been updated successfully');

                        // Closing Modal
                        $('.edit-' + modual_name + '-modal').modal('hide');
                        // resetting form
                        resetForm("#edit" + ucword_modual_name + "Form", 'edit');

                        $(".edit-" + modual_name + "-submit-btn").text('Update ' + ucword_modual_name);
                        fetchSettingData();
                    }
                },
                error: function(response, status, error) {
                    manageErrors(response.responseText, "edit" + ucword_modual_name + "Form", 'edit');
                    $(".edit-" + modual_name + "-submit-btn").text('Update ' + modual_name);
                }
            });
        });
</script>
@endsection