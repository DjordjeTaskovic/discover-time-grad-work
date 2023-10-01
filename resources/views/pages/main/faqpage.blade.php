@extends('layouts.layout')

@section('content')
  <!-- Content -->
  <div class="page-content bg-white">
    <!-- inner page banner -->
    <div class="page-banner ovbl-dark" style="background-image:url({{ asset('assets/images/banner/ban2.jpg') }});">
        <div class="container">
            <div class="page-banner-entry">
                <h1 class="text-white">Frequently Asked Questions</h1>
             </div>
        </div>
    </div>
    <!-- contact area -->
    <div class="content-block">
        <!-- Your Faq -->
        <!-- About Us -->
        <div class="section-area section-sp1 bg-gray">
            <div class="container">
                 <div class="row" style="text-align: center">
                            @php
                                $count = 1;
                            @endphp
                            @foreach ($categories as $c)
                                <div class="col -4 m-b30">
                                    <div class="feature-container">
                                        <div class="feature-md text-white m-b20">
                                            <a href="#" class="icon-cell">
                                                <img src="{{ asset('assets/images/icon/icon' . $count++ . '.png') }}"
                                                    alt=""></a>
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
        </div>
        <!-- Our Services -->
        <div class="section-area section-sp1">
            <div class="container">
                <div class="row">

                    <div class="col-lg-8 col-md-12">
                        <div class="heading-bx left">
                            <h2 class="m-b10 title-head"><span>Frequently asked questions</span></h2>
                        </div>
                        <p class="m-b10">Remember that historical lectures are just one avenue for learning about history. Supplementing your knowledge with books, documentaries, and museum visits can further enhance your understanding of historical figures, events, and artifacts.</p>
                        <div class="ttr-accordion m-b30 faq-bx" id="accordion1">
                            <div class="panel">
                                <div class="acod-head">
                                    <h6 class="acod-title"> 
                                        <a data-toggle="collapse" href="#a_faq1" class="collapsed" data-parent="#a_faq1">
                                            What are historical lectures?</a> </h6>
                                </div>
                                <div id="a_faq1" class="acod-body collapse">
                                    <div class="acod-content">Historical lectures are informative talks or presentations conducted by historians, experts, or educators to impart knowledge about historical figures, events, and artifacts. They aim to provide a deeper understanding of the past and its significance in shaping the present.</div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="acod-head">
                                    <h6 class="acod-title"> 
                                        <a data-toggle="collapse" href="#a_faq2" class="collapsed" data-parent="#a_faq2">
                                            Why should I attend historical lectures?</a> </h6>
                                </div>
                                <div id="a_faq2" class="acod-body collapse show">
                                    <div class="acod-content">Attending historical lectures can enrich your knowledge about the past and help you gain insights into the complexities of historical figures, events, and artifacts. They offer a structured and expert-led approach to learning, allowing you to better comprehend the context and impact of historical events.</div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="acod-head">
                                    <h6 class="acod-title"> 
                                        <a data-toggle="collapse"  href="#a_faq3" class="collapsed"  data-parent="#a_faq3">
                                            Are historical lectures only for academics and history enthusiasts?</a> </h6>
                                </div>
                                <div id="a_faq3" class="acod-body collapse">
                                    <div class="acod-content">No, historical lectures are open to everyone. While history enthusiasts and academics may find them particularly engaging, these lectures are designed to cater to a broader audience, including students, curious individuals, and lifelong learners.</div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="acod-head">
                                    <h6 class="acod-title"> 
                                        <a data-toggle="collapse"  href="#a_faq4" class="collapsed"  data-parent="#a_faq4">
                                            How long do historical lectures typically last?</a> </h6>
                                </div>
                                <div id="a_faq4" class="acod-body collapse">
                                    <div class="acod-content">The duration of historical lectures can vary widely, but they usually range from 45 minutes to 2 hours. Some lectures may be shorter, while others might be part of a series spanning several sessions.</div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="acod-head">
                                    <h6 class="acod-title"> 
                                        <a data-toggle="collapse"  href="#a_faq5" class="collapsed"  data-parent="#a_faq5">
                                            Do historical lectures cover specific time periods or a wide range of history?</a> </h6>
                                </div>
                                <div id="a_faq5" class="acod-body collapse">
                                    <div class="acod-content">Historical lectures can focus on specific eras, events, or individuals, as well as broader historical themes. Some lectures may delve deep into a particular historical period, while others might provide a general overview of multiple historical topics.</div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="acod-head">
                                    <h6 class="acod-title"> 
                                        <a data-toggle="collapse"  href="#a_faq6" class="collapsed"  data-parent="#a_faq6">
                                            Are historical lectures interactive?</a> </h6>
                                </div>
                                <div id="a_faq6" class="acod-body collapse">
                                    <div class="acod-content">The level of interactivity in historical lectures can differ. Some lectures may involve audience participation, Q&A sessions, or discussions, while others might be more formal presentations without active engagement.</div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    {{--  --}}
                    <div class="col-lg-4 col-md-12">
                        <div class="bg-primary text-white contact-info-bx">
                            <h2 class="m-b10 title-head">Contact <span>Information</span></h2>
                            <p>We are always ready to provide you with priceles support that you need.</p>
                            <div class="widget widget_getintuch">	
                                <ul>
                                    <li><i class="ti-location-pin"></i>75k Newcastle St. Ponte Vedra Beach, FL 309382 New York New York</li>
                                    <li><i class="ti-mobile"></i>0800-123456 (24/7 Support Line)</li>
                                    {{-- <li><i class="ti-email"></i>info@example.com</li> --}}
                                </ul>
                            </div>
                            <h5 class="m-t0 m-b20">Follow Us</h5>
                            <ul class="list-inline contact-social-bx">
                                <li><a href="#" class="btn outline radius-xl"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#" class="btn outline radius-xl"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" class="btn outline radius-xl"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#" class="btn outline radius-xl"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- Your Faq End -->
       
    </div>
    <!-- contact area END -->
</div>
<!-- Content END-->
@endsection