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
			<!-- Your Profile Views Chart -->
			<div class="col-lg-12 m-b30">
				<div class="widget-box">
					<div class="wc-title">
						<h4>All Lectures</h4>
						<div class="pagination-bx rounded-sm gray clearfix">
							<ul class="pagination">
								{{$items->links('vendor.pagination.bootstrap-5')}}
							</ul>
						</div>
					</div>
					<div class="widget-inner">
						@foreach($items as $e)
						<div class="card-courses-list admin-courses">
							<div class="card-courses-media">
								<img src="assets/images/historical_data/{{ $e->cover_image }}" alt=""/>
							</div>
							<div class="card-courses-full-dec">
								<div class="card-courses-title">
									<h4>{{ $e->name }}</h4>
								</div>
								<div class="card-courses-list-bx">
									<ul class="card-courses-view">
										<li class="card-courses-categories">
											<h5>Duration</h5>
											<h4>{{ $e->duration }}</h4>
										</li>
										<li class="card-courses-categories">
											<h5>Skill Level</h5>
											<h4>{{ $e->skill_name }}</h4>
										</li>
										<li class="card-courses-categories">
											<h5>Language</h5>
											<h4>{{ $e->language }}</h4>
										</li>
										{{-- avrg review score (review tabela) --}}
										<li class="card-courses-review">
											<h5>{{ $e->average_review }} Stars</h5>
											<ul class="cours-star">
												@for ($i = 1; $i <= floor($e->average_review); $i++)
													<li class="active"><i class="fa fa-star"></i></li>
												@endfor
												@for ($i = 1; $i <= 5 -  floor($e->average_review); $i++)
													<li><i class="fa fa-star"></i></li>
												@endfor
												
											</ul>
										</li>
										{{-- details btn (his_data tabela za ovaj lecture) --}}
										<li class="card-courses-stats">
											<a href="{{route('ad_lectures.show', ["ad_lecture" => $e->ID])}}" 
												class="btn button-sm green radius-xl">
												Details
											</a>
										</li>
										{{-- membership (membership za ovaj lecture) --}}
										<li class="card-courses-price">
											<h5 class="text-primary">${{ $e->price }}</h5>
											<p>{{ $e->difficulty }}</p>
										</li>
									</ul>
								</div>
								<div class="row card-courses-dec">
									<div class="col-md-12">
										<h6 class="m-b10">Lecture's Description</h6>
										<p>{{ Str::words($e->lecture_description, 60, '. . .') }}</p>
									</div>
									{{-- update and delete for lectures --}}
									<div class="col-md-12" style="display: flex">
										<a href="{{ route("ad_lectures.edit",["ad_lecture"=>"$e->ID"]) }}" class="btn green radius-xl outline">Update</a>
										<form 
										class="del-btn" 
										method="POST" 
										action="{{route('ad_lectures.destroy',["ad_lecture" => $e->ID]) }}"
										>  
										@method('DELETE')
										@csrf
											<button
											 onclick="return confirm('Are you sure you want to delete item?')"
											class="btn red outline radius-xl"
											type="submit"> Remove </button>
										</form>
									</div>
								</div>
								
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
			<!-- Your Profile Views Chart END-->
		</div>
	</div>
	<div class="pagination-bx rounded-sm gray clearfix">
		<ul class="pagination">
			{{$items->links('vendor.pagination.bootstrap-5')}}
		</ul>
	</div>
</main>
@endsection