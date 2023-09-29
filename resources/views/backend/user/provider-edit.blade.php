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

      @if(session()->get('UserSession.role_id') == '1')
      <div class="col-md-4 float-right">
        <a href="{{route('list.users')}}" class="btn btn-primary mb-2 mr-3 pull-right" data-toggle="tooltip"
          data-placement="bottom" data-original-title="Back" disabled=""><i class="feather icon-arrow-left"></i>
          Back</a>
      </div>
    </div>
    @endif


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
                      accept="image/*">
                    <label class="custom-file-label" for="inputGroupFile03">Profile Image</label>
                  </div>
                </form>

                <form action="javascript:void(0);" id="profileLargeImageForm" enctype="multipart/form-data"
                  class="mt-3">
                  <div class="custom-file col-sm-12">
                    <input type="file" class="custom-file-input upload-large-profile-pictuer" id="profileLargeImage"
                      name="profileLargeImage" accept="image/*">
                    <label class="custom-file-label" for="profileLargeImage">Large Image</label>
                  </div>
                </form>

                <form action="javascript:void(0);" id="profileVideoForm" enctype="multipart/form-data" class="mt-3">
                  <div class="custom-file col-sm-12">
                    <input type="file" class="custom-file-input upload-provider-video" id="profileVideo"
                      name="profileVideo">
                    <label class="custom-file-label" for="profileVideo">Profile Video</label>
                  </div>
                </form>

                <div class="custom-file col-sm-12" style="visibility: hidden;" id="loderDiv">
                  <button class="btn  btn-primary m-2" type="button" disabled="true">
                    <span class="spinner-border spinner-border-sm" role="status"></span>
                    Loading...
                  </button>
                </div>

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

                  <div class="form-group row ">
                    <div class="col-sm-6">
                      <label for="Fees" class="col-sm-4 col-form-label">Fees</label>
                      <div class="col-sm-12">
                        <input type="Fees" class="form-control @error('Fees') is-invalid @enderror" name="fees"
                          id="fees" placeholder="Fees"
                          value="{{{ old('fees', isset($user_detail) ? $user_detail->fees : null) }}}">
                        <span class="input-error" role="alert"> <strong edit-data-input-error="fees"></strong></span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-6">
                      <label for="exampleInputEmail1" class="col-sm-4 col-form-label">Service</label>
                      <div class="col-sm-12">
                        <select class="js-example-basic-multiple form-control " name="service[]" multiple="multiple">
                          @foreach ($service as $service_list)
                          <option value="{{$service_list->id}}" @if(in_array($service_list->id,$user_service_ids))
                            selected @endif>{{$service_list->name}}</option>
                          @endforeach
                        </select>
                        <span class="input-error" role="alert"> <strong edit-data-input-error="service"></strong></span>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <label for="exampleInputEmail1" class="col-sm-4 col-form-label">Workouts</label>
                      <div class="col-sm-12">
                        <select class="js-example-basic-multiple form-control" name="workout[]" multiple="multiple">
                          @foreach ($workouts as $workouts_list)
                          <option value="{{$workouts_list->id}}" @if(in_array($workouts_list->
                            id,$provider_workout_list))selected @endif
                            >{{$workouts_list->name}}</option>
                          @endforeach
                        </select>
                        <span class="input-error" role="alert"> <strong edit-data-input-error="workout"></strong></span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-6">
                      <label for="exampleInputEmail1" class="col-sm-4 col-form-label">Goals/Interests</label>
                      <div class="col-sm-12">
                        <select class="js-example-basic-multiple form-control " name="goals[]" multiple="multiple">
                          @foreach ($fitness_goals as $fitness_goals_list)
                          <option value="{{$fitness_goals_list->id}}" @if(in_array($fitness_goals_list->
                            id,$user_goal_ids)) selected @endif>
                            {{$fitness_goals_list->name}}</option>
                          @endforeach
                        </select>
                        <span class="input-error" role="alert"> <strong edit-data-input-error="goals"></strong></span>
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
                    <label for="exampleInputEmail1" class="col-sm-2 col-form-label">Experience</label>
                    <div class="col-sm-12">
                      <textarea rows="4" cols="50" name="experience" type="number" id="email" value=""
                        class="form-control @error('experience') is-invalid @enderror"
                        placeholder="Experience">{{{ old('experience', isset($user_detail) ? $user_detail->experience : null) }}}</textarea>
                      <span class="input-error" role="alert"> <strong
                          edit-data-input-error="experience"></strong></span>

                    </div>
                  </div>


                  <div class="form-group row">
                    <label for="exampleInputEmail1" class="col-sm-2 col-form-label">Expertise</label>
                    <div class="col-sm-12">
                      <textarea rows="4" cols="50" name="expertise" type="number" id="email" value=""
                        class="form-control @error('expertise') is-invalid @enderror"
                        placeholder="Expertise">{{{ old('expertise', isset($user_detail) ? $user_detail->expertise : null) }}}</textarea>
                      <span class="input-error" role="alert"> <strong edit-data-input-error="expertise"></strong></span>

                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="exampleInputEmail1" class="col-sm-2 col-form-label">Testimonials</label>
                    <div class="col-sm-12">
                      <textarea rows="4" cols="50" name="testimonials" type="number" id="email" value=""
                        class="form-control @error('testimonials') is-invalid @enderror"
                        placeholder="Testimonial">{{{ old('testimonials', isset($user_detail) ? $user_detail->testimonials : null) }}}</textarea>
                      <span class="input-error" role="alert"> <strong
                          edit-data-input-error="testimonials"></strong></span>

                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="exampleInputEmail1" class="col-sm-2 col-form-label">Website Link</label>
                    <div class="col-sm-12">
                      <textarea rows="4" cols="50" name="website_link" type="number" id="email" value=""
                        class="form-control @error('website_link') is-invalid @enderror"
                        placeholder="Website Link">{{{ old('website_link', isset($user_detail) ? $user_detail->website_link : null) }}}</textarea>
                      <span class="input-error" role="alert"> <strong
                          edit-data-input-error="website_link"></strong></span>

                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="exampleInputEmail1" class="col-sm-2 col-form-label">Contact Button</label>
                    <div class="col-sm-12">
                      <textarea rows="4" cols="50" name="contact_button" type="number" id="email" value=""
                        class="form-control @error('contact_button') is-invalid @enderror"
                        placeholder="Contact Button">{{{ old('contact_button', isset($user_detail) ? $user_detail->contact_button : null) }}}</textarea>
                      <span class="input-error" role="alert"> <strong
                          edit-data-input-error="contact_button"></strong></span>

                    </div>
                  </div>


                  <div class="form-group row" style="margin-left: -31px;">
                    <div class="col-sm-6">
                      <label for="exampleInputEmail1" class="col-sm-4 col-form-label">Add Caption</label>
                      <div class="col-sm-12">
                        <input name="caption" type="text" id="email" value="{{$user_detail->caption}}"
                          class="form-control @error('caption') is-invalid @enderror" style="height: 42px;"
                          placeholder="Enter Caption" />
                        <span class="input-error" role="alert"> <strong edit-data-input-error="caption"></strong></span>

                      </div>
                    </div>


                    <div class="col-sm-6">
                      <label for="exampleInputEmail1" class="col-sm-4 col-form-label">Add Certificate</label>
                      <div class="custom-file col-sm-12">
                        <input type="file" class="custom-file-input" id="files" name="image[]" multiple
                          accept="image/*">
                        <label class="custom-file-label" for="inputGroupFile03">Add Certificate</label>
                        <span class="input-error" role="alert"> <strong edit-data-input-error="image"></strong></span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-12 row uploaded_image">

                      @foreach ($certificates as $image)
                      <div class="img-wraps delete_{{$image->id}}">
                        <span class="closes delete-image" title="Delete" data-id="{{$image->id}}"
                          data-image_name={{$image->image}}>×</span>
                        <img src="{{asset('backend/upload/certificate/'.$image->image)}}"
                          class="upload_image_provider img-responsive">
                      </div>
                      @endforeach
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
  $("#loderDiv").css('visibility','')

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
                  $("#loderDiv").css('visibility','hidden')

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
  $("#loderDiv").css('visibility','')

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
                  $("#loderDiv").css('visibility','hidden')

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

