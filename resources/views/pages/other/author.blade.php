@extends('layouts.layout')

@section('content')
<!-- Content -->
<div class="page-content bg-white">
    <!-- inner page banner -->
    <div class="page-banner ovbl-dark" style="background-image:url({{ asset('assets/images/banner/ban2.jpg') }});">
        <div class="container">
            <div class="page-banner-entry">
                <h1 class="text-white">Site Author</h1>
             </div>
        </div>
    </div>
    <!-- Breadcrumb row -->
    <div class="breadcrumb-row">
        <div class="container">
            <ul class="list-inline">
                <li><a href="{{ route("home") }}">Home</a></li>
                <li>Site Author</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb row END -->
    <!-- inner page banner END -->
    <div class="content-block">
        <!-- About Us -->
        <div class="section-area section-sp1">
            <div class="container">
                 <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-12 m-b30">
                        <div class="profile-bx text-center">
                            <div class="user-profile-thumb">
                                <img src="{{ asset("assets/images/other/author.jpg") }}" alt="page author"/>
                            </div>
                            <div class="profile-info">
                                <h4>Djordje Taskovic</h4>
                                <span>djordje.taskovic123@gmail.com</span>
                            </div>
                            <div class="profile-social">
                                <ul class="list-inline m-a0">
                                    <li><a target="_blank" href="https://github.com/DjordjeTaskovic"><i class="fa fa-github"></i></a></li>
                                    <li><a target="_blank" href="https://www.linkedin.com/in/djordje-taskovic-322380204"><i class="fa fa-linkedin"></i></a></li>

                                </ul>
                            </div>
                            <div class="profile-tabnav">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#info"><i class="ti-bookmark-alt"></i>Information </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-12 m-b30">
                        <div class="profile-content-bx">
                            <div class="tab-content">
                                <div class="tab-pane active" id="info">
                                    <div class="profile-head">
                                        <h3>Information</h3>
                                    </div>
                                    <div class="courses-filter">
                                       <h5>Introduction</h5>
                                       <p>Hi my name is Djordje.
                                        I am a beginner when it comes to web design but keep my expectations
                                        high and i am looking forward to progress even further.</p>
                                        <h5>About</h5>
                                        <p>Young and passionate developer,
                                            always happy to learn new things
                                            and evolve.</p>
                                        <h5>Field of Interest</h5>
                                        <p> Intrested in 3D modeling, web design,
                                            photography, writing,
                                            drawing and learning new things.</p>
                                        <h5>Personal Activities</h5>
                                        <p>In free time I love
                                            reding a good book or comic,
                                            watch series and movies etc.</p>
                                     </div>
                                </div>
                               
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact area END -->
</div>
<!-- Content END-->

@endsection