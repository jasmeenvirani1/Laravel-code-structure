<!-- Header Part Start -->
<header class="header top-bg">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="{{ route('front.explore-fitness') }}"><img class="img-fluid"
                    src="{{ asset('frontend/img/flit-logo.png') }}" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li @if (url()->current() == route('front.get-pages', ['slug' => 'faq'])) class="nav-item active" @else class="nav-item" @endif>
                        <a class="nav-link" href="{{ route('front.get-pages', ['slug' => 'faq']) }}">Faq</a>
                    </li>
                    @if (Session::get('UserSession.role_id') == '3')
                        <li @if (url()->current() == route('front.match')) class="nav-item active" @else class="nav-item" @endif><a
                                class="nav-link" href="{{ route('front.match') }}">Match</a></li>
                        <li @if (url()->current() == route('front.explore-fitness')) class="nav-item active" @else class="nav-item" @endif><a
                                class="nav-link" href="{{ route('front.explore-fitness') }}">Explore</a></li>
                    @endif
                    @if (Session::has('UserSession'))
                        <li @if (url()->current() == route('user.home')) class="nav-item active" @else class="nav-item" @endif>
                            <a class="nav-link" href="{{ route('user.home') }}">Dashboard</a>
                        </li>
                    @endif
                </ul>
            </div>

            @if (Session::has('UserSession'))
                <div class="prifile-icon">
                    <div class="dropdown">
                        <a href="#" data-toggle="dropdown"><i class="fa fa-user-circle-o"></i></a>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            @if (Session::get('UserSession.role_id') != 1)
                                <li><a href="{{ route('admin.user.edit') }}"> <i class="fa fa-user-circle-o"></i>
                                        &nbsp Profile</a></li>

                                    <li><a href="{{ route('front.get-profile',['id'=>Session::get('UserSession.id')]) }}"> <i class="fa fa-eye"></i>
                                            &nbsp
                                            View Profile</a></li>
                               
                                <li><a href="{{ route('front.get-feedback') }}"> <i class="fa fa-comments-o"></i>
                                        &nbsp Feedback</a></li>
                                <li><a href="{{ route('user.logout') }}"> <i class="fa fa-sign-out"></i> &nbsp
                                        Logout</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            @endif
        </nav>
    </div>
</header>
<style>
    .dropdown-menu {
        /* background-color: #000; */
        background-color: #fff;
        color: black !important;
        margin: 0.125rem -106px 0 !important;
    }

    .dropdown-menu>li>a {
        color: #000;
        font-size: 20px;
    }
</style>
{{-- <div class="dropdown-menu dropdown-menu-right profile-notification show">
    <div class="pro-head">
        <img src="http://127.0.0.1:8000/backend/upload/provider_profile/1676030662_trainer4.jpg"
            class="img-radius hig-40" alt="User-Profile-Image" style="height: 40px;">
        <span>Shivam</span>
    </div>

    <ul class="pro-body">
        <li><a href="http://127.0.0.1:8000/backend/users/edit" class="dropdown-item"><i class="feather icon-user"></i>
                Profile</a></li>
        <li><a href="http://127.0.0.1:8000/get-provider-profile" class="dropdown-item"><i class="feather icon-eye"></i>
                View Profile</a></li>
        <li><a href="http://127.0.0.1:8000/logout" class="dropdown-item"><i class="feather icon-log-out"></i>
                Logout</a></li>
    </ul>
</div> --}}
