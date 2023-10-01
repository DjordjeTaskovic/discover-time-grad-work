@extends("dashboard.layouts.layout")

@section("dashboard.content")
<main class="ttr-wrapper">
	<div class="container-fluid">
		<div class="db-breadcrumb">
			<h4 class="breadcrumb-title">Reviews</h4>
			<ul class="db-breadcrumb-list">
				<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
				<li>My Reviews</li>
			</ul>
		</div>	
		<div class="row">
			<!-- Your Profile Views Chart -->
			<div class="col-lg-12 m-b30">
				<div class="widget-box">
					<div class="wc-title">
						<h4>My Reviews</h4>
					</div>
					<div class="widget-inner">
						@if (count($revs)== 0)
							<div class="card-courses-list admin-courses">
								<span>Curently, you have not submitted any reviews.</span>
							</div>
							@else
								@foreach ($revs as $r)
								<div class="card-courses-list admin-review">
									<div class="card-courses-full-dec">
										<div class="card-courses-title">
											<h4>{{ $r->name }}</h4>
										</div>
										<div class="card-courses-list-bx">
											<ul class="card-courses-view">
												<li class="card-courses-review">
													<h5>{{ $r->review_value }} Stars</h5>
													<ul class="cours-star">
														@for ($i = 1; $i <= $r->review_value; $i++)
															<li class="active"><i class="fa fa-star"></i></li>
														@endfor
														@for ($i = 1; $i <= 5 - $r->review_value; $i++)
															<li><i class="fa fa-star"></i></li>
														@endfor
														
													</ul>
												</li>
												<li class="card-courses-categories">
													<h5>Date</h5>
													<h4>{{ $r->created_at }}</h4>
												</li>
											</ul>
											<p>{{ $r->rev_text }}</p>
										</div>
										
										<div class="row card-courses-dec">
											<div class="col-md-12">
												<a href="#" class="ud-btn ud-btn-primary"
												 data-toggle="modal" 
												 data-target="#exampleModal{{ $r->RevID }}">Update Review</a>
											</div>
										</div>
									</div>
								</div>
									
								@endforeach
						@endif
						
					</div>
					{{--  --}}
					@foreach ($revs as $r)
						<div class="modal fade review-bx-reply" 
						id="exampleModal{{ $r->RevID }}" tabindex="-1" role="dialog" 
						aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">{{ $r->name }}</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form action="{{ route("u_update_review") }}" method="POST">
											@csrf
											<input type="hidden" id="RevID" name="RevID" value="{{ $r->RevID }}" />
											<input type="hidden" id="lecture_ID" name="lecture_ID" value="{{ $r->lecture_ID }}" />
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
					@endforeach
					{{--  --}}
				</div>
			</div>
			<!-- Your Profile Views Chart END-->
		</div>
	</div>
</main>
@endsection