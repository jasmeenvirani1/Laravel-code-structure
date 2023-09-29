<!-- [ navigation menu ] start -->
<nav class="pcoded-navbar menupos-fixed menu-light ">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div ">
            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item pcoded-menu-caption">
                    <label>Navigation</label>
                </li>
                @if (CheckPermissionForUser('dashbord') == true)
                    <li class="nav-item">
                        <a href="{{ route('user.home') }}" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-home"></i></span><span class="pcoded-mtext">
                                @if (session()->get('UserSession.role_id') == 3 || session()->get('UserSession.role_id') == 2)
                                    MATCHES
                                @else
                                    Dashboard
                                @endif
                            </span></a>
                    </li>
                @endif

                @if (CheckPermissionForUser('users') == true)
                    <li class="nav-item">
                        <a href="{{ route('list.users') }}" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-user"></i></span><span class="pcoded-mtext">Manage
                                User</span></a>
                    </li>
                @endif

                @if (CheckPermissionForUser('question') == true ||
                        CheckPermissionForUser('service') == true ||
                        CheckPermissionForUser('subscription') == true)
                    <li class="nav-item pcoded-menu-caption">
                        <label>Masters</label>
                    </li>
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-layout"></i></span><span class="pcoded-mtext">Masters</span></a>

                        <ul class="pcoded-submenu">
                            @if (CheckPermissionForUser('question') == true)
                                <li><a href="{{ route('list.question') }}">Question Master</a></li>
                            @endif

                            @if (CheckPermissionForUser('service') == true)
                                <li><a href="{{ route('list.service') }}">Service Master</a></li>
                            @endif

                            @if (CheckPermissionForUser('subscription') == true)
                                <li><a href="{{ route('list.subscription') }}">Plan Master</a></li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (CheckPermissionForUser('manage-page') == true)
                    <li class="nav-item">
                        <a href="{{ route('list.manage-page') }}" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-command"></i></span><span class="pcoded-mtext">Manage Pages
                            </span></a>
                    </li>
                @endif
                @if (CheckPermissionForUser('favourite') == true && session()->get('UserSession.role_id') != 1 )
                    <li class="nav-item">
                        <a href="{{ route('list.favourite') }}" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-heart"></i></span><span
                                class="pcoded-mtext">FAVOURITES</span></a>
                    </li>
                @endif

                @if (CheckPermissionForUser('keyword') == true)
                    <li class="nav-item">
                        <a href="{{ route('list.keyword') }}" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-sunset"></i></span><span class="pcoded-mtext">Keywords</span></a>
                    </li>
                @endif

                @if (CheckPermissionForUser('permission') == true)
                    <li class="nav-item">
                        <a href="{{ route('list.permission') }}" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-lock"></i></span><span class="pcoded-mtext">Mange
                                Permission</span></a>
                    </li>
                @endif

                @if (CheckPermissionForUser('email-configuration') == true)
                    <li class="nav-item">
                        <a href="{{ route('list.email-configuration') }}" class="nav-link "><span
                                class="pcoded-micon"><i class="feather icon-mail"></i></span><span
                                class="pcoded-mtext">Email
                                Configuration</span></a>
                    </li>
                @endif
                @if (CheckPermissionForUser('setting') == true)
                    <li class="nav-item">
                        <a href="{{ route('list.setting') }}" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-settings"></i></span><span
                                class="pcoded-mtext">Settings</span></a>
                    </li>
                @endif
                @if (CheckPermissionForUser('user-setting') == true && session()->get('UserSession.role_id') != 1)
                    <li class="nav-item">
                        <a href="{{ route('list.user.setting') }}" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-settings"></i></span><span class="pcoded-mtext">SETTINGS</span></a>
                    </li>
                @endif
                {{-- @if (CheckPermissionForUser('matches') == true && session()->get('UserSession.role_id') == 3)
                    <li class="nav-item">
                        <a href="{{ route('list.user.matches') }}" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-sliders"></i></span><span
                                class="pcoded-mtext">Matches</span></a>
                    </li>
                @endif --}}
                @if (session()->get('UserSession.role_id') == 3 || session()->get('UserSession.role_id') == 2)
                    <li class="nav-item">
                        <a href="{{ route('admin.user.edit') }}" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-user"></i></span><span class="pcoded-mtext">EDIT MY
                                PROFILE</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('front.support') }}" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-wind"></i></span><span class="pcoded-mtext">SUPPORT</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('front.get-pages', ['slug' => 'faq']) }}" class="nav-link "><span
                                class="pcoded-micon"><i class="feather icon-compass"></i></span><span
                                class="pcoded-mtext">FAQ</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('front.get-feedback') }}" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-thumbs-up"></i></span><span
                                class="pcoded-mtext">FEEDBACK</span></a>
                    </li>
                @endif
                
                @if (session()->get('UserSession.role_id') == 1)
                    <li class="nav-item">
                        <a href="{{ route('list.workout') }}" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-droplet"></i></span><span
                                class="pcoded-mtext">Workout</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('list.fitness-goal') }}" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-target"></i></span><span class="pcoded-mtext">Fitness
                                goal</span></a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('user.logout') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-log-out"></i></span><span class="pcoded-mtext">Logout</span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- [ navigation menu ] end -->
