@extends('backend.partial.app')
@section('page-css')

<link href="{{ asset('backend/css/select-box/select2.min.css') }}" rel="stylesheet" />

<style>
  .select2-container--default .select2-selection--multiple .select2-selection__choice {
    color: #ffffff;
  }

  .select2-selection__choice {
    background-color: #172e60 !important;
    font: #ffffff;
  }

  .select2-selection__choice__remove {
    background-color: transparent !important;
    color: #ffffff !important;
  }

  .select2-selection__choice {
    border: 0px !important;
  }
</style>
@endsection

@section('content')
@include('backend.partial.header')
@include('backend.partial.sidebar')
<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
  <div class="pcoded-content">



    <!-- [ Main Content ] start -->
    <div class="row text-end">
      <div class="col-md-8">
      </div>
      <div class="col-md-4 float-right">
        <a href="{{route('list.users')}}" class="btn btn-primary mb-2 mr-3 pull-right" data-toggle="tooltip" data-placement="bottom" data-original-title="Back" disabled=""><i class="feather icon-arrow-left"></i>Back</a>
      </div>
    </div>
    <div class="row">

      <div class="col-md-3">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile" style="font-size: 12px;">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle profile-image" id="providerProfile"
                src="{{ asset($user_detail->profile_image) }}" alt="User profile picture">
            </div>

            <h4 class="profile-username text-center">{{ ucfirst($user_detail->name) }}</h4>
            <p class="text-muted text-center"></p>
            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Name</b> <a class="float-right">{{ ucfirst($user_detail->name) }}</a>
              </li>
              <li class="list-group-item">
                <b>Mobile</b> <a class="float-right">{{ $user_detail->mobile }}</a>
              </li>
              <li class="list-group-item">
                <b>Role</b> <a class="float-right">{{ GetRoleName($user_detail->role_id) }}</a>
              </li>
              <li class="list-group-item">
                <form action="javascript:void(0);" id="profileImage" enctype="multipart/form-data">
                  <div class="custom-file col-sm-12">
                    <input type="file" class="custom-file-input upload-profile-pictuer" id="files" name="image"
                      multiple="" accept="image/*">
                    <label class="custom-file-label" for="inputGroupFile03">Profile Image</label>
                  </div>
                </form>

                <form action="javascript:void(0);" id="profileLargeImageForm" enctype="multipart/form-data"
                  class="mt-3">
                  <div class="custom-file col-sm-12">
                    <input type="file" class="custom-file-input upload-large-profile-pictuer" id="profileLargeImage"
                      name="profileLargeImage" multiple="" accept="image/*">
                    <label class="custom-file-label" for="profileLargeImage">Large Image</label>
                  </div>
                </form>
              </li>
            </ul>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- About Me Box -->

        <!-- /.card -->
      </div>

      <div class="col-md-9">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <h4>Update Profile</h4>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <!-- /.tab-pane -->
              <div class="active tab-pane" id="changepassword">
                <form class="form-horizontal" action="javascript:void(0);" enctype='multipart/form-data'
                  id="editUserForm">

                  @csrf
                  <input type="hidden" name="user_id" value="{{$user_detail->user_id}}">

                  <div class="form-group row">
                    <div class="col-sm-6">
                      <label for="exampleInputEmail1" class="col-sm-4 col-form-label">User Name</label>

                      <div class="col-sm-12">
                        <input name="name" type="text" id="name"
                          value="{{{ old('name', isset($user_detail) ? $user_detail->name : null) }}}"
                          class="form-control @error('name') is-invalid @enderror" placeholder="Enter User Name"
                          readonly />
                        @error('name')<span class="invalid-feedback" role="alert"> <strong>{{ $message
                            }}</strong></span>@enderror
                      </div>
                    </div>


                    <div class="col-sm-6">
                      <label for="exampleInputEmail1" class="col-sm-4 col-form-label">Mobile</label>
                      <div class="col-sm-12">

                        <input name="mobile" type="tel" id="mobile"
                          value="{{ old('mobile', isset($user_detail) ? $user_detail->mobile : null) }}"
                          class="form-control" placeholder="Enter Mobile" />
                        <span class="input-error" role="alert"> <strong edit-data-input-error="mobile"></strong></span>

                      </div>
                    </div>
                  </div>

                  <div class="form-group row ">

                    <div class="col-sm-6">
                      <label for="exampleInputEmail1" class="col-sm-4 col-form-label">Email</label>
                      <div class="col-sm-12">
                        <input name="email" type="email" id="email"
                          value="{{{ old('email', isset($user_detail) ? $user_detail->email : null) }}}"
                          class="form-control @error('name') is-invalid @enderror" placeholder="Enter Email" disabled />
                        <span class="input-error" role="alert"> <strong edit-data-input-error="email"></strong></span>
                      </div>
                    </div>


                    <div class="col-sm-6">
                      <label for="password" class="col-sm-4 col-form-label">New Password</label>
                      <div class="col-sm-12">
                        <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                          name="new_password" id="new_password" placeholder="New Password">
                        <span class="input-error" role="alert"> <strong
                            edit-data-input-error="new_password"></strong></span>
                      </div>
                    </div>
                  </div>



                  <div class="form-group row">
                    <div class="col-sm-12">
                      <label for="exampleInputEmail1" class="col-sm-4 col-form-label">Address</label>
                      <div class="col-sm-12">
                        <textarea name="address" type="text" id="email"
                          class="form-control @error('address') is-invalid @enderror"
                          placeholder="Enter Address">{{$user_detail->address}}</textarea>
                        <span class="input-error" role="alert"> <strong edit-data-input-error="address"></strong></span>
                      </div>
                    </div>
                  </div>


                  <div class="form-group row">

                    <div class="col-sm-6">
                      <label for="exampleInputEmail1" class="col-sm-4 col-form-label">Country</label>
                      <div class="col-sm-12">
                        <input name="country" type="text" id="email"
                          value="{{{ old('country', isset($user_detail) ? $user_detail->country : null) }}}"
                          class="form-control @error('country') is-invalid @enderror" placeholder="Enter Country" />
                        <span class="input-error" role="alert"> <strong edit-data-input-error="country"></strong></span>

                      </div>
                    </div>

                    <div class="col-sm-6">
                      <label for="exampleInputEmail1" class="col-sm-4 col-form-label">City</label>
                      <div class="col-sm-12">
                        <input name="city" type="text" id="city"
                          value="{{{ old('city', isset($user_detail) ? $user_detail->city : null) }}}"
                          class="form-control text-left @error('city') is-invalid @enderror" placeholder="Enter City" />
                        <span class="input-error" role="alert"> <strong edit-data-input-error="city"></strong></span>

                      </div>
                    </div>


                  </div>


                  <div class="form-group row">
                    <div class="col-sm-6">
                      <label for="exampleInputEmail1" class="col-sm-4 col-form-label">Postal Code</label>
                      <div class="col-sm-12">
                        <input name="postal_code" type="text" id="postal_code"
                          value="{{{ old('postal_code', isset($user_detail) ? $user_detail->postal_code : null) }}}"
                          class="form-control text-left @error('postal_code') is-invalid @enderror"
                          placeholder="Enter Postal Code" />
                        <span class="input-error" role="alert"> <strong
                            edit-data-input-error="postal_code"></strong></span>

                      </div>
                    </div>


                    <div class="col-sm-6">
                      <label for="exampleInputEmail1" class="col-sm-4 col-form-label">Phone</label>
                      <div class="col-sm-12">
                        <input name="phone" type="number" id="email"
                          value="{{{ old('phone', isset($user_detail) ? $user_detail->phone : null) }}}"
                          class="form-control @error('phone') is-invalid @enderror" placeholder="Enter Phone" />
                        <span class="input-error" role="alert"> <strong edit-data-input-error="phone"></strong></span>
                      </div>
                    </div>

                  </div>

                 

                  <div class="form-group row">
                    <label for="exampleInputEmail1" class="col-sm-2 col-form-label">About Me</label>
                    <div class="col-sm-12">
                      <textarea rows="4" cols="50" name="about" type="number" id="email" value=""
                        class="form-control @error('about') is-invalid @enderror"
                        placeholder="About Me">{{{ old('about', isset($user_detail) ? $user_detail->about : null) }}}</textarea>
                      <span class="input-error" role="alert"> <strong edit-data-input-error="about"></strong></span>

                    </div>
                  </div>


                  <div class="form-group row">
                    <div class="col-sm-10">
                    </div>
                    <div class="col-sm-2">
                      <button type="submit" class="btn btn-danger ">Update</button>
                    </div>
                  </div>

                </form>
              </div>
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- [ form-element ] start -->

      <!-- [ form-element ] end -->
    </div>
    <!-- [ Main Content ] end -->

  </div>
