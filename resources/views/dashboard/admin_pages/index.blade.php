@extends("dashboard.layouts.layout")


@section("dashboard.content")
<main class="ttr-wrapper">
    <div class="container-fluid">
        <div class="db-breadcrumb">
            <h4 class="breadcrumb-title">Dashboard</h4>
            <ul class="db-breadcrumb-list">
                <li><a href="#"><i class="fa fa-home"></i>Home</a></li>
                <li>Dashboard</li>
            </ul>
        </div>	
       
        <div class="row">
           
            <div class="col-lg-6 m-b30">
                <div class="widget-box">
                    <div class="wc-title">
                        <h4>Registered Users</h4>
                    </div>
                    <div class="widget-inner">
                        <div class="new-user-list">
                            <ul>
                                @foreach ($users as $u)
                                    @if ($u->user_role->name != "administrator")
                                        <li>
                                            <span class="new-users-pic">
                                                <img src="assets/images/profile/{{ $u->photo }}" alt="profile"/>
                                            </span>
                                            <span class="new-users-text" style="padding-left: 30px">
                                                <a href="#" class="new-users-name">{{ $u->username }} </a>
                                                <span class="new-users-info">{{ $u->email }}</span>
                                                <br>
                                                <span class="new-users-info">{{ $u->user_role->name }}</span>
                                            </span>
                                        </li> 
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 m-b30">
                <div class="widget-box">
                    <div class="wc-title">
                        <h4>User Reviews</h4>
                    </div>
                    <div class="widget-inner">
                        @foreach ($revs as $r)
						<div class="card-courses-list admin-review">
							<div class="card-courses-full-dec">
								<div class="card-courses-list-bx">
									<ul class="card-courses-view">
										<li class="card-courses-user">
											<div class="card-courses-user-pic">
												<img src="assets/images/profile/{{ $r->user->photo }}" alt="image"/>
											</div>
											<div class="card-courses-user-info">
												<h5>Reviewer</h5>
												<h4>{{ $r->user->username }}</h4>
											</div>
										</li>
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
								</div>
								<div class="row card-courses-dec">
									<hr>
									<div class="col-md-12">
										<p>{{ $r->text }}</p>
									</div>
									
								</div>
							</div>
						</div>
						@endforeach
                        <a href="{{ route("ad_reviews") }}" class="ud-btn ud-btn-primary">Show more </a>
					
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</main>
@endsection