@extends('front.partial.app')
@section('content')
<!-- Modal -->
<div class="modal fade sign-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <img src="{{ asset('frontend/img/close-iocn.png') }}">
        </button>
      </div>
      <div class="modal-body">
        <div class="modal-form">
          <div class="flit-iocn"><img src="{{ asset('frontend/img/flit-icon.png') }}"></div>
          <h1 class="pop-heading">Get started with your free account.</h1>
          <p class="pop-title">Find your next workout. Connect directly with Fitness Providers in your area.
            Explore
            your fitness community. Stay motivated with FLIT.</p>

          <div class="signup-pop">
            <form action="javascript:void(0);" id="SeekerSingupForm">
              <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <span class="input-error" role="alert"> <strong singup-data-input-error="email"></strong></span>
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">USERNAME</label>
                <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <span class="input-error" role="alert"> <strong singup-data-input-error="username"></strong></span>
              </div>


              <div class="form-group">
                <label for="exampleInputPassword1">Password <span><i class="fa fa-eye eye" aria-hidden="true"></i>
                    <span class="eye hide-show-text-class"> Show</span></label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                <span class="input-error" role="alert"> <strong singup-data-input-error="password"></strong></span>

              </div>

              <div class="get-btn">
                <button type="submit" class="btn btn-primary singup-submit-btn">GET STARTED</button>
                
              </div>
            </form>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>



<div class="container-fluid">
  <div class="row align-items-center">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 text-end forexbnr_left pl-0"></div>
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 my-3 mb-6">

      <div class="login-frm">
        <span class="input-error" role="alert"> <strong add-data-input-error="other-error"></strong></span>
        <h1 class="login-heading">Log Into Flit</h1>
        <form action="javascript:void(0);" id="loginFrom">

          <div class="form-group">
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
              placeholder="Email" name="email">
            <span class="input-error" role="alert"> <strong add-data-input-error="email"></strong></span>
          </div>

          <div class="form-group">
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"
              name="password">
            <span class="input-error" role="alert"> <strong add-data-input-error="password"></strong></span>
          </div>

          <button type="submit" class="btn btn-primary login-submit-btn">Log in</button>
        </form>

        <div class="forgot"><a href="#">Forgot Account?</a></div>
        <div class="org">OR</div>
        <h2 class="login-heading">Create New Account</h2>

        <div class="buton-group">
          <p>Fitness Providers <a href="{{ route('front.pricing') }}">View Plans</a></p>
          <p>Fitness Seeker <a href="#" data-toggle="modal" data-target="#exampleModal">Sign Up</a></p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('page-script')
<script>
  $("#loginFrom").submit(function(event) {
            $(".login-submit-btn").text('Loging....');
            var data = $(this).serializeArray();

            var formData = new FormData();
            formData = getFormData(data);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ route('front.post-login') }}",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == 422) {
                        const ErrorResponce = JSON.stringify(response);
                        manageErrors(ErrorResponce, "loginFrom", 'add');
                        $(".login-submit-btn").text('Log in');
                    } else if (response.status == 200) {
                        window.location.replace("{{ route('user.home') }}")
                    }
                },
                error: function(response, status, error) {
                    manageErrors(response.responseText, "loginFrom", 'add');
                    $(".login-submit-btn").text('Log in');
                }
            });
        });
</script>
<script>
  var count = 0;
        $(".eye").click(function() {
            if (count % 2 == 0) {
                $("#exampleInputPassword1").attr('type', 'text');
                $(".hide-show-text-class").text('Hide');

            } else {
                $("#exampleInputPassword1").attr('type', 'password');
                $(".hide-show-text-class").text('Show');
            }
            count++;
        });
        exampleInputPassword1
</script>
<script>
  $("#SeekerSingupForm").submit(function(event) {
            $(".singup-submit-btn").text('Loding....');
            var data = $(this).serializeArray();

            var formData = new FormData();
            formData = getFormData(data);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ route('front.seeker.singup') }}",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {
                  console.log(response.status);
                    if (response.status == 422) {
                        const ErrorResponce = JSON.stringify(response);
                        manageErrors(ErrorResponce, this, 'singup');
                        $(".singup-submit-btn").text('GET STARTED');
                    } else if (response.status == 200) {
                        window.location.replace("{{ route('front.match') }}")
                    }
                },
                error: function(response, status, error) {
                    manageErrors(response.responseText, this, 'singup');
                    $(".singup-submit-btn").text('GET STARTED');
                }
            });
        });
</script>
@endsection