</div>
<!-- [ Main Content ] end -->
@endsection

@section('page-script')
{{-- Update User Script --}}
<script src="{{ asset('backend/js/select/select2.min.js') }}"></script>

<script>
  $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});


  // Delete delete certificate
  $(document).on("click", ".delete-image", function() {
      
      var image_id = $(this).data("id");
      var image_name = $(this).data("image_name");

      var formData = new FormData();
      formData.append('image_id', image_id);
      formData.append('image_name', image_name);

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
          type: "POST",
          url: "{{ route('admin.user.delete_certificate')}}",
          data: formData,
          dataType: "json",
          contentType: false,
          processData: false,
          success: function(response) {
            $(".delete_"+image_id).remove();
          },
          error: function() {
              alert("Something went wrong");
          }
      });
  });

  const preview = (file) => {
  const fr = new FileReader();
  fr.onload = () => {
    const str = '<div class="img-wraps">'
    const final_img = str+'<img src="'+fr.result+'" class="upload_image_provider img-responsive"></div>';
    $('.uploaded_image').append(final_img);
  };
  fr.readAsDataURL(file);
};

document.querySelector("#files").addEventListener("change", (ev) => {
  if (!ev.target.files) return; // Do nothing.
  [...ev.target.files].forEach(preview);
});

