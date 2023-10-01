@extends("dashboard.layouts.layout")


@section("dashboard.content")

<main class="ttr-wrapper">
	<div class="container-fluid">
		<div class="db-breadcrumb">
			<h4 class="breadcrumb-title">Lectures</h4>
			<ul class="db-breadcrumb-list">
				<li><a href="{{ route('u_dashboard') }}"><i class="fa fa-home"></i>Home</a></li>
				<li><a href="{{ route("u_lectures") }}">Lectures</a></li>
				<li>Single lecture</li>

			</ul>
		</div>	
		<div class="row">
			<!-- Your Profile Views Chart -->
			<div class="col-lg-12 m-b30">
				<div class="widget-box">
					<div class="wc-title">
						@if(session()->has('message'))
							<div class="alert alert-success">
								{{ session()->get('message') }}
							</div>
						@endif
						<h4>Lecture Data</h4>
					</div>
						<div class="widget-inner">
							<div class="card-courses-list admin-courses">
								<div class="card-courses-media">
										<img src="{{ asset('assets/images/historical_data/'.$his_data->cover_image) }}" alt="cover_image"/>
								</div>
								<div class="card-courses-full-dec">
									<div class="card-courses-title">
										<h4>{{ $his_data->lecture_name }}</h4>
									</div>
									<div class="card-courses-list-bx">
										<ul class="card-courses-view">
											<li class="card-courses-categories">
												<h5>Diration</h5>
												<h4>{{ $his_data->duration }}</h4>
											</li>
											<li class="card-courses-categories">
												<h5>Skill Level</h5>
												<h4>{{ $his_data->skill_name }}</h4>
	
											</li>
											<li class="card-courses-categories">
												<h5>Language</h5>
												<h4>{{ $his_data->language }}</h4>
	
											</li>
										</ul>
									</div>
									<div class="row card-courses-dec">
										<div class="col-md-12">
											<h6 class="m-b10">Description</h6>
											<p>{{ \Illuminate\Support\Str::limit($his_data->lecture_description , 500, $end='...') }}</p>
										</div>
									</div>
									
								</div>
							</div>
						</div>
						{{--  --}}
						{{--  --}}
						<div class="wc-title">
							<h4>Your Quiz Scores</h4>
						</div>
						<div class="widget-inner">
							@if (count($user_score))
								<div class="instructor-bx">
									<table class="table">
										<thead>
										  <tr>
											<th scope="col">#</th>
											<th scope="col">Latest Attempt</th>
											<th scope="col">Completion Percent</th>
											<th scope="col">Points</th>
											<th scope="col">Date</th>
			
										  </tr>
										</thead>
										<tbody>
											@foreach ($user_score as $key => $s)
												<tr>
												<th scope="row">{{ $key + 1 }}</th>
												<td>Attempt: {{ $s->attempt_num }}</td>
												<td>{{ $s->completion_precent }} %</td>
												<td>{{ $s->score_value }} p</td>
												<td>{{ $s->created_at }}</td>
			
												</tr>
											@endforeach
										 
										</tbody>
									  </table>
								</div> 
							@else
								<div><span>Curently, you do not have any quiz scores for this lecture.</span></div>
							@endif
						</div>
						{{--  --}}
						<div class="wc-title">
								<h4>Your Review</h4>
								@error('text')
									<div class="alert alert-danger">
										{{$message}}
									</div>
								@enderror
								@error('rate')
									<div class="alert alert-danger">
										{{$message}}
									</div>
								@enderror
						</div>
						<div class="widget-inner">
							@if ($review != null)
							<div class="instructor-bx">
								<div class="instructor-author">
									<img src="{{ asset('assets/images/profile/'.$review->photo) }}" alt="photo">
								</div>
								<div class="instructor-info">
											<h6>{{ $review->username }}</h6> 
										<div class="review">
												<ul class="cours-star">
													@for ($i = 1; $i <= $review->review_value; $i++)
														<li class="active"><i class="fa fa-star"></i></li>
													@endfor
													@for ($i = 1; $i <= 5 - $review->review_value; $i++)
														<li><i class="fa fa-star"></i></li>
													@endfor
													
												</ul>
											</div>
											<p class="m-b0">{{ $review->text }}</p>
											<br>
											<div class="row card-courses-dec">
												<div class="col-md-12">
													<a href="#" class="ud-btn ud-btn-primary"
													 data-toggle="modal" 
													 data-target="#exampleModal{{ $review->revID }}">Update Review</a>
												</div>
											</div>
								</div>
							</div> 
								@else
								<div><span>Curently, you do not have review for this lecture.</span></div>
							@endif
						</div>
						
						{{-- review modal --}}
						<div class="nav-search-bar" id="review-bar">
							<form action="{{ route("leave_review") }}" method="POST">
								@csrf
								<input type="hidden" id="lecture_ID" name="lecture_ID" value="{{ $his_data->LectureID }}" />

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
							<span id="search-remove"><i class="ti-close"></i></span>
						</div>
						{{-- review modal --}}
						{{-- update review modal  --}}
						@if ($review != null)
							<div class="modal fade review-bx-reply" 
							id="exampleModal{{ $review->revID }}" tabindex="-1" role="dialog" 
							aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
		
									<div class="modal-content">
		
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">{{ $review->username }}</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="{{ route("u_update_review") }}" method="POST">
												@csrf
												<input type="hidden" id="RevID" name="RevID" value="{{ $review->revID  }}" />
												<input type="hidden" id="lecture_ID" name="lecture_ID" value="{{ $review->lecture_ID }}" />
												<h5>Give us a positive feed back and a rating on what your experiance was!</h5>
												<div class="star-update" name="rate[]">
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
												<input name="text" value="" type="text" class="form-control" placeholder="Write here..." style="height: 5rem;">
												<button type="submit" class="ud-btn ud-btn-primary">Send</button>
											</form>
										</div>
										<div class="modal-footer">
											
										</div>
									</div>
								</div>
							</div>
						@endif
				{{--   update review modal  --}}
				</div>
			</div>
			<!-- Your Profile Views Chart END-->
		</div>
	</div>
	
</main>
<script>
	$(window).on("load", function (e) {
		$review = @json($review);
		if($review == null){
			setTimeout(function(){
			$('#review-bar').fadeIn(500).addClass('On');
			}, 5000);
		}
	});
</script>
@endsection