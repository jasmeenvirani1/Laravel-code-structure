@extends('front.partial.app')
@section('content')
    <div class="privider-bg">
        <img class="img-fluid" src="{{ asset($user_data->cover_image) }}" style="height: 65vh;  object-fit: cover;">
    </div>

    <div class="container">

        <div class="row">
            <div class="col-md-6 col-lg-8">
                <div class="prifile-icons">
                    <img src="{{ asset($user_data->profile_image) }}">
                </div>

                <div class="profile-content">
                    <h4 class="heading-fiver">{{ $user_data->name }}</h4>
                    <h3 class="heading-fiver-small">Fitness Profession (Job Title)</h3>
                    <h3 class="heading-fiver-small">{{ $user_data->city }},{{ $user_data->location }}</h3>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="profile-social-part">
                    <ul class="chat-part">
                        <li><i class="fa fa-commenting-o"></i> Start a Chat</li>
                        <li><i class="fa fa-heart-o"></i> Save to faves</li>
                    </ul>
                </div>


                <div class="social-icons">
                    <ul>
                        <li><a href="{{ $user_data->facebook }}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="{{ $user_data->twitter }}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="{{ $user_data->instagram }}"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        </li>
                        <li><a href="{{ $user_data->linkedin }}"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="video-bg-part">
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <div class="video-left">
                        <h4 class="heading-four">ABOUT ME</h4>
                        <p class="commannn">{{ $user_data->about }} </p>
                    </div>
                </div>
                @if(strlen($user_data->profile_video) > 0)
                <div class="col-md-6 col-lg-6">
                    <div class="video-part">
                        <video width="350" height="260" controls>
                            <source src="{{ $user_data->profile_video }}" type="video/mp4">
                            <source src="{{ $user_data->profile_video }}" type="video/ogg">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>


    <div class="what-i-we-offer">
        <div class="container">
            <h4 class="heading-one">WHAT I OFFER</h4>
        </div>
    </div>

    <div class="container">
        <div class="more-space">
            <div class="row">
                @foreach ($keyword_list as $keyword)
                    <div class="col-md-4 col-lg-3">
                        <div class="offer-btn"><a href="javascript:void(0);">{{$keyword->keyword}}</a></div>
                    </div>
                @endforeach
            </div>


            <div class="row">
                <div class="col-md-4 col-lg-4">
                    <div class="p-img">
                        <img class="img-fluid" src="{{ asset('frontend/img/profile1.jpg') }}">
                    </div>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="p-img">
                        <img class="img-fluid" src="{{ asset('frontend/img/profile2.jpg') }}">
                    </div>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="p-img">
                        <img class="img-fluid" src="{{ asset('frontend/img/profile3.jpg') }}">
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="what-i-we-offer">
        <div class="container">
            <h4 class="heading-one">EDUCATION & TRAINING</h4>
        </div>
    </div>
    <div class="container">
        <div class="more-space">
            <div class="heading-part">
                <h3 class="heading-three">NAIT Personal Training Program Diploma</h3>
                <p class="p-comman">Lorem ipsum dolor sit amel, consectetur adipiscing ellt, sea do elusmod tempor
                    incidiaun u aore et dolore magna aiaua. auis nostrud exercitation ulamco aboris nisi ut aliauip</p>
            </div>

            <div class="heading-part">
                <h3 class="heading-three">CSEP-CPT</h3>
                <p class="p-comman">Lorem ipsum dolor sit amel, consectetur adipiscing ellt, sea do elusmod tempor
                    incidiaun u aore et dolore magna aiaua. auis nostrud exercitation ulamco aboris nisi ut aliauip</p>
            </div>

            <div class="heading-part">
                <h3 class="heading-three">Moksha Yoga Training</h3>
                <p class="p-comman">Lorem ipsum dolor sit amel, consectetur adipiscing ellt, sea do elusmod tempor
                    incidiaun u aore et dolore magna aiaua. auis nostrud exercitation ulamco aboris nisi ut aliauip</p>
            </div>

            <div class="submit-btn text-left">
                <button type="button" class="btn btn-primary">VIEW MORE</button>
            </div>

            <div class="client-bg">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="client-feedback">
                                “Cotie helped get me on track for a marathon <br> I had my sights set on! <br> I’ve
                                never felt better!”
                                <span>- Jillian G </span>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="client-feedback">
                                “Cotie helped get me on track for a marathon <br> I had my sights set on! <br> I’ve
                                never felt better!”
                                <span>- Jillian G </span>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="client-feedback">
                                “Cotie helped get me on track for a marathon <br> I had my sights set on! <br> I’ve
                                never felt better!”
                                <span>- Jillian G </span>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="what-i-we-offer">
        <div class="container">
            <h4 class="heading-one">PRODUCTS + SERVICES</h4>
        </div>
    </div>

    <div class="container">
        <div class="more-space">
            <div class="row">
                <div class="col-md-4 col-lg-4">
                    <div class="s-part">
                        <div class="s-img">
                            <img class="img-fluid" src="img/services1.jpg">
                        </div>
                        <h4 class="p-comman-service">Crushing With Cotie
                            Fitness E-Book
                            <span>$24.99</span>
                        </h4>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="s-part">
                        <div class="s-img">
                            <img class="img-fluid" src="img/services2.jpg">
                        </div>
                        <h4 class="p-comman-service">4 Week Summer Bootcamp
                            <span>$44.99</span>
                        </h4>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="s-part">
                        <div class="s-img">
                            <img class="img-fluid" src="img/services3.jpg">
                        </div>
                        <h4 class="p-comman-service">Nutrition Consultation
                            <span>$19.99</span>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="what-i-we-offer">
        <div class="container">
            <h4 class="heading-one">INSTAGRAM FEED</h4>
        </div>
    </div>

    <div class="container">
        <div class="more-space">
            <div class="row">
                <div class="col-xs-6 col-md-6 col-lg-4">
                    <div class="instagram-img">
                        <img class="img-fluid" src="{{ asset('frontend/img/insta1.jpg') }}">
                    </div>
                </div>
                <div class="col-xs-6 col-md-6 col-lg-4">
                    <div class="instagram-img">
                        <img class="img-fluid" src="{{ asset('frontend/img/insta2.jpg') }}">
                    </div>
                </div>
                <div class="col-xs-6 col-md-6 col-lg-4">
                    <div class="instagram-img">
                        <img class="img-fluid" src="{{ asset('frontend/img/insta3.jpg') }}">
                    </div>
                </div>
                <div class="col-xs-6 col-md-6 col-lg-4">
                    <div class="instagram-img">
                        <img class="img-fluid" src="{{ asset('frontend/img/insta4.jpg') }}">
                    </div>
                </div>
                <div class="col-xs-6 col-md-6 col-lg-4">
                    <div class="instagram-img">
                        <img class="img-fluid" src="{{ asset('frontend/img/insta5.jpg') }}">
                    </div>
                </div>
                <div class="col-xs-6 col-md-6 col-lg-4">
                    <div class="instagram-img">
                        <img class="img-fluid" src="{{ asset('frontend/img/insta6.jpg') }}">
                    </div>
                </div>
            </div>

            <div class="profile-provi">
                <button type="button" class="btn btn-primary">CONTACT THIS TRAINER TODAY!</button>
            </div>
        </div>
    </div>
@endsection
