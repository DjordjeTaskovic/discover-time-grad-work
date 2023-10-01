<!-- header start -->
<header class="ttr-header">
    <div class="ttr-header-wrapper">
        <!--sidebar menu toggler start -->
        <div class="ttr-toggle-sidebar ttr-material-button">
            <i class="ti-close ttr-open-icon"></i>
            <i class="ti-menu ttr-close-icon"></i>
        </div>
        <!--sidebar menu toggler end -->
        <!--logo start -->
        <div class="ttr-logo-box">
            <div>
                <a href="{{ route('home') }}" class="ttr-logo">
                    <img class="ttr-logo-mobile" alt="" src="{{asset("assets/images/logo-icons/icon3-modified.png") }}" width="30" height="30">
                    <img class="ttr-logo-desktop" alt="" src="{{asset ("assets/images/logo-icons/discover time12-croped.png") }}" width="160" height="27">
                </a>
            </div>
        </div>
        <!--logo end -->
        <div class="ttr-header-menu">
            <!-- header left menu start -->
            <ul class="ttr-header-navigation">
                <li class="ttr-header-nav-hover">
                    <a  href="{{ route('home') }}" class="ttr-material-button ttr-submenu-toggle">Home</a>
                </li>
                <li>
                    <a href="#" class="ttr-material-button ttr-submenu-toggle">Our Lectures<i class="fa fa-angle-down"></i></a>
                    <div class="ttr-header-submenu" style="display: block;">
                        <ul>
                            <li><a href="{{ route('lectures') }}">Lectures</a></li>
                            <li><a href="{{ route('quizzes') }}">Quizzes</a></li>
                            <li><a href="{{ route('score_board') }}">Scoreboard</a></li>
                        </ul>
                    </div>
                </li>
                <li class="ttr-header-nav-hover">
                    <a  href="{{ route("about") }}">About </a>
                </li>
                <li class="ttr-header-nav-hover">
                    <a  href="{{ route("contact_us") }}">Contact </a>
                </li>
                <li class="ttr-header-nav-hover">
                    <a  href="{{ route("membership") }}">Membership </a>
                </li>
                <li class="ttr-header-nav-hover">
                    <a  href="{{ route('faq') }}">FAQ </a>
                </li>
            </ul>
            <!-- header left menu end -->
        </div>
        <div class="ttr-header-right ttr-with-seperator m-r30">
            <!-- header right menu start -->
            <ul class="ttr-header-navigation">
                @if (!session()->get('user')->admin_role)
                {{--notification settings for default user --}}
                <li>
                    @php
                    //filters the notifications 
                        $elements = [];
                            foreach ($notifi_menu as $key => $value) {
                                 //calculating time- ago string
                                date_default_timezone_set('Europe/Belgrade');
                                $current_time = new DateTime();
                                $notification_time = DateTime::createFromFormat('Y-m-d H:i:s', $value->created_at);
                                $time_difference = $current_time->getTimestamp() - $notification_time->getTimestamp();
                                $seconds_ago = $time_difference;
                                if ($seconds_ago < 60) {
                                    $value->time_ago = "{$seconds_ago} seconds ago";
                                } elseif ($seconds_ago < 3600) {
                                    $minutes_ago = floor($seconds_ago / 60);
                                    $value->time_ago = "{$minutes_ago} minutes ago";
                                } elseif ($seconds_ago < 86400) {
                                    $hours_ago = floor($seconds_ago / 3600);
                                    $value->time_ago = "{$hours_ago} hours ago";
                                } else {
                                    $days_ago = floor($seconds_ago / 86400);
                                    $value->time_ago = "{$days_ago} days ago";
                                }
                                //for the current user
                                if($value->user_ID == session("user")->ID){
                                        array_push($elements, $value);
                                }
                            }
                        //var_dump($elements);
                    @endphp
                    <a href="#" class="ttr-material-button ttr-submenu-toggle ttr-header-nav-border">
                        <i class="fa fa-bell">
                            @if ( count($elements) != 0)
                                <span class="badge" style="background-color: rgb(68, 9, 104);color:aliceblue;">
                                    {{ count($elements) }}
                                </span>
                            @endif
                        </i>
                        </a>
                    {{-- ttr-notify-header dashboard --}}
                    <div class="ttr-header-submenu noti-menu">
                     
                        <div class="ttr-notify-header">
                            <span class="ttr-notify-text-top"> {{ count($elements) }} New</span>
                            <span class="ttr-notify-text">User Notifications</span>
                            <span class="notification-buttons" style="display: flex; justify-content:center; margin-top:1rem;">
                                    <a href="{{ route('u_notifications') }}" class="ud-btn ud-btn-primary">See all</a>
                            </span>
                        </div>
                        <div class="noti-box-list">
                                <ul>
                                    @foreach ($elements as $n)
                                    <li>
                                        <span class="notification-icon dashbg-main">
                                            <i class="fa fa-bullhorn"></i>
                                        </span>
                                        <span class="notification-text">
                                            <a href="{{ route('u_notifications') }}">
                                                {{ $n->title }}</a>   {{ Str::words($n->message, 5, '. . .') }}
                                        </span>
                                        <span class="notification-time">
                                            <form 
                                                action="{{ route('u_notification_mark_read') }}" 
                                                method="POST" 
                                                id="noti-form">
                                                <input type="hidden" name="noti_ID" value="{{ $n->ID }}"/>

                                                    <a href="#" class="fa fa-close noti-close"></a>
                                                <span> {{ $n->time_ago }}</span>
                                            </form>
                                        </span>
                                    </li>
                                    @endforeach
                                </ul>
                        </div>
                    </div>
                </li>
                @endif
                <li class="ttr-hide-on-mobile">
                    <a href="#" class="ttr-material-button">
                        <i class="ti-layout-grid3-alt"></i>
                    </a>
                    <div class="ttr-header-submenu ttr-extra-menu">
                        @if (session()->get('user')->admin_role)
                        <div class="das-menu-links-header">
                            <div class="custom-avatar-wrraper">
                                <img src="{{ asset('assets/images/profile/' . session()->get('user')->photo) }}"
                                    alt="">
                                <span class="custom-details">
                                    <div class="custom-heading">{{ session()->get('user')->username }}
                                    </div>
                                </span>
                            </div>
                        </div>
                            <a href="{{ route("ad_dashboard") }}"><i class="fa fa-book"></i> <span>Dashboard</span></a>
                            <a href="{{ route("ad_lectures.index") }}"><i class="fa fa-envelope"></i> <span>Site Lectures</span></a>
                            <a href="{{ route("logout") }}"><i class="fa fa-sign-out"></i><span>Log out</span></a>
                        @else
                            <div class="das-menu-links-header">
                                <div class="custom-avatar-wrraper">
                                    <img src="{{ asset('assets/images/profile/' . session()->get('user')->photo) }}"
                                        alt="">
                                    <span class="custom-details">
                                        <div class="custom-heading">{{ session()->get('user')->username }}
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <a href="{{ route("u_dashboard") }}"><i class="fa fa-book"></i> <span>Dashboard</span></a>
                            <a href="{{ route("u_notifications") }}"><i class="fa fa-bell"></i> <span>Notifications</span></a>
                            <a href="{{ route("u_calendar") }}"><i class="fa fa-calendar"></i> <span>Events</span></a>
                            <a href="{{ route("u_lectures") }}"><i class="fa fa-envelope"></i> <span>My Lectures</span></a>
                            <a href="{{ route("logout") }}"><i class="fa fa-sign-out"></i> <span>Log out</span></a>
                          
                        @endif
                    </div>
                </li>
            </ul>
            <!-- header right menu end -->
        </div>
        <!--header search panel start -->
       
        <!--header search panel end -->
    </div>
</header>
<!-- header end -->

