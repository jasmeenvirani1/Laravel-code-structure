<!-- [ Header ] start -->
<header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed header-blue">

    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        <a href="{{ route('user.home') }}" class="b-brand">
            <!-- ========   change your logo hear   ============ -->
            <img src="{{ asset('frontend/img/flit-logo.png') }}" alt="Flit logo" class="logo">
            <img src="{{ asset('backend/images/logo-icon.png') }}" alt="" class="logo-thumb">
        </a>
        <a href="#" class="mob-toggler">
            <i class="feather icon-more-vertical"></i>
        </a>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a href="#" class="full-screen" onclick="javascript:toggleFullScreen()"><i
                        class="feather icon-maximize"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li>
                <div class="dropdown">
                    {{-- @if (Session::get('UserSession.role_id') == 3) --}}
                    <a class="dropdown-toggle" href="{{ route('front.explore-fitness') }}" title="Explore Fitness"><i
                            class="feather icon-search" style="font-size: 20px;"></i></a>
                    &nbsp &nbsp
                    <a class="dropdown-toggle" href="{{ route('front.match') }}" title="Matchs"> <img src="{{asset('frontend\img/flit-icon-header.png')}}" class="icon-flit-image"></a>
                    &nbsp &nbsp
                    {{-- <a class="dropdown-toggle" href="javascript:void(0);" title="Chats"> <i
                            class="feather icon-message-circle" style="font-size: 20px;"></i></a> --}}
                    {{-- @endif --}}
                </div>
            </li>
            @php
                $path = GetCurrentProfile();
            @endphp
            <li>
                <div class="dropdown drp-user">
                    <a href="#!" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset($path) }}" class="img-radius wid-40 hig-40" alt="User-Profile-Image"
                            style="height: 40px;">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-notification">
                        <div class="pro-head">
                            <img src="{{ asset($path) }}" class="img-radius hig-40" alt="User-Profile-Image"
                                style="height: 40px;">
                            <span>{{ ucwords(Session::get('UserSession')['name']) }}</span>
                        </div>

                        <ul class="pro-body">
                            @if (Session::get('UserSession.role_id') != 1)
                                <li><a href="{{ route('admin.user.edit') }}" class="dropdown-item"><i
                                            class="feather feather-black icon-user"></i>
                                        Profile</a></li>
                                    <li><a href="{{ route('front.get-profile',['id'=>Session::get('UserSession.id')]) }}" class="dropdown-item"><i
                                                class="feather feather-black icon-eye"></i>
                                            View Profile</a></li>
                               
                                <li><a href="{{ route('list.user.setting') }}" class="dropdown-item"><i
                                            class="feather feather-black icon-settings"></i>
                                        Setting</a></li>
                            @endif
                            <li><a href="{{ route('front.support') }}" class="dropdown-item"><i
                                        class="feather feather-black icon-wind"></i>
                                    Support</a></li>
                            <li><a href="{{ route('user.logout') }}" class="dropdown-item"><i
                                        class="feather feather-black icon-log-out"></i>
                                    Logout</a></li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</header>
<!-- [ Header ] end -->