{{-- Update User Script --}}
<script>
  // Get Data from Form and send with ajax.
  $("#editUserForm").submit(function(event) {
    var editUrl = "{{route('admin.provider.update')}}";
    var edit_question_data = $(this).serializeArray();

    var formData = new FormData(this);

    let TotalFiles = $('#files')[0].files.length; //Total files
let files = $('#files')[0];
for (let i = 0; i < TotalFiles; i++) {
formData.append('files' + i, files.files[i]);
}


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
                  $(".input-error").children("strong").text("");

              }
          },
          error: function(response, status, error) {
              manageErrors(response.responseText, "editUserForm", 'edit');
          }

      });
  });
</script>


<script>
  $(".upload-provider-video").change(function(){
  $("#loderDiv").css('visibility','')
  // providerProfile
         var formData = new FormData();
         var files = $('#profileVideo')[0].files;
         var userId = $("input[name=user_id]").val();

         formData.append('video',files[0]);
         formData.append('user_id',userId);
         formData.append('largeProfileImage','1');
                  
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ route('admin.user.upload-provider-video') }}",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {
                  triggerNotification('User has been updated successfully');
                  $(".input-error").children("strong").text("");
                  $("#loderDiv").css('visibility','hidden')
                },
                 error: function(response, status, error) {
              manageErrors(response.responseText, 'profileVideoForm', 'add');
              $("#loderDiv").css('visibility','hidden')
          }
            });
          });

</script>
@endsection