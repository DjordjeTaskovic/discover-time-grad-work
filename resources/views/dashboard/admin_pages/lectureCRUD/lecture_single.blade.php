@extends("dashboard.layouts.layout")


@section("dashboard.content")

<main class="ttr-wrapper">
	<div class="container-fluid">
		<div class="db-breadcrumb">
			<h4 class="breadcrumb-title">Lectures</h4>
			<ul class="db-breadcrumb-list">
				<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
				<li>Lectures</li>
				<li>Single lecture</li>

			</ul>
		</div>	
		<div class="row">
			<!-- Your Profile Views Chart -->
			<div class="col-lg-12 m-b30">
				<div class="widget-box">
					<div class="wc-title">
						<h4>Lecture Data</h4>
						@if ($his_data->type_name == "artifact")
						<div class="widget-inner">
							<div class="card-courses-list admin-courses">
								<div class="card-courses-media">
									<img src="{{ asset('assets/images/historical_data/'.$his_data->cover_image) }}" alt=""/>
	
								</div>
								<div class="card-courses-full-dec">
									<div class="card-courses-title">
										<h4>{{ $his_data->lecture_name }}</h4>
									</div>
									<div class="card-courses-list-bx">
										<ul class="card-courses-view">
											<li class="card-courses-categories">
												<h5>Time Period</h5>
												<h4>{{ $his_data->period_time }}</h4>
												<h4>{{ $his_data->period_name }}</h4>
											</li>
											<li class="card-courses-categories">
												<h5>Material</h5>
												<h4>{{ $his_data->material }}</h4>
	
											</li>
										</ul>
									</div>
									<div class="row card-courses-dec">
										
										<div class="col-md-12">
											<h6 class="m-b10">Finding Place</h6>
											<p>{{ $his_data->finding_place }}</p>
										</div>
										<div class="col-md-12">
											<h6 class="m-b10">Collection</h6>
											<p>{{ $his_data->collection_num }}</p>
											<p>{{ $his_data->current_location }}</p>

										</div>
										<div class="col-md-12">
											<h6 class="m-b10">Description</h6>
											<p>{{ \Illuminate\Support\Str::limit($his_data->description , 1000, $end='...') }}</p>
										</div>
										{{-- update and delete for lectures teset --}}
										{{-- update and delete for lectures --}}
										
										<div class="col-md-12" style="display: flex">
											<a href="{{ route("ad_lectures.edit",["ad_lecture"=>"$his_data->LectureID"]) }}"
												 class="btn green radius-xl outline">Update</a>
											<form 
											class="del-btn" 
											method="POST" 
											action="{{route('ad_lectures.destroy',["ad_lecture" => "$his_data->LectureID"]) }}"
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
						</div>
						@endif
						@if ($his_data->type_name == "event")
						<div class="widget-inner">
							<div class="card-courses-list admin-courses">
								<div class="card-courses-media">
									<img src="{{ asset('assets/images/historical_data/'.$his_data->cover_image) }}" alt=""/>
	
								</div>
								<div class="card-courses-full-dec">
									<div class="card-courses-title">
										<h4>{{ $his_data->name }}</h4>
									</div>
									<div class="card-courses-list-bx">
										<ul class="card-courses-view">
											<li class="card-courses-categories">
												<h5>Time Period</h5>
												<h4>{{ $his_data->period_time }}</h4>
												<h4>{{ $his_data->period_name }}</h4>
											</li>
											
										</ul>
									</div>
									<div class="row card-courses-dec">
										<div class="col-md-12">
											<h6 class="m-b10">Description</h6>
											<p>{{ \Illuminate\Support\Str::limit($his_data->description , 1000, $end='...') }}</p>
										</div>
										{{-- update and delete for lectures --}}
										{{-- update and delete for lectures --}}
										<div class="col-md-12" style="display: flex">
											<a href="{{ route("ad_lectures.edit",["ad_lecture"=>"$his_data->LectureID"]) }}"
												 class="btn green radius-xl outline">Update</a>
											<form 
											class="del-btn" 
											method="POST" 
											action="{{route('ad_lectures.destroy',["ad_lecture" =>"$his_data->LectureID"]) }}"
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
						</div>
						@endif
						@if ($his_data->type_name == "figure")
						<div class="widget-inner">
							<div class="card-courses-list admin-courses">
								<div class="card-courses-media">
									<img src="{{ asset('assets/images/historical_data/'.$his_data->cover_image) }}" alt=""/>
	
								</div>
								<div class="card-courses-full-dec">
									<div class="card-courses-title">
										<h4>{{ $his_data->name }}</h4>
									</div>
									<div class="card-courses-list-bx">
										<ul class="card-courses-view">
											<li class="card-courses-categories">
												<h5>Time Period</h5>
												<h4>{{ $his_data->period_time }}</h4>
												<h4>{{ $his_data->period_name }}</h4>
											</li>
											
										</ul>
									</div>
									<div class="row card-courses-dec">
										<div class="col-md-12">
											<h6 class="m-b10">Description</h6>
											<p>{{ \Illuminate\Support\Str::limit($his_data->description , 1000, $end='...') }}</p>
										</div>
										<hr>
										<div class="col-md-12">
											<h6 class="m-b10">Most Famous Achievement</h6>
											<p>{{ $his_data->most_fam_ach}}</p>
											<p>{{ $his_data->ach_desc}}</p>
										</div>
											{{-- update and delete for lectures --}}
											<div class="col-md-12" style="display: flex">
												<a href="{{ route("ad_lectures.edit",["ad_lecture"=>"$his_data->LectureID"]) }}"
													 class="btn green radius-xl outline">Update</a>
												<form 
												class="del-btn" 
												method="POST" 
												action="{{route('ad_lectures.destroy',["ad_lecture" => "$his_data->LectureID"]) }}"
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
						</div>
						@endif
						
						
						{{-- {{ $image = $his_data->cover_image }} --}}
					</div>
					
				</div>
			</div>
			<!-- Your Profile Views Chart END-->
		</div>
	</div>
	
</main>
@endsection