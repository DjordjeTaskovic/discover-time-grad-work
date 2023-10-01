@extends("layouts.layout")
@section("content")
  <!-- Content -->
  <div class="page-content bg-white">
  
    <!-- inner page banner END -->
    <div class="content-block">
        <!-- About Us -->
        <div class="section-area section-sp2">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 heading-bx text-center">
                        @if(session()->has('message'))
                            <div class="alert alert-warning">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        <h2 class="title-head text-uppercase m-b0">Set a plan, start learning and <br/> <span> unlock your potential</span></h2>
                    </div>
                </div>
                 <div class="pricingtable-row">
                    <div class="row">
                        @foreach ($subs as $s)
                            <div class="col-sm-12 col-md-4 col-lg-4 m-b40">
                                <div class="pricingtable-wrapper">
                                    <div class="pricingtable-inner">
                                        <div class="pricingtable-main"> 
                                            @if ($s->price != 0)
                                                <div class="pricingtable-price"> 
                                                   <span class="priceing-doller">$</span>
                                                   <span class="pricingtable-bx">{{ $s->price }}</span>
                                                   <span class="pricingtable-type">{{ $s->duration_in_months }} Month</span>
                                                </div>
                                                @else
                                                <div class="pricingtable-price"> 
                                                    <span class="priceing-doller">Already In use</span>
                                                 </div>
                                            @endif
                                            <div class="pricingtable-title">
                                                <h2>{{ $s->difficulty }}</h2>
                                                <p>{{ $s->title }}</p>
                                            </div>
                                        </div>
                                        <ul class="pricingtable-features">
                                            <li>  
                                                @php
                                                $search = array('.', ':');
                                                $replace = array('.<li /><li>', '');
                                                echo $featuresbraked = str_replace($search, $replace, $s->features);
                                                @endphp
                                             </li>
                                        </ul>
                                        @if ($s->difficulty != "Free")
                                        <div class="pricingtable-footer"> 
                                            <a href="{{ route("membership_checkout",['id'=>$s->ID]) }}"
                                                 class="ud-btn ud-btn-primary">Get It Now</a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                       
                    </div>
                </div>
            </div>
        </div>
        <!-- Our Services ==== -->
        <div class="section-area section-sp2 bg-fix ovbl-dark join-bx" style="">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center heading-bx text-white">
                        <h2 class="title-head m-b0">Why Choose <span>Us</span></h2>
                        <p class="m-b0">Here are the frequently asked questions (FAQs) and 
                            their answers about the membership subscriptions, including the free, medium, and advanced options</p>
                    </div>
                    <div class="col-md-6">	
                        <div class="why-chooses-bx ">
                            <div class="ttr-accordion m-b30 faq-bx" id="accordion1">
                                <div class="panel">
                                    <div class="acod-head">
                                        <h6 class="acod-title"> 
                                            <a data-toggle="collapse" href="#faq1" class="collapsed" data-parent="#faq1">
                                                What are the available membership subscription levels on site? </a> </h6>
                                    </div>
                                    <div id="faq1" class="acod-body collapse ">
                                        <div class="acod-content">We offer three subscription options: Free, Medium, and Advanced. Each subscription level comes with distinct benefits tailored to suit different preferences and commitment levels.</div>
                                    </div>
                                </div>
                                <div class="panel">
                                    <div class="acod-head">
                                        <h6 class="acod-title"> 
                                            <a data-toggle="collapse" href="#faq2" class="collapsed" data-parent="#faq2">
                                                What does the Free membership subscription include</a> </h6>
                                    </div>
                                    <div id="faq2" class="acod-body collapse">
                                        <div class="acod-content">The Free membership provides access to a selection of introductory historical lectures and limited content. While it offers a glimpse into our offerings, the Free subscription does not include access to premium content, live Q&A sessions, or exclusive member discussions.</div>
                                    </div>
                                </div>
                                <div class="panel">
                                    <div class="acod-head">
                                        <h6 class="acod-title"> 
                                            <a data-toggle="collapse"  href="#faq3" class="collapsed"  data-parent="#faq3">
                                                What features are included in the Medium membership subscription? </a> </h6>
                                    </div>
                                    <div id="faq3" class="acod-body collapse">
                                        <div class="acod-content">The Medium membership offers an enhanced experience with access to a broader range of historical lectures. It includes live Q&A sessions with historians and limited access to exclusive member discussions. While it provides more comprehensive content, some advanced features are available only to Advanced subscribers.</div>
                                    </div>
                                </div>
                                <div class="panel">
                                    <div class="acod-head">
                                        <h6 class="acod-title"> 
                                            <a data-toggle="collapse"  href="#faq4" class="collapsed"  data-parent="#faq4">
                                                What benefits does the Advanced membership subscription offer? </a> </h6>
                                    </div>
                                    <div id="faq4" class="acod-body collapse">
                                        <div class="acod-content">The Advanced membership provides the most comprehensive experience on our platform. Subscribers enjoy unlimited access to all historical lectures, both past and present. Additionally, Advanced members have priority access to live Q&A sessions with experts and full participation in exclusive member discussions.</div>
                                    </div>
                                </div>
                                <div class="panel">
                                    <div class="acod-head">
                                        <h6 class="acod-title"> 
                                            <a data-toggle="collapse"  href="#faq5" class="collapsed"  data-parent="#faq5">
                                                Can I switch between membership levels at any time? </a> </h6>
                                    </div>
                                    <div id="faq5" class="acod-body collapse">
                                        <div class="acod-content">Yes, you can easily upgrade or downgrade your membership level based on your preferences. If you find that the benefits of a higher-tier membership align better with your interests, you can upgrade. Similarly, you can downgrade or cancel your membership at any time.</div>
                                    </div>
                                </div>
                                <div class="panel">
                                    <div class="acod-head">
                                        <h6 class="acod-title"> 
                                            <a data-toggle="collapse"  href="#faq6" class="collapsed"  data-parent="#faq6">
                                                Are there any limitations to the number of historical lectures I can access under each subscription level? </a> </h6>
                                    </div>
                                    <div id="faq6" class="acod-body collapse">
                                        <div class="acod-content">Yes, there are limitations based on the subscription level. Free members have access to a limited selection of introductory lectures, while Medium members enjoy a broader range of historical content. Advanced members, on the other hand, have unrestricted access to all lectures, including premium content.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">	
                        <div class="video-bx">
                            <img src="{{ asset('assets/images/other/image_4.jpg') }}" alt=""/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact area END ==== -->
</div>
<!-- Content END-->
@endsection