@extends("dashboard.layouts.layout")

@section("dashboard.content")
<main class="ttr-wrapper">
	<div class="container-fluid">
		<div class="db-breadcrumb">
			<h4 class="breadcrumb-title">Reviews</h4>
			<ul class="db-breadcrumb-list">
				<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
				<li>Reviews</li>
			</ul>
		</div>	
		<div class="row">
			<!-- Your Profile Views Chart -->
			<div class="col-lg-12 m-b30">
				<div class="widget-box">
					<div class="email-wrapper">
						<div class="email-menu-bar">
							<div class="compose-mail">
							
							</div>
							<div class="email-menu-bar-inner">
								<form method="GET" action = "{{ route("ad_reviews") }}">
									@csrf
									<ul>
										<li class="mb-2">
											<select class="form-select" aria-label="Default select example" id="sort-item" name="lectureID">
												<option value="0" selected>Pick a Lecture</option>
												@foreach ($lectures as $l)
													<option value="{{ $l->ID }}">
														<i class="fa fa-clock-o"></i>{{ $l->name }}
													</option>
												@endforeach
											  </select>
										</li>
										<li class="mb-2">
											<select class="form-select" aria-label="Default select example" id="user_select" name="userID">
												<option value="0" selected>Pick a User</option>
												@foreach ($users as $u )
													<option value="{{ $u->ID }}"><i class="fa fa-clock-o"></i>{{ $u->username }}</option>
												@endforeach
											  </select>
										</li>
										<li class="mb-2">
											<select class="form-select" aria-label="Default select example" id="star_select" name="starValue">
												<option value="0" selected>Pick Star Value</option>
												<option value="asc"><i class="fa fa-clock-o"></i>Greatest star value</option>
												<option value="desc"><i class="fa fa-clock-o"></i>Lowest star value</option>
											  </select>
										</li>
									</ul>
									<div class="compose-mail">
										<button class="ud-btn ud-btn-primary" style="width: 100%" type="submit">Use filters</button>
									</div>
								</form>
							</div>
						</div>
						<div class="mail-list-container">
							<div class="mail-toolbar">
								<div class="mail-search-bar" style="width: 100%">
								
								</div>
							</div>
							<div class="mail-box-list">
									@foreach ($revs as $r)
									<div class="ttr-accordion m-t10 m-b10 faq-bx">
										<div class="panel revs">
											<div class="acod-head">
												<h6 class="acod-title"> 
													<a 
													data-toggle="collapse"
													 href="#faq{{$r->ID }}" 
													 class="collapsed" 
													 data-parent="#faq{{$r->ID }}" style="display: flex;justify-content:space-between">
													 <div> 
														<span>{{ $r->username }}</span>
													 </div>
													 <div> 
														<span>{{ $r->lecture_name }}</span>
													 </div>
													 <div> 
														<span>{{ $r->review_value }} stars</span>
													 </div>
													 <div>
														<span>{{ date("Y-m-d", strtotime($r->created_at)) }}</span>
													 </div>
													</a>
												 </h6>
											</div>
											<div id="faq{{$r->ID }}" class="acod-body collapse">
												<div class="acod-content">
												{{ $r->text }}
													</div>
											</div>
										</div>
									</div>
									@endforeach
								
							</div>
						</div>
					</div>
				</div> 
			</div>
			<!-- Your Profile Views Chart END-->
		</div>
	</div>
</main>
@endsection