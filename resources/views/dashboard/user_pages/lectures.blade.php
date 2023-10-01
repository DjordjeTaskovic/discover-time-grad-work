@extends("dashboard.layouts.layout")


@section("dashboard.content")

<main class="ttr-wrapper">
	<div class="container-fluid">
		<div class="db-breadcrumb">
			<h4 class="breadcrumb-title">Lectures</h4>
			<ul class="db-breadcrumb-list">
				<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
				<li>Lectures</li>
			</ul>
		</div>	
        <div class="row">
                @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>

		<div class="row">
			<!-- Your Profile Views Chart -->
			<div class="col-lg-12 m-b30">
				<div class="widget-box">
					<div class="wc-title">
						<h4>My Lectures</h4>
                    </div>
                    <div class="widget-inner">
                        <div class="clearfix" id="tiles">
                            <div class="row" id="lectures" data-parent="#tiles">
                                @if (count($items) == 0)
                                    <div class="card-courses-list admin-courses">
                                        <span>Curently you haven't picked any lectures.</span>
                                    </div>
                                @else
                                    @foreach($items as $e)
                                    <div class="col-md-6 col-lg-4 col-sm-6 m-b30">
                                        <div class="dash-splide-bx">
                                            <div class="dash-splide-image-wrraper">
                                                <img src="{{ asset('assets/images/historical_data/'.$e->cover_image) }}" alt="cover_image"/>
                                                <div href="#" class="dash-splide-btn">
                                                    <a class="ud-btn ud-btn-primary" href="{{route('u_lecture', ["ID" => $e->ID])}}">
                                                        <i class="fa fa-clock-o"></i> Details</a>
                                                    <a class="ud-btn ud-btn-primary" href="{{route('u_lecture_favorite', ["id" => $e->ID,'parameter'=>'add_favorite'])}}">
                                                            <i class="fa fa-star"></i> Favorite</a>
                                                            <a class="ud-btn ud-btn-primary" href="{{route('u_lecture_archive', ["id" => $e->ID,'parameter'=>'add_archived'])}}">
                                                                <i class="fa fa-folder"></i> Archive</a>
                                                </div>
                                            </div>
                                            <div class="dash-splide-info">
                                                <h3 class="dash-splide-title"><a href="#">{{ $e->name }}</a>
                                                </h3>
                                                <div class="dash-splide-badges">
                                                    <span>{{ $e->duration }} min</span>
                                                    <span>{{ $e->skill_name }}</span>
                                                    <span>{{ $e->language }}</span>
                                                </div>
                                                <div class="dash-splide-rating" style="display:flex; justify-content:space-between;">
                                                    @if ($e->user_rev_check)
                                                        <a href="#" class="review-btn" data-value="{{ $e->ID }}">
                                                            <span style="display:flex; flex-direction:column;">
                                                                <ul class="cours-star dash-splide-star">
                                                                    <li><i class="fa fa-star"></i></li>
                                                                    <li><i class="fa fa-star"></i></li>
                                                                    <li><i class="fa fa-star"></i></li>
                                                                    <li><i class="fa fa-star"></i></li>
                                                                    <li><i class="fa fa-star"></i></li>
                                                                </ul>
                                                                <b style="font-size: 12px;margin: 0 1rem !important;">Leave a rating</b>
                                                            </span>
                                                        </a>
                                                    @endif
                                                    <span>
                                                        <p> 
                                                            @if ($e->is_finished == 1)
                                                            <span>FINISHED</span>
                                                            @else
                                                                <span>START LECTURE</span>
                                                            @endif
                                                         </p>
                                                    </span>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                            </div>

                        </div>
                       
					</div>
				</div>
                	{{-- review modal --}}
                    @foreach ($items as $ele)
                        <div class="nav-search-bar" id="review-bar" data-modal="{{ $ele->ID }}">
                            <form action="{{ route("leave_review") }}" method="POST">
                                @csrf
                                <input type="hidden" id="lecture_ID" name="lecture_ID" value="{{ $ele->ID }}" />
                                <h3>{{ $ele->lecture_name }}</h3>
                                <h3>Give us a feed back and a rating on what your experiance was for this lecture!</h3>
                                <div class="rate" name="rate[]">
                                    <input type="radio" id="star5" name="rate" value="5" />
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" />
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" />
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" />
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" />
                                    <label for="star1" title="text">1 star</label>
                                </div>
                            
                                <input name="text" value="" type="text" class="form-control" placeholder="Write here...">
                                
                                <button type="submit" class="ud-btn ud-btn-primary m-t20"
                                id="send">Send <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </button>
                            </form>
                            <span class="search-remove" data-value="{{ $ele->ID }}"><i class="ti-close"></i></span>
                        </div>
                        {{-- review modal --}}
                        
                    @endforeach
			</div>
			<!-- Your Profile Views Chart END-->
		</div>
	</div>
    
</main>
<script>
	$(window).on("load", function (e) {
        $(".review-btn").on("click", function(event){
            event.preventDefault();
          $('div[data-modal="' + $(this).data('value') + '"][id="review-bar"]').fadeIn(500).addClass('On');
        });
		$(".search-remove").on('click',function() {
            $('div[data-modal="' + $(this).data('value') + '"][id="review-bar"]').fadeOut(500).removeClass('On');
        });
	});
</script>
@endsection