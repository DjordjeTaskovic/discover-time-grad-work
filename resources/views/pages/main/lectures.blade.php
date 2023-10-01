@extends("layouts.layout")

@section("content")
 <!-- Content -->
 <div class="page-content bg-white">
    
    <div class="page-banner ovbl-dark" style="background-image:url({{ asset('assets/images/banner/ban2.jpg') }});">
        <div class="container">
            <div class="page-banner-entry">
                <h1 class="text-white">Lectures</h1>
             </div>
        </div>
    </div>
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
       
        <!-- About Us -->
        <div class="section-area section-sp1">
            <div class="section-container">
                
                <div class="row" style="display:flex;justify-content:center;">
                    <!-- Left part start -->
                    <div class="col-lg-3">
                        <form action="" id="Lectures_Form">
                            @csrf
                            <button type="reset" class="ud-btn ud-btn-primary" onClick="window.location.reload()">Clear filter</button>
                            <span class="lecture_count">( {{ $lecture_count }} ) total results</span>
                            <hr>
                        
                        <aside class="side-bar sticky-top">
                            <div class="widget">
                                <h6 class="widget-title">Search</h6>
                                <div class="search-bx style-1">
                                        <div class="input-group">
                                            <input name="text" class="form-control" placeholder="Enter your keywords..." type="text" id="search">
                                            <span class="input-group-btn">
                                                <button type="submit" class="fa fa-search text-primary" id="search_btn"></button>
                                            </span> 
                                        </div>
                                </div>
                            </div>
                            <div class="widget">
                                <div class="ttr-accordion m-b30 faq-bx" id="accordion1">
                                    <div class="panel">
                                        <div class="acod-head">
                                            <h6 class="acod-title"> 
                                                <a data-toggle="collapse" href="#faq1" class="collapsed" data-parent="#faq1" aria-expanded="false">
                                                Ratings </a> </h6>
                                        </div>
                                        <div id="faq1" class="acod-body collapse show" style="">
                                            <div class="acod-content">
                                                <ul id="rating_radio">
                                                <li  style="display: flex;">
                                                    <input type="radio" name="rating" value="rating4" />
                                                    <ul class="cours-star">
                                                        <li class="active"><i class="fa fa-star"></i></li>
                                                        <li class="active"><i class="fa fa-star"></i></li>
                                                        <li class="active"><i class="fa fa-star"></i></li>
                                                        <li class="active"><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                    </ul>
                                                    <span> 4 star</span>
                                                    <span> ( {{ $count_4_ratings }} ) </span>
                                                </li>
                                                <li  style="display: flex;">
                                                    <input type="radio" name="rating" value="rating3"/>
                                                    <ul class="cours-star">
                                                        <li class="active"><i class="fa fa-star"></i></li>
                                                        <li class="active"><i class="fa fa-star"></i></li>
                                                        <li class="active"><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                    </ul>
                                                    <span> 3 star</span>
                                                    <span> ( {{ $count_3_ratings }} ) </span>
                                                </li>
                                                <li  style="display: flex;">
                                                    <input type="radio" name="rating" value="rating2"/>
                                                    <ul class="cours-star">
                                                        <li class="active"><i class="fa fa-star"></i></li>
                                                        <li class="active"><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                    </ul>
                                                    <span> 2 star</span>
                                                    <span> ( {{ $count_2_ratings }} ) </span>
                                                </li>
                                            </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel">
                                        <div class="acod-head">
                                            <h6 class="acod-title"> 
                                                <a data-toggle="collapse" href="#faq2" class="collapsed" data-parent="#faq2">
                                               Category</a> </h6>
                                        </div>
                                        <div id="faq2" class="acod-body collapse">
                                            <div class="acod-content">
                                                <ul>
                                                    @foreach ($categories as $c)
                                                    <li>
                                                        <input type="checkbox" name="category" value="{{ $c->ID }}"/>
                                                        <span> {{ $c->name }} </span>
                                                        <span> ({{ $c->lectures_count }}) </span>
                                                    </li>
                                                    @endforeach
                                                   
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel">
                                        <div class="acod-head">
                                            <h6 class="acod-title"> 
                                                <a data-toggle="collapse" href="#faq5" class="collapsed" data-parent="#faq5">
                                                Price </a> </h6>
                                        </div>
                                        <div id="faq5" class="acod-body collapse">
                                            <div class="acod-content">
                                                <ul>
                                                    @foreach ($prices as $c)
                                                    <li>
                                                        <input type="checkbox" name="price" value="{{ $c->ID }}"/>
                                                        <span> {{ $c->difficulty }} </span>
                                                        <span> {{ $c->price }} $</span>
                                                        <span> ({{ $c->lectures_count }}) </span>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget widget_tag_cloud">
                                <h6 class="widget-title">Skill Level</h6>
                                <div class="tagcloud"> 
                                    @foreach ($skills as $c)
                                        <a href="#" data-value="{{ $c->ID }}" class="option-btn">{{ $c->skill_name }}</a> 
                                    @endforeach
                                </div>
                            </div>
                        </aside>
                    </form>
                    </div>
                    <!-- Left part END -->
                    <!-- Side bar start -->
                    <div class="col-lg-7">
                         <!-- Pagination start -->
                        <div class="pagination-bx rounded-sm gray clearfix">
                            <ul class="pagination" id="pagination">
                            </ul>
                        </div>
                         <!-- Pagination END -->

                        <div id="container">
                            {{-- displaying lectures here from ajax_data.js file --}}
                        </div>
                        
                    </div>
                    <!-- Side bar END -->
                </div>
            </div>
        </div>
   
    <!-- contact area END -->
      <!-- Your Faq -->
      <div class="section-area section-sp1">
        <div class="section-container">
            <div class="row">
                <div class="col-lg-12">
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
              
            </div>
            
        </div>
    </div>
    <!-- Your Faq End -->
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
    </script>
</div>
<!-- Content END-->
@endsection