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
                            
                            <form action="javascript:void(0);" id="ProviderSingupForm">
                                <input type="hidden" name="role" value="2">
                                <input type="hidden" name="plan_id" value="0">
                                <input type="hidden" name="plan_id" value="0">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                    <span class="input-error" role="alert"> <strong
                                            singup-data-input-error="email"></strong></span>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">USERNAME</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                    <span class="input-error" role="alert"> <strong
                                            singup-data-input-error="name"></strong></span>
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password <span><i class="fa fa-eye eye"
                                                aria-hidden="true"></i>
                                            <span class="eye hide-show-text-class"> Show</span></label>
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                                    <span class="input-error" role="alert"> <strong
                                            singup-data-input-error="password"></strong></span>
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



    <div class="explore-bg">
        <div class="container">
            <div class="pricing-padding">
                <div class="row">
                    <div class="col-lg-6 text-center">
                        <p class="p-titile">FLIT is a platform to <span>Showcase</span> Your
                            services and <span>Connect</span> with new Clients
                            in the fitness and wellness space.</p>
                        <p class="p-titile-small">Are you a fitness Seeker?
                            <span><a href="javascript:void(0);" data-toggle="modal" data-target="#singUpSeekerModel">Create
                                    your free account here!</a></span>
                        </p>
                    </div>

                    @foreach ($subscription_plans as $planlist)
                        <div class="col-lg-3">
                            <div class="memeber-box">
                                <h1 class="mb-heading">Fitness <span>pro</span>vider</h1>
                                <h2 class="mbs-heading">{{ ucwords($planlist->type) }}</h2>
                                <p class="m-title">${{ ucwords($planlist->price) }}/{{ ucwords($planlist->type) }}</p>
                                <p class="m-sm-title">{{ ucwords($planlist->description) }}</p>
                                <a class="join-now-btn"
                                    href="{{ route('front.create-account', ['id' => $planlist->id]) }}">Join
                                    Now!</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <p class="com-title">Not ready to commint to FLIT? <a href="javascript:void(0);" data-toggle="modal"
                        data-target="#exampleModal">Start with a free account.</a></p>
            </div>
        </div>
    </div>


    <div class="wrap">
        <div class="mem-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mem-mobile">
                            <img src="{{ asset('frontend/img/mobile.png') }}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="m-include">
                            <h4 class="m-includs">Your Membership Includes:</h4>
                            <ul class="m-list">
                                <li>Full Access to the Professional Dashboard
                                    <span> Manage Your leads, view engagement and chat directly with Fitness Seekers
                                        who<br>
                                        have matched with your skillset and offerings.</span>
                                </li>
                                <li>Full Access to the Professional Dashboard
                                    <span> Manage Your leads, view engagement and chat directly with Fitness Seekers
                                        who<br>
                                        have matched with your skillset and offerings.</span>
                                </li>
                                <li>Full Access to the Professional Dashboard
                                    <span> Manage Your leads, view engagement and chat directly with Fitness Seekers
                                        who<br>
                                        have matched with your skillset and offerings.</span>
                                </li>
                                <li>Full Access to the Professional Dashboard
                                    <span> Manage Your leads, view engagement and chat directly with Fitness Seekers
                                        who<br>
                                        have matched with your skillset and offerings.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d_pricing_img_bg">
            <div class="container">
                <div class="pricing"><img src="{{ asset('frontend/img/pricing-img2.jpg') }} "></div>
            </div>
        </div>

        <div class="m_pricing_img_bg">
            <div class="pricing"><img src="{{ asset('frontend/img/m-pricing-img1.jpg') }} "></div>
            <div class="pricing"><img src="{{ asset('frontend/img/m-pricing-img2.jpg') }} "></div>
        </div>

    </div>

    </div>

    <div class="free-trial">Start your free two week trial</div>


    <!-- Modal -->
    <div class="modal fade sign-modal" id="singUpSeekerModel" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                    <span class="input-error" role="alert"> <strong
                                            singup-data-input-error="email"></strong></span>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">USERNAME</label>
                                    <input type="text" name="username" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                    <span class="input-error" role="alert"> <strong
                                            singup-data-input-error="username"></strong></span>
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password <span><i class="fa fa-eye eye"
                                                aria-hidden="true"></i>
                                            <span class="eye hide-show-text-class"> Show</span></label>
                                    <input type="password" name="password" class="form-control exampleInputPassword1"
                                        id="exampleInputPassword1">
                                    <span class="input-error" role="alert"> <strong
                                            singup-data-input-error="password"></strong></span>

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
@endsection
@section('page-script')
    <script>
        var count = 0;
        $(".eye").click(function() {
            if (count % 2 == 0) {
                $("#exampleInputPassword1").attr('type', 'text');
                $(".exampleInputPassword1").attr('type', 'text');
                $(".hide-show-text-class").text('Hide');

            } else {
                $("#exampleInputPassword1").attr('type', 'password');
                $(".exampleInputPassword1").attr('type', 'password');
                $(".hide-show-text-class").text('Show');
            }
            count++;
        });
        exampleInputPassword1
    </script>

    <script>
        $("#ProviderSingupForm").submit(function(event) {
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
                url: "{{ route('front.post-create-provider-account') }}",
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
                        window.open("{{ route('front.get-pages',['slug'=>'privacy-policy']) }}")
                    }
                },
                error: function(response, status, error) {
                    manageErrors(response.responseText, this, 'singup');
                    $(".singup-submit-btn").text('GET STARTED');
                }
            });
        });
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