$(".upload-profile-pictuer").change(function(){
  // providerProfile
         var formData = new FormData();
         var files = $('#files')[0].files;
         var userId = $("input[name=user_id]").val();

         formData.append('image',files[0]);
         formData.append('user_id',userId);
         
         
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ route('admin.user.uploadProfilePictuer') }}",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {
                  triggerNotification('User has been updated successfully');
                },
            }); 
          });

        const a = (file) => {
          const fr = new FileReader();
          fr.onload = () => {
            $('#providerProfile').attr("src",fr.result);
          };
          fr.readAsDataURL(file);
        };


document.querySelector(".upload-profile-pictuer").addEventListener("change", (ev) => {
  if (!ev.target.files) return; // Do nothing.
  [...ev.target.files].forEach(a);
});


$(".upload-large-profile-pictuer").change(function(){
  
  // providerProfile
         var formData = new FormData();
         var files = $('#profileLargeImage')[0].files;
         var userId = $("input[name=user_id]").val();

         formData.append('image',files[0]);
         formData.append('user_id',userId);
         formData.append('largeProfileImage','1');
                  
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ route('admin.user.uploadProfilePictuer') }}",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {
                  triggerNotification('User has been updated successfully');

                },
            });
          });

        const b = (file) => {
          const fr = new FileReader();
          fr.onload = () => {
            $('#providerProfile').attr("src",fr.result);
          };
          fr.readAsDataURL(file);
        };


document.querySelector(".upload-profile-pictuer").addEventListener("change", (ev) => {
  if (!ev.target.files) return; // Do nothing.
  [...ev.target.files].forEach(b);
});

</script>
@php
    if($user_detail->role_id == '2'){
      $updateRoute =  route('admin.provider.update');
    }else{
      $updateRoute =  route('admin.seeker.update');
    }
@endphp
{{-- Update User Script --}}
<script>
  // Get Data from Form and send with ajax.
  $("#editUserForm").submit(function(event) {
    var editUrl = "{{$updateRoute}}";
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
     
      $.ajax({
          type: "POST",
          url: editUrl,
          data: formData,
          dataType: "json",
          contentType: false,
          processData: false,
          success: function(response) {
              if (response.status == 400) {
                  manageErrors(response.errors, "editUserForm", 'edit');
              } else if (response.status == 200) {
                  // Showing Success Message
                  triggerNotification('User has been updated successfully');
              }
          },
          error: function(response, status, error) {
              manageErrors(response.responseText, "editUserForm", 'edit');
          }

      });
  });
</script>
@endsection