@php
    $modual_name = 'email-configuration';
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
                {{-- <button class="btn btn-primary float-right text-end add-{{ $modual_name }}"> <i
                    class='feather icon-plus-square'></i> Add
                {{ ucwords($modual_name) }}</button> --}}
            </div>

            <div class="row mt-0 col-md-12">
                <!-- data-tabel start -->

                <div class="card-body border rounded mt-2">
                    {{-- <div class="table-responsive"> --}}
                    <form action="javascript:void(0);" id="edit{{ ucwords($modual_name) }}Form">
                        @csrf

                        {{-- <div class="text-center" > --}}


                        @foreach ($data as $list)
                            @php
                                $keyName = ucfirst(str_replace('_', ' ', strtolower($list->key)));
                            @endphp
                            <div class="ml-6" style="margin-left: 26vh;">
                                <center>
                                    <div class="form-group row col-md-12 ">
                                        <label for="inputPassword"
                                            class="col-md-2 col-form-label">{{ $keyName }}</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control col-md-5" id="inputPassword"
                                                placeholder="Enter {{ $keyName }}" value="{{ $list->value }}"
                                                name="{{ $list->key }}">
                                            <span class="input-error" role="alert"> <strong
                                                    edit-data-input-error="{{ $list->key }}"></strong></span>
                                        </div>
                                </center>
                            </div>
                        @endforeach
                        {{-- </div> --}}

                        <button type="submit"
                            class="btn btn-primary edit-{{ ucwords($modual_name) }}-submit-btn float-right">Update</button>
                    </form>
                    {{--
                </div> --}}
                </div>
                <!-- Customer overview end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
@section('page-script')
    {{-- Update User Script --}}
    <script>
        // Uppercase convert 
        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
        // Model open
        const modual_name = "{{ $modual_name }}";
        const ucword_modual_name = capitalizeFirstLetter(modual_name);


        // Get Data from Form and send with ajax.
        $("#edit" + ucword_modual_name + "Form").submit(function(event) {


            var edit_email_configuraction_data = $(this).serializeArray();
            var formData = new FormData();
            $.each(edit_email_configuraction_data, function(i, field) {
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
                url: "{{ route('admin.email-configuration.update') }}",
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
                        triggerNotification('The Email configuration has been Updated');

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


    {{-- Opction Add Script --}}
@endsection
