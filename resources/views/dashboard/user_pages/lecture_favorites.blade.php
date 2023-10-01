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
						<h4>My Favourite Lectures</h4>
                      
                        @if (count($favorites) != 0)
                            <div class="pagination-bx rounded-sm gray clearfix">
                                <ul class="pagination">
                                    {{$favorites->links('vendor.pagination.bootstrap-5')}}
                                </ul>
                            </div>
                            {{--  --}}
                        @endif
                    </div>
                    <div class="widget-inner">
                        
                        <div class="clearfix" id="tiles">
                            <div class="row" id="favorite" data-parent="#tiles">
                               
                                @if (count($favorites) == 0)
                                    <div class="card-courses-list admin-courses">
                                        <span>Curently, you dont have any favourite items.</span>
                                    </div>
                                @else
                                @foreach($favorites as $e)
                                     <div class="col-md-6 col-lg-4 col-sm-6 m-b30">
                                        <div class="dash-splide-bx">
                                            <div class="dash-splide-image-wrraper">
                                                <img src="{{ asset('assets/images/historical_data/'.$e->cover_image) }}" alt="cover_image"/>
                                                <div href="#" class="dash-splide-btn">
                                                    <a class="ud-btn ud-btn-primary" href="{{route('u_lecture', ["ID" => $e->ID])}}">
                                                        <i class="fa fa-clock-o"></i> Details</a>
                                                    <a class="ud-btn ud-btn-primary"
                                                     href="{{route('u_lecture_favorite', ["id" => $e->ID,'parameter'=>'un_favorite'])}}">
                                                        <i class="fa fa-star-o"></i> Unfavorite</a>
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
			</div>
			<!-- Your Profile Views Chart END-->
		</div>
	</div>
    @if (count($favorites) != 0)
        <div class="pagination-bx rounded-sm gray clearfix">
            <ul class="pagination">
                {{$favorites->links('vendor.pagination.bootstrap-5')}}
            </ul>
        </div>

    @endif
</main>

@endsection