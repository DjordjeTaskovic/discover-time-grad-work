
<!-- Left sidebar menu start -->
<div class="ttr-sidebar">
    <div class="ttr-sidebar-wrapper content-scroll">
        <!-- side menu logo start -->
        <div class="ttr-sidebar-logo">
            <a href="#"><img alt="" src="{{asset ("assets/images/logo-icons/discover time12-croped.png") }}" width="122" height="27"></a>
            
            <div class="ttr-sidebar-toggle-button">
                <i class="ti-arrow-left"></i>
            </div>
        </div>
        <!-- side menu logo end -->
        <!-- sidebar menu start -->
        <nav class="ttr-sidebar-navi">
            <ul>
                {{-- Admin links --}}
                @if(session()->get("user")->admin_role)
                            <li>
                                <a href="{{ route("ad_dashboard") }}" class="ttr-material-button">
                                    <span class="ttr-icon"><i class="ti-home"></i></span>
                                    <span class="ttr-label">Dashborad</span>
                                </a>
                            </li>
                            
                        <li>
                            <a href="{{ URL::to('ad_lectures') }}" class="ttr-material-button">
                                <span class="ttr-icon"><i class="ti-book"></i></span>
                                <span class="ttr-label">Site Lectures</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ URL::to('ad_his_data') }}" class="ttr-material-button">
                                <span class="ttr-icon"><i class="ti-book"></i></span>
                                <span class="ttr-label">Historical Data</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="ttr-material-button">
                                <span class="ttr-icon"><i class="ti-email"></i></span>
                                <span class="ttr-label">Mailbox</span>
                                <span class="ttr-arrow-icon"><i class="fa fa-angle-down"></i></span>
                            </a>
                            <ul>
                                <li>
                                    <a href="{{ route("ad_mailbox")}}" class="ttr-material-button"><span class="ttr-label">MailBox</span></a>
                                </li>
                                <li>
                                    <a href="{{ route("ad_mailbox_arch") }}" class="ttr-material-button"><span class="ttr-label">Archive</span></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route("ad_reviews") }}" class="ttr-material-button">
                                <span class="ttr-icon"><i class="ti-comments"></i></span>
                                <span class="ttr-label">Site Reviews</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="ttr-material-button">
                                <span class="ttr-icon"><i class="ti-email"></i></span>
                                <span class="ttr-label">Adding Data</span>
                                <span class="ttr-arrow-icon"><i class="fa fa-angle-down"></i></span>
                            </a>
                            <ul>
                                <li>
                                    <a href="{{ route("ad_his_data.create")}}" class="ttr-material-button"><span class="ttr-label">Add Historical Data</span></a>
                                </li>
                                <li>
                                    <a href="{{ route("ad_lectures.create")}}" class="ttr-material-button"><span class="ttr-label">Add Lecture</span></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route("ad_user",['userID'=> session()->get("user")->ID]) }}" class="ttr-material-button">
                                <span class="ttr-icon"><i class="ti-book"></i></span>
                                <span class="ttr-label">Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route("log_file_msg") }}" class="ttr-material-button">
                                <span class="ttr-icon"><i class="ti-book"></i></span>
                                <span class="ttr-label">Log File Messages</span>
                            </a>
                        </li>
                        <li class="ttr-seperate"></li>
                @endif
                {{--  --}}
                {{--  --}}
                {{-- default User Links links --}}
                @if(!session()->get("user")->admin_role)

                <li>
                    <a href="{{ route('u_dashboard') }}" class="ttr-material-button">
                        <span class="ttr-icon"><i class="ti-book"></i></span>
                        <span class="ttr-label">Profile</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="ttr-material-button">
                        <span class="ttr-icon"><i class="ti-calendar"></i></span>
                        <span class="ttr-label">My Lectures</span>
                        <span class="ttr-arrow-icon"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route("u_lectures") }}" class="ttr-material-button"><span class="ttr-label">Lectures</span></a>
                        </li>
                        <li>
                            <a href="{{ route("u_lecture_favorites") }}" class="ttr-material-button"><span class="ttr-label">Favorite</span></a>
                        </li>
                        <li>
                            <a href="{{ route("u_lecture_archived") }}" class="ttr-material-button"><span class="ttr-label">Archived</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="ttr-material-button">
                        <span class="ttr-icon"><i class="ti-calendar"></i></span>
                        <span class="ttr-label">Calendar</span>
                        <span class="ttr-arrow-icon"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route("u_calendar") }}" class="ttr-material-button"><span class="ttr-label">Calendar</span></a>
                        </li>
                        <li>
                            <a href="{{ route("u_calendar_event_form") }}" class="ttr-material-button"><span class="ttr-label">Add Event</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route("u_reviews") }}" class="ttr-material-button">
                        <span class="ttr-icon"><i class="ti-comments"></i></span>
                        <span class="ttr-label">Reviews</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route("u_membership") }}" class="ttr-material-button">
                        <span class="ttr-icon"><i class="ti-comments"></i></span>
                        <span class="ttr-label">My Membership plan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route("u_notifications") }}" class="ttr-material-button">
                        <span class="ttr-icon"><i class="ti-book"></i></span>
                        <span class="ttr-label">Notifications</span>
                    </a>
                </li>
                <li class="ttr-seperate"></li>
                @endif
            </ul>
            <!-- sidebar menu end -->
        </nav>
        <!-- sidebar menu end -->
    </div>
</div>
<!-- Left sidebar menu end -->