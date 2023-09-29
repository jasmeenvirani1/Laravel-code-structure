@extends('backend.partial.app')
@section('page-css')

<link href="{{ asset('backend/css/select-box/select2.min.css') }}" rel="stylesheet" />

<style>
  .select2-container--default .select2-selection--multiple .select2-selection__choice {
    color: #ffffff;
  }

  .select2-selection__choice {
    background-color: #5faaff !important;
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
                <b>Name</b> <a class="float-right">{{ "Admin" }}</a>
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
                    <label class="custom-file-label" for="inputGroupFile03">Upload Profile</label>
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
                <form class="form-horizontal" method="post" action="{{ route('admin.user.update') }}"
                  enctype='multipart/form-data'>
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
                          value="{{{ old('mobile', isset($user_detail) ? $user_detail->mobile : null) }}}"
                          class="form-control @error('mobile') is-invalid @enderror" placeholder="Enter Mobile" />
                        @error('mobile')<span class="invalid-feedback" role="alert"> <strong>{{ $message
                            }}</strong></span>@enderror
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
                        @error('email')<span class="invalid-feedback" role="alert"> <strong>{{ $message
                            }}</strong></span>@enderror
                      </div>
                    </div>


                    <div class="col-sm-6">
                      <label for="password" class="col-sm-4 col-form-label">New Password</label>
                      <div class="col-sm-12">
                        <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                          name="new_password" id="new_password" placeholder="New Password">
                        @if ($errors->has('new_password')) <div class="invalid-feedback">{{
                          $errors->first('new_password') }}</div>@endif
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
                        @error('address')<span class="invalid-feedback" role="alert"> <strong>{{ $message
                            }}</strong></span>@enderror
                      </div>
                    </div>
                  </div>


                  <div class="form-group row">

                    <div class="col-sm-4">
                      <label for="exampleInputEmail1" class="col-sm-4 col-form-label">Country</label>
                      <div class="col-sm-8">
                        <input name="country" type="text" id="email"
                          value="{{{ old('country', isset($user_detail) ? $user_detail->country : null) }}}"
                          class="form-control @error('country') is-invalid @enderror" placeholder="Enter Country" />
                        @error('country')<span class="invalid-feedback" role="alert"> <strong>{{ $message
                            }}</strong></span>@enderror
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <label for="exampleInputEmail1" class="col-sm-4 col-form-label">City</label>
                      <div class="col-sm-8">
                        <input name="city" type="text" id="city"
                          value="{{{ old('city', isset($user_detail) ? $user_detail->city : null) }}}"
                          class="form-control text-left @error('city') is-invalid @enderror" placeholder="Enter City" />
                        @error('city')<span class="invalid-feedback" role="alert"> <strong>{{ $message
                            }}</strong></span>@enderror
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <label for="exampleInputEmail1" class="col-sm-5 col-form-label row">Postal Code</label>
                      <div class="col-sm-8">
                        <input name="postal_code" type="text" id="email"
                          value="{{{ old('postal_code', isset($user_detail) ? $user_detail->postal_code : null) }}}"
                          class="form-control text-left @error('postal_code') is-invalid @enderror"
                          placeholder="Enter Postal Code" />
                        @error('postal_code')<span class="invalid-feedback" role="alert"> <strong>{{ $message
                            }}</strong></span>@enderror
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-6">
                      <label for="exampleInputEmail1" class="col-sm-4 col-form-label">Phone</label>
                      <div class="col-sm-12">
                        <input name="phone" type="number" id="email"
                          value="{{{ old('phone', isset($user_detail) ? $user_detail->phone : null) }}}"
                          class="form-control @error('phone') is-invalid @enderror" placeholder="Enter Phone" />
                        @error('phone')<span class="invalid-feedback" role="alert"> <strong>{{ $message
                            }}</strong></span>@enderror
                      </div>
                    </div>


                  </div>

                  <div class="form-group row">


                    <label for="exampleInputEmail1" class="col-sm-2 col-form-label">service</label>
                    <div class="col-sm-12">
                      <select class="js-example-basic-multiple form-control " name="service[]" multiple="multiple">
                        @foreach ($service as $service_list)
                        <option value="{{$service_list->id}}" @if(in_array($service_list->id,$user_service_ids))
                          selected @endif>{{$service_list->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    @error('service')<span class="invalid-feedback" role="alert"> <strong>{{
                        $message."sdfsf"}}</strong></span>@enderror
                  </div>


                  <div class="form-group row">
                    <label for="exampleInputEmail1" class="col-sm-2 col-form-label">About Me</label>
                    <div class="col-sm-12">
                      <textarea rows="4" cols="50" name="about" type="number" id="email" value=""
                        class="form-control @error('about') is-invalid @enderror"
                        placeholder="About Me">{{{ old('about', isset($user_detail) ? $user_detail->about : null) }}}</textarea>
                      @error('about')<span class="invalid-feedback" role="alert"> <strong>{{ $message
                          }}</strong></span>@enderror
                    </div>
                  </div>



                  <div class="form-group row">
                    <label for="exampleInputEmail1" class="col-sm-2 col-form-label">Experience</label>
                    <div class="col-sm-12">
                      <textarea rows="4" cols="50" name="experience" type="number" id="email" value=""
                        class="form-control @error('experience') is-invalid @enderror"
                        placeholder="Experience">{{{ old('experience', isset($user_detail) ? $user_detail->experience : null) }}}</textarea>
                      @error('experience')<span class="invalid-feedback" role="alert"> <strong>{{ $message
                          }}</strong></span>@enderror
                    </div>
                  </div>


                  <div class="form-group row">
                    <label for="exampleInputEmail1" class="col-sm-2 col-form-label">Expertise</label>
                    <div class="col-sm-12">
                      <textarea rows="4" cols="50" name="expertise" type="number" id="email" value=""
                        class="form-control @error('expertise') is-invalid @enderror"
                        placeholder="Expertise">{{{ old('expertise', isset($user_detail) ? $user_detail->expertise : null) }}}</textarea>
                      @error('expertise')<span class="invalid-feedback" role="alert"> <strong>{{ $message
                          }}</strong></span>@enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="exampleInputEmail1" class="col-sm-2 col-form-label">Testimonials</label>
                    <div class="col-sm-12">
                      <textarea rows="4" cols="50" name="testimonials" type="number" id="email" value=""
                        class="form-control @error('testimonials') is-invalid @enderror"
                        placeholder="Testimonial">{{{ old('testimonials', isset($user_detail) ? $user_detail->testimonials : null) }}}</textarea>
                      @error('testimonials')<span class="invalid-feedback" role="alert"> <strong>{{ $message
                          }}</strong></span>@enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="exampleInputEmail1" class="col-sm-2 col-form-label">Website Link</label>
                    <div class="col-sm-12">
                      <textarea rows="4" cols="50" name="website_link" type="number" id="email" value=""
                        class="form-control @error('website_link') is-invalid @enderror"
                        placeholder="Website Link">{{{ old('website_link', isset($user_detail) ? $user_detail->website_link : null) }}}</textarea>
                      @error('website_link')<span class="invalid-feedback" role="alert"> <strong>{{ $message
                          }}</strong></span>@enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="exampleInputEmail1" class="col-sm-2 col-form-label">Contact Button</label>
                    <div class="col-sm-12">
                      <textarea rows="4" cols="50" name="contact_button" type="number" id="email" value=""
                        class="form-control @error('contact_button') is-invalid @enderror"
                        placeholder="Contact Button">{{{ old('contact_button', isset($user_detail) ? $user_detail->contact_button : null) }}}</textarea>
                      @error('contact_button')<span class="invalid-feedback" role="alert"> <strong>{{ $message
                          }}</strong></span>@enderror
                    </div>
                  </div>


                  <div class="form-group row" style="margin-left: -31px;">
                    <div class="col-sm-6">
                      <label for="exampleInputEmail1" class="col-sm-4 col-form-label">Add Caption</label>
                      <div class="col-sm-12">
                        <input name="caption" type="text" id="email" value="{{$user_detail->caption}}"
                          class="form-control @error('caption') is-invalid @enderror" style="height: 42px;"
                          placeholder="Enter Caption" />
                        @error('caption')<span class="invalid-feedback" role="alert"> <strong>{{ $message
                            }}</strong></span>@enderror
                      </div>
                    </div>


                    <div class="col-sm-6">
                      <label for="exampleInputEmail1" class="col-sm-4 col-form-label">Add Certificate</label>
                      <div class="custom-file col-sm-12">
                        <input type="file" class="custom-file-input" id="files" name="image[]" multiple
                          accept="image/*">
                        <label class="custom-file-label" for="inputGroupFile03">Add Certificate</label>
                        @error('image')<span class="invalid-feedback" role="alert"> <strong>{{ $message
                            }}</strong></span>@enderror
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
         formData.append('image',files[0]);
         providerProfile

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

</script>
@endsection