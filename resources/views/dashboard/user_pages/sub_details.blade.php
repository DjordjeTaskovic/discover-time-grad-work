@extends("dashboard.layouts.layout")


@section("dashboard.content")

<main class="ttr-wrapper">
	<div class="container-fluid">
		<div class="db-breadcrumb">
			<h4 class="breadcrumb-title">Subscription</h4>
			<ul class="db-breadcrumb-list">
				<li><a href="{{ route("u_dashboard") }}">User Profile</a></li>
				<li><a href="#">Subscription Details</a></li>

			</ul>
		</div>	
		<div class="row">
			<!-- Your Profile Views Chart -->
			<div class="col-lg-12 m-b30">
				<div class="widget-box">
					<div class="wc-title">
						<h4>Subscription Data</h4>
                        <div class="remove-btn m-t20">
                            @if ($subscription->price != 0)
                                <a href="{{ route("u_sub_remove",["id"=>$subscription->sub_ID]) }}" 
                                    class="btn button-sm red">Remove
                                </a>
                             @endif

                        </div>
                    </div>
						<div class="widget-inner">
							<div class="card-courses-list admin-courses">
								<div class="card-courses-full-dec">
									<div class="card-courses-list-bx">
										<ul class="card-courses-view">
                                           <li>
                                            <ul style="list-style-type: none">
                                                <li class="card-courses-categories">
                                                    <h5>Name</h5>
                                                    <h4>{{ $subscription->title }}</h4>
                                                </li>
                                                <li class="card-courses-categories ">
                                                    <h5>Difficulty</h5>
                                                    <h4>{{ $subscription->difficulty }}</h4>
                                                </li>
                                                <li class="card-courses-categories ">
                                                    <h5>Activity</h5>
                                                        @if ($subscription->has_expired == 1)
                                                        <h4>Expired</h4>
                                                        @else
                                                        <h4>Still Active</h4>
                                                        @endif
                                                </li>
                                            </ul>
                                           </li>
											<li>
                                                <ul style="list-style-type: none">
                                                    <li class="card-courses-categories ">
                                                        <h5>Price</h5>
                                                        <h4>{{ $subscription->price }} $/ {{ $subscription->duration_in_months }} month</h4>
                                                    </li>
                                                    <li class="card-courses-categories ">
                                                        <h5>Date Added</h5>
                                                        <h4>{{ $subscription->sub_created_date }}</h4>
                                                    </li>
                                                    <li class="card-courses-categories ">
                                                        <h5>Expires</h5>
                                                            <h4>
                                                                @php
                                                                   echo $new_time = date("Y-m-d H:i:s", 
                                                                   strtotime("+{$subscription->duration_in_months} months"))
                                                                @endphp
                                                            </h4>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="card-courses-stats">
                                              
											</li>
										</ul>
									</div>
									<div class="row card-courses-dec">
										<div class="col-md-12">
											<h6 class="m-b10">Description</h6>
											<p>{{ $subscription->description  }}</p>
										</div>
										<div class="col-md-12">
											<h6 class="m-b10">Features</h6>
                                            <p>
                                                @php
                                                    $search = array('.', ':');
                                                    $replace = array('.<br /><br />', '');
                                                    echo $featuresbraked = str_replace($search, $replace, $subscription->features);
                                                @endphp
                                            </p>
										</div>
									</div>
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