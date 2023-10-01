<footer>
    <div class="footer-top">
        <div class="pt-exebar">
            <div class="container">
                <div class="d-flex align-items-stretch">
                    <div class="pt-logo mr-auto">
                        <a href="index.html">
                            <img src="{{ asset('assets/images/logo-icons/discover_time12-cropped-dark-removebg-preview.png')}}" alt="" />
                        </a>
                    </div>

                    <div class="pt-social-link">
                        <ul class="list-inline m-a0">
                            <li><a href="https://www.facebook.com" class="btn-link"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://www.twitter.com" class="btn-link"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://www.linkedin.com" class="btn-link"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="https://www.github.com" class="btn-link"><i class="fa fa-github"></i></a></li>
                        </ul>
                    </div>
                    <div class="pt-btn-join">
                        <a href="{{ route('registerpage') }}" class="ud-btn ud-btn-secondary footer-btn">Join Now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-7 col-sm-12">
                    <div class="row">
                        <div class="col-4 col-lg-4 col-md-4 col-sm-4">
                            <div class="widget footer_widget">
                                <h5 class="footer-title">Discover Time</h5>
                                <ul>
                                    <li><a href="{{ route("home") }}">Home</a></li>
                                    <li><a href="{{ route("lectures") }}">Lectures</a></li>
                                    <li><a href="{{ route("about") }}">About</a></li>
                                   
                                    <li><a href="{{ route("quizzes") }}">Quizzes</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-4 col-lg-4 col-md-4 col-sm-4">
                            <div class="widget footer_widget">
                                <h5 class="footer-title">Get In Touch</h5>
                                <ul>
                                    <li><a href="{{ route("contact_us") }}">Contact</a>
                                    </li>
                                    <li><a href="{{ route("membership") }}">Membership</a></li>
                                    <li><a href="{{ route("faq") }}">FAQ</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-4 col-lg-4 col-md-4 col-sm-4">
                            <div class="widget footer_widget">
                                <h5 class="footer-title">Terms</h5>
                                <ul>
                                    <li><a href="{{ route('private_policy') }}">Private Policy</a></li>
                                    <li><a href="{{ route('author') }}">Author</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
              
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                    <a href="#">© 2023 Discover Time, Inc.</a></div>
            </div>
        </div>
    </div>
</footer>