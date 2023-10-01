<header class="header rs-nav">

    <div class="sticky-header navbar-expand-lg">
        <div class="menu-bar clearfix">
            <div class="container clearfix">
                <!-- Header Logo ==== -->
                <div class="menu-logo">
                    <a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo-icons/discover time12-croped.png') }}" alt=""></a>
                </div>
                <!-- Mobile Nav Button ==== -->
                <button class="navbar-toggler collapsed menuicon justify-content-end" type="button"
                    data-toggle="collapse" data-target="#menuDropdown" aria-controls="menuDropdown"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <!-- Author Nav ==== -->

                <div class="custom-menu-links">
                    <ul class="nav navbar-nav"
                        style="display: flex; justify-content: space-between; flex-direction: row;">
                        @if (!session()->has('user'))
                            <li class="custom-menu-button">
                                <div class="custom-menu-button-link">
                                    <a href="{{ route('loginpage') }}" class="ud-btn ud-btn-secondary">
                                        <span>Log in</span>
                                    </a>
                                </div>
                            </li>
                            <li class="custom-menu-button">
                                <div class="custom-menu-button-link">
                                    <a href="{{ route('registerpage') }}" class="ud-btn ud-btn-primary">
                                        <span>Sign up</span>
                                    </a>
                                </div>
                            </li>
                        @endif
                        @if (session()->has('user'))
                            @if (session()->get('user')->admin_role)
                                {{-- administratr --}}
                                <li class="active custom-menu-button">
                                    <a href="javascript:;" > Dashboard <i
                                            class="fa fa-chevron-down"></i></a>
                                    <ul class="custom-sub-menu">
                                        <li class="custom-avatar-wrraper">
                                                <img src="{{ asset('assets/images/profile/' . session()->get('user')->photo) }}"
                                                    alt="">
                                                <span class="custom-details">
                                                    <div class="custom-heading">{{ session()->get('user')->username }}
                                                    </div>
                                                    <div class="custom-text">{{ session()->get('user')->email }}</div>
                                                </span>
                                        </li>
                                        <li><a href="{{ route("ad_dashboard") }}">Dashboard</a></li>
                                        <li><a href="{{ route('ad_lectures.index') }}">Lectures</a></li>
                                        <li><a href="{{ route('logout') }}">Log out</a></li>
                                    </ul>
                                </li>
                            @else
                            {{-- default user --}}
                                <li class="active custom-menu-button">
                                    <a href="javascript:;" > Profile 
                                        <i class="fa fa-chevron-down"></i></a>
                                    <ul class="custom-sub-menu">
                                        <li class="custom-avatar-wrraper">
                                                <img src="{{ asset('assets/images/profile/' . session()->get('user')->photo) }}"
                                                    alt="">
                                                <span class="custom-details">
                                                    <div class="custom-heading">{{ session()->get('user')->username }}
                                                    </div>
                                                    <div class="custom-text">{{ session()->get('user')->email }}</div>
                                                </span>
                                        </li>
                                        <li><a href="{{ route("u_dashboard") }}">Dashboard</a></li>
                                        <li><a href="{{ route("u_notifications") }}">Notifications</a></li>
                                        <li><a href="{{ route('u_calendar') }}">Calendar events</a></li>
                                        <li><a href="{{ route('u_lectures') }}">My Lectures</a></li>
                                        <li><a href="{{ route('logout') }}">Log out</a></li>
                                    </ul>
                                </li>
                            @endif
                        @endif

                       
                    </ul>
                </div>
                <!-- Search Box ==== -->
                <!-- Navigation Menu ==== -->
                <div class="menu-links navbar-collapse collapse justify-content-start" id="menuDropdown">
                    <div class="menu-logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('assets/images/logo-icons/discover time12-croped.png') }}" alt=""></a>
                    </div>

                    <ul class="nav navbar-nav">
                        @if (!session()->has('user'))
                            <li class="active coll-btns">
                                <a href="{{ route('loginpage') }}">Log in</a>
                            </li>
                            <li class="active coll-btns coll-bottom">
                                <a href="{{ route('registerpage') }}">Sign up</a>
                            </li>
                        @endif
                        <!--  -->
                        @if (session()->has('user'))
                            @if (session()->get('user')->admin_role)
                            {{-- administratr --}}
                            <li class="custom-menu-button-mobile">
                                <a href="javascript:;">Dashboard<i class="fa fa-chevron-down"></i></a>
                                <ul class="sub-menu">
                                    <li class="custom-avatar-wrraper" style="display: flex;">
                                        <img src="{{ asset('assets/images/profile/' . session()->get('user')->photo) }}" alt="">
                                        <span class="custom-details">
                                            <div class="custom-heading">{{session()->get('user')->username  }}</div>
                                            <div class="custom-text">{{session()->get('user')->email  }}</div>
                                        </span>
                                    </li>
                                    <li><a href="{{ route("ad_dashboard") }}">Dashboard</a></li>
                                    <li><a href="{{ route('ad_lectures.index') }}">Lectures</a></li>
                                    <li><a href="{{ route('logout') }}">Log out</a></li>
                                </ul>
                            </li>
                            @else
                            {{-- default user --}}
                            <li class="custom-menu-button-mobile">
                                <a href="javascript:;">Profile <i class="fa fa-chevron-down"></i></a>
                                <ul class="sub-menu">
                                    <li class="custom-avatar-wrraper" style="display: flex;">
                                        <img src="{{ asset('assets/images/profile/' . session()->get('user')->photo) }}" alt="">
                                        <span class="custom-details">
                                            <div class="custom-heading">{{session()->get('user')->username  }}</div>
                                            <div class="custom-text">{{session()->get('user')->email  }}</div>
                                        </span>
                                    </li>
                                    <li><a href="{{ route('u_dashboard') }}">Dashboard</a></li>
                                    <li><a href="{{ route("u_notifications") }}">Notifications</a></li>
                                    <li><a href="{{ route('u_calendar') }}">Calendar events</a></li>
                                    <li><a href="{{ route('u_lectures') }}">My Lectures</a></li>
                                    <li><a href="{{ route('logout') }}">Log out</a></li>
                                </ul>
                            </li>
                            @endif
                        @endif
                        <!--  -->
                        <hr>
                        <li class="active">
                            <a href="{{ route('home') }}">Home </a>
                        </li>
                        <li><a href="javascript:;">Our Lectures <i class="fa fa-chevron-down"></i></a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('lectures') }}">Lectures</a></li>
                                <li><a href="{{ route('quizzes') }}">Quizzes</a></li>
                                <li><a href="{{ route('score_board') }}">Scoreboard</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('about') }}">About </a>
                        </li>
                        <li>
                            <a href="{{ route('contact_us') }}">Contact </a>
                        </li>
                        <li>
                            <a href="{{ route('membership') }}">Membership </a>
                        </li>
                        <li>
                            <a href="{{ route('faq') }}">FAQ </a>
                        </li>

                    </ul>
                    <div class="nav-social-link">
                        <a href="https://www.facebook.com"><i class="fa fa-facebook"></i></a>
                        <a href="https://www.google.com"><i class="fa fa-google-plus"></i></a>
                        <a href="https://www.linkedin.com/"><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
                <!-- Navigation Menu END ==== -->
            </div>
        </div>
    </div>
</header>
