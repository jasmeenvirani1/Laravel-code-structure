@extends('front.partial.app')
@section('content')
    <div class="privider-bg">
        <img class="img-fluid" src="{{ asset($user_data->cover_image) }}" style="height: 65vh; object-fit: cover">
    </div>

    <div class="container">

        <div class="row">
            <div class="col-md-6 col-lg-8">
                <div class="prifile-icons">
                    <img src="{{ asset($user_data->profile_image) }}">
                </div>

                <div class="profile-content">
                    <h4 class="heading-fiver">{{ $user_data->name }}</h4>
                    <h3 class="heading-fiver-small">{{ $user_data->location }}</h3>
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
                <div class="col-md-12 col-lg-6">
                    <div class="video-left">
                        <h4 class="heading-four">ABOUT ME</h4>
                        <p class="commannn col-md-12" >{{ $user_data->about }} </p>
                    </div>
                </div>
                {{-- <div class="col-md-6 col-lg-6">
                    <div class="video-part">
                        <video width="350" height="260" controls>
                            <source src="{{ $user_data->profile_video }}" type="video/mp4">
                            <source src="{{ $user_data->profile_video }}" type="video/ogg">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
