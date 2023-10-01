@extends('layouts.layout')
{{-- 
@section('title') Home @endsection
@section('description') The main page of the shop. @endsection
@section('keywords') shop, online, home, best, sellers @endsection --}}

@section('content')
    <div class="page-content bg-white m-t10">
      

        <div class="content-block">
              <!-- Main Slider -->
        <div class="section-area">
            <div class="container">
                <div class="hero-content">
                    <section id="hero1-carousel" class="splide" aria-label="Beautiful Images">
                        <div class="splide__track">
                            <ul class="splide__list">
                                <li class="splide__slide">
                                    <div class="item">
                                        {{--  --}}
                                        <div data-purpose="billboard"
                                         class="billboard-banner--billboard--Cgd8a billboard-banner--long-subtitle--3ewtR">
                                            <div class="billboard-banner--image-container--3lMr5">
                                                <img 
                                                alt="" 
                                                src="{{ asset('assets/images/banner/ban1.jpg') }}"
                                                 loading="eager">
                                            </div>

                                            <div class="billboard-banner--content-box--3fy3A">
                                                <h1 class="ud-heading-serif-xxl billboard-banner--short-title--3xqo8"
                                                    data-purpose="billboard-title">Improving lives through learning
                                                </h1>
                                                <p class="ud-text-md" data-purpose="billboard-subtitle">
                                                    Whether you want to learn or to share what you know,
                                                    you’ve come to the right place.</p>
            
                                            </div>
                                        </div>
                                        {{--  --}}
                                    </div> 
                                </li>
                                <li class="splide__slide">
                                    <!-- Item 1 -->
                                    <div class="item">
                                        {{--  --}}
                                        <div data-purpose="billboard"
                                            class="billboard-banner--billboard--Cgd8a billboard-banner--long-subtitle--3ewtR">
                                            <div class="billboard-banner--image-container--3lMr5"><img alt=""
                                                    src="{{ asset('assets/images/banner/ban2.jpg') }}" loading="eager" width="1340"
                                                    height="400"></div>
                                            <div class="billboard-banner--content-box--3fy3A">
                                                <h1 class="ud-heading-serif-xxl billboard-banner--short-title--3xqo8"
                                                    data-purpose="billboard-title">Keep moving up</h1>
                                                <p class="ud-text-md" data-purpose="billboard-subtitle">
                                                    As a global destination for
                                                    online learning,
                                                    we empower organizations and individuals with flexible and effective skill
                                                    development. </p>
            
                                            </div>
                                        </div>
                                        {{--  --}}
                                    </div>
                                </li>
                                <li class="splide__slide">
                                    <!-- Item 1 -->
                                    <div class="item">
                                        {{--  --}}
                                        <div data-purpose="billboard"
                                            class="billboard-banner--billboard--Cgd8a billboard-banner--long-subtitle--3ewtR">
                                            <div class="billboard-banner--image-container--3lMr5"><img alt=""
                                                    src="{{ asset('assets/images/banner/ban3.jpg') }}" loading="eager" width="1340"
                                                    height="400"></div>
                                            <div class="billboard-banner--content-box--3fy3A">
                                                <h1 class="ud-heading-serif-xxl billboard-banner--short-title--3xqo8"
                                                    data-purpose="billboard-title"> Enriching Your Understanding of the Past</h1>
                                                <p class="ud-text-md" data-purpose="billboard-subtitle">Our platform is dedicated to historical lectures,
                                                     where we delve into the captivating world of historical figures, events, and artifacts.</p>
            
                                            </div>
                                        </div>
                                        {{--  --}}
                                    </div>
                                </li>
                                <li class="splide__slide">
                                    <!-- Item 1 -->
                                    <div class="item">
                                        {{--  --}}
                                        <div data-purpose="billboard"
                                            class="billboard-banner--billboard--Cgd8a billboard-banner--long-subtitle--3ewtR">
                                            <div class="billboard-banner--image-container--3lMr5"><img alt=""
                                                    src="{{ asset('assets/images/banner/ban4.jpg') }}" loading="eager" width="1340"
                                                    height="400"></div>
                                            <div class="billboard-banner--content-box--3fy3A">
                                                <h1 class="ud-heading-serif-xxl billboard-banner--short-title--3xqo8"
                                                    data-purpose="billboard-title">Quality and Reliability</h1>
                                                <p class="ud-text-md" data-purpose="billboard-subtitle">We value the significance of accurate historical information.
                                                     Rest assured that the knowledge you gain from our lectures is founded on reliable sources and well-documented research.</p>
            
                                            </div>
                                        </div>
                                        {{--  --}}
                                    </div>
                                </li>

                               
                            </ul>
                        </div>
                      
                    </section>

                </div>

            </div>
        </div>
        <!-- Main Slider -->
            <!-- Popular Courses -->
            <div class="section-area section-sp5 popular-courses-bx ">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 heading-bx left">
                            <h2 class="title-head">A broad selection of lectures</h2>
                            <h4> Choose from over <span class="counter">{{ $lecture_count }}</span> online lectures with new
                                additions published every month</h4>
                        </div>
                    </div>
                    <div class="">
                        <div class="btns m-b20">
                            <div class="ud-btn ud-btn-secondary btnJump1">World History</div>
                            <div class="ud-btn ud-btn-secondary btnJump2">Western History</div>
                            <div class="ud-btn ud-btn-secondary btnJump3">Eastern History</div>

                        </div>
                        <div class="owl-carousel" id="myCarousel">
                            <div class="item world_history">
                                {{--  --}}
                                <section id="main-carousel" class="splide" aria-label="Beautiful Images">
                                    <div class="splide__track">
                                        <ul class="splide__list">
                                            @foreach ($Wdata as $d)
                                            <li class="splide__slide">
                                                <div class="item">
                                                    <div class="splide-bx">
                                                        <div class="splide-image-wrraper">
                                                            <img src="{{ asset('assets/images/historical_data/' . $d->cover_image) }}"
                                                                alt="">
                                                            <a href="{{ route('lecture_details', ['ID' => $d->LectureID]) }}"
                                                                 class="ud-btn ud-btn-primary splide-btn">Read More</a>
                                                        </div>
                                                        <div class="splide-info">
                                                            <h3 class="splide-title">
                                                                <a href="{{ route('lecture_details', ['ID' => $d->LectureID]) }}">
                                                                    {{ $d->LectureName }}
                                                                
                                                                </a></h3>
                                                            
                                                            <div class="splide-rating">
                                                                <span>
                                                                    <b>{{ $d->average_review }}</b>
                                                                    <ul class="cours-star splide-star">
                                                                        @for ($i = 1; $i <= $d->average_review; $i++)
                                                                            <li class="active"><i class="fa fa-star"></i></li>
                                                                        @endfor
                                                                        @for ($i = 1; $i <= 5 - $d->average_review; $i++)
                                                                            <li><i class="fa fa-star"></i></li>
                                                                        @endfor
                                                                    </ul>
                                                                    <p>({{ $d->revs_count }} reviews)</p>
                                                                </span>
                                                            </div>
                                                            <div class="splide-badges">
                                                                @foreach ($d->tags as $t)
                                                                <span>{{ $t->name }}</span>
                                                                @endforeach
                                                            </div>
                                                            <div class="splide-pricing">
                                                                <span>{{ $d->difficulty }}</span>
                                                                <span>${{ $d->price }}</span>
                                                            </div>
                                                            
                                                        </div>
                                                        <hr>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                  
                                </section>
                                {{--  --}}
                            </div>
                            <div class="item eastern_history">
                                <section id="main2-carousel" class="splide" aria-label="Beautiful Images">
                                    <div class="splide__track">
                                        <ul class="splide__list">
                                            @foreach ($Wstdata as $d)
                                            <li class="splide__slide">
                                                <div class="item">
                                                    <div class="splide-bx">
                                                        <div class="splide-image-wrraper">
                                                            <img src="{{ asset('assets/images/historical_data/' . $d->cover_image) }}"
                                                                alt="">
                                                            <a href="{{ route('lecture_details', ['ID' => $d->LectureID]) }}"
                                                                 class="ud-btn ud-btn-primary splide-btn">Read More</a>
                                                        </div>
                                                        <div class="splide-info">
                                                            <h3 class="splide-title">
                                                                <a href="{{ route('lecture_details', ['ID' => $d->LectureID]) }}">
                                                                    {{ $d->LectureName }}</a></h3>
                                                            
                                                            <div class="splide-rating">
                                                                <span>
                                                                    <b>{{ $d->average_review }}</b>
                                                                    <ul class="cours-star splide-star">
                                                                        @for ($i = 1; $i <= $d->average_review; $i++)
                                                                            <li class="active"><i class="fa fa-star"></i></li>
                                                                        @endfor
                                                                        @for ($i = 1; $i <= 5 - $d->average_review; $i++)
                                                                            <li><i class="fa fa-star"></i></li>
                                                                        @endfor
                                                                    </ul>
                                                                    <p>({{ $d->revs_count }} reviews)</p>
                                                                </span>
                                                            </div>
                                                            <div class="splide-badges">
                                                                @foreach ($d->tags as $t)
                                                                <span>{{ $t->name }}</span>
                                                                @endforeach
                                                            </div>
                                                            <div class="splide-pricing">
                                                                <span>{{ $d->difficulty }}</span>
                                                                <span>${{ $d->price }}</span>
                                                            </div>
                                                            
                                                        </div>
                                                        <hr>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </section>
                            </div>
                            <div class="item western_history">
                                <section id="main3-carousel" class="splide" aria-label="Beautiful Images">
                                    <div class="splide__track">
                                        <ul class="splide__list">
                                            @foreach ($Estdata as $d)
                                            <li class="splide__slide">
                                                <div class="item">
                                                    <div class="splide-bx">
                                                        <div class="splide-image-wrraper">
                                                            <img src="{{ asset('assets/images/historical_data/' . $d->cover_image) }}"
                                                                alt="">
                                                            <a href="{{ route('lecture_details', ['ID' => $d->LectureID]) }}"
                                                                 class="ud-btn ud-btn-primary splide-btn">Read More</a>
                                                        </div>
                                                        <div class="splide-info">
                                                            <h3 class="splide-title">
                                                                <a href="{{ route('lecture_details', ['ID' => $d->LectureID]) }}">
                                                                    {{ $d->LectureName }}</a></h3>
                                                            
                                                            <div class="splide-rating">
                                                                <span>
                                                                    <b>{{ $d->average_review }}</b>
                                                                    <ul class="cours-star splide-star">
                                                                        @for ($i = 1; $i <= $d->average_review; $i++)
                                                                            <li class="active"><i class="fa fa-star"></i></li>
                                                                        @endfor
                                                                        @for ($i = 1; $i <= 5 - $d->average_review; $i++)
                                                                            <li><i class="fa fa-star"></i></li>
                                                                        @endfor
                                                                    </ul>
                                                                    <p>({{ $d->revs_count }} reviews)</p>
                                                                </span>
                                                            </div>
                                                            <div class="splide-badges">
                                                                @foreach ($d->tags as $t)
                                                                <span>{{ $t->name }}</span>
                                                                @endforeach
                                                            </div>
                                                            <div class="splide-pricing">
                                                                <span>{{ $d->difficulty }}</span>
                                                                <span>${{ $d->price }}</span>
                                                            </div>
                                                            
                                                        </div>
                                                        <hr>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                  
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Popular Courses END -->
            <!-- Testimonials ==== -->
            <div class="section-area section-sp2" style="background: #f7f9fa;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 heading-bx left">
                            <h4 class="title-head">How learners like you are achieving their goals</h4>
                        </div>
                    </div>
                        <section id="test1-carousel" class="splide" aria-label="Beautiful Images">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    @foreach ($test as $t)
                                    <li class="splide__slide">
                                        <div class="item">
                                            <div class="testimonial-bx text-bx">
                                                <div class="text-card">
                                                    <div class="testimonial-content">
                                                        <p>{{ $t->text }}</p>
                                                    </div>
                                                    <div class="testimonial-info" style="display: flex">
                                                        <span>
                                                            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                                        </span>
                                                        <h5 class="name" style="margin-left: 10px">{{ $t->username }}</h5>
                                                    </div>
                                                    
                                                    <span><a
                                                            href="{{ route('lecture_details', ['ID' => $t->LectureID]) }}">{{ $t->name }}</a>
                                                        <i class="fa fa-angle-right"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </section>
                </div>
            </div>
            <!-- Testimonials END ==== -->

            <!-- Recent News -->
            <div class="section-area section-sp2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 heading-bx left">
                            <h4 class="title-head">Most visited lectures</h4>
                        </div>
                    </div>
                    <section id="top-rated-carousel" class="splide" aria-label="Beautiful Images">
                        <div class="splide__track">
                            <ul class="splide__list">
                                @foreach ($rated_data as $r)
                                    <li class="splide__slide">
                                        <div class="item">
                                            <div class="splide-bx">
                                                <div class="splide-image-wrraper">
                                                    <img src="{{ asset('assets/images/historical_data/' . $r->cover_image) }}"
                                                        alt="image">
                                                    <a href="{{ route('lecture_details', ['ID' => $r->LectureID]) }}"
                                                        class="ud-btn ud-btn-primary splide-btn">Read More</a>
                                                </div>
                                                <div class="splide-info">
                                                    <h3 class="splide-title"><a href="#">{{ $r->LectureName }}</a>
                                                    </h3>
                                                    <div class="splide-badges">
                                                        <p>{{ \Illuminate\Support\Str::limit($r->lecture_description, 100, $end = '...') }}
                                                        </p>
                                                    </div>
                                                    <div class="splide-rating">
                                                        <span>
                                                            <b>{{ $r->average_review }}</b>
                                                            <ul class="cours-star splide-star">
                                                                @for ($i = 1; $i <= $r->average_review; $i++)
                                                                    <li class="active"><i class="fa fa-star"></i></li>
                                                                @endfor
                                                                @for ($i = 1; $i <= 5 - $r->average_review; $i++)
                                                                    <li><i class="fa fa-star"></i></li>
                                                                @endfor
                                                            </ul>
                                                            <p>({{ $r->revs_count }} reviews)</p>
                                                        </span>
                                                    </div>
                                                    <div class="splide-pricing">
                                                        <span>${{ $r->price }}</span>
                                                    </div>

                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </section>
                </div>
            </div>
            <!-- Recent News End -->
            <div class="section-area section-sp1" style="background: #f7f9fa;">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row">
                                @php
                                    $count = 1;
                                @endphp
                                @foreach ($categories as $c)
                                    <div class="col-lg-6 col-md-6 col-sm-6 m-b30">
                                        <div class="feature-container">
                                            <div class="feature-md text-white m-b20">
                                                <a href="#" class="icon-cell">
                                                    <img src="{{ asset('assets/images/icon/icon' . $count++ . '.png') }}"
                                                        alt="">
                                                    </a>
                                            </div>
                                            <div class="icon-content">
                                                <h5 class="ttr-tilte">{{ $c->name }}</h5>
                                                <p>{{ \Illuminate\Support\Str::limit($c->description, 100, $end = '...') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-6 m-b30">
                            <h2 class="title-head ">Learn a new skill online<br> <span class="text-primary"> on your
                                    time</span></h2>
                            <h4><span class="counter">{{ $lecture_count }}</span> Online Lectures</h4>
                            <p>We help organizations of all types and sizes prepare for the path ahead — wherever it leads.
                                Our curated collection of business and technical courses help companies, governments, and
                                nonprofits go further by placing learning at the center of their strategies.</p>
                            <a href="{{ route('lectures') }}" class="ud-btn ud-btn-primary">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Our Story ==== -->
            <div class="section-area section-sp1 our-story">
                <div class="container">
                    <div class="row align-items-center d-flex">
                        <div class="col-lg-5 col-md-12 heading-bx">
                            <h2 class="m-b10">Improving lives through learning </h2>
                            <p>Whether you want to learn or to share what you know, you’ve come to the right place. As a
                                global destination for online learning, we empower organizations and individuals with
                                flexible and effective skill development. </p>
                            <a href="{{ route('about') }}" class="ud-btn ud-btn-primary">Read More</a>
                        </div>
                        <div class="col-lg-7 col-md-12 heading-bx p-lr">
                            <div class="video-bx">
                                <img src="{{ asset('assets/images/other/image_8.jpg') }}" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Our Story END ==== -->
        </div>
        <!-- contact area END -->
        {{-- splide test --}}
        {{-- <div class="section-area section-sp1 our-story">
            <div class="container">
                <section id="basic-carousel" class="splide" aria-label="Beautiful Images">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <li class="splide__slide">
                                <div class="item">
                                    <div class="splide-bx">
                                        <div class="splide-image-wrraper">
                                            <img src="{{ asset('assets/images/historical_data/William_Shakespeare.jpg') }}"
                                                alt="">
                                            <a href="http://127.0.0.1:8000/lecture_details/3" class="btn">Read More</a>
                                        </div>
                                        <div class="splide-info">
                                            <h3 class="splide-title"><a href="#">The complete 2023 web developer
                                                    bootcamp</a></h3>
                                            <div class="splide-rating">
                                                <span>
                                                    <b>4.7</b>
                                                    <ul class="cours-star splide-star">
                                                        <li class="active"><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                    </ul>
                                                    <p>(321423)</p>
                                                </span>
                                            </div>
                                            <div class="splide-pricing">
                                                <span>$19.99</span>
                                            </div>
                                            <div class="splide-badges">
                                                <span>tags</span>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                  
                </section>
            </div>
        </div> --}}

        <script src="{{ asset('splide-4.1.3/dist/js/splide.min.js') }}"></script>
        <script>
            var splide = new Splide('#top-rated-carousel', {
                perPage: 4,
                rewind: true,
                gap: '1rem',
                breakpoints: {
                    0: {
                        perPage: 1
                    },
                    720: {
                        perPage: 1
                    },
                    1024: {
                        perPage: 2
                    },
                    1200: {
                        perPage: 3
                    }
                }
            });
            splide.mount();
            //
            var splide = new Splide('#main-carousel', {
                perPage: 4,
                rewind: true,
                gap: '1rem',
                breakpoints: {
                    0: {
                        perPage: 1
                    },
                    720: {
                        perPage: 1
                    },
                    1024: {
                        perPage: 2
                    },
                    1200: {
                        perPage: 3
                    }
                }

            });
            splide.mount();
            var splide = new Splide('#main2-carousel', {
                perPage: 4,
                rewind: true,
                gap: '1rem',
                breakpoints: {
                    0: {
                        perPage: 1
                    },
                    720: {
                        perPage: 1
                    },
                    1024: {
                        perPage: 2
                    },
                    1200: {
                        perPage: 3
                    }
                }

            });
            splide.mount();
            var splide = new Splide('#main3-carousel', {
                perPage: 4,
                rewind: true,
                gap: '1rem',
                breakpoints: {
                    0: {
                        perPage: 1
                    },
                    720: {
                        perPage: 1
                    },
                    1024: {
                        perPage: 2
                    },
                    1200: {
                        perPage: 3
                    }
                }

            });
            splide.mount();
            var splide = new Splide('#hero1-carousel', {
                perPage: 1,
                rewind: true,
                type   : 'loop',
                autoplay: true, 
            });
            splide.mount();
            var splide = new Splide('#test1-carousel', {
                perPage: 3,
                rewind: true,
                gap: '1rem',
                breakpoints: {
                    0: {
                        perPage: 1
                    },
                    720: {
                        perPage: 1
                    },
                    1024: {
                        perPage: 2
                    },
                    1200: {
                        perPage: 3
                    }
                }

            });
            splide.mount();
        </script>
    </div>
    <!-- Content END-->
@endsection
