@extends("dashboard.layouts.layout")

@section("dashboard.content")
<main class="ttr-wrapper">
	<div class="container-fluid">
		<div class="db-breadcrumb">
			<h4 class="breadcrumb-title">Notifications</h4>
			<ul class="db-breadcrumb-list">
				<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
				<li>Notifications</li>
			</ul>
		</div>	
		<div class="row">
			<!-- Your Profile Views Chart -->
			<div class="col-lg-12 m-b30">
				<div class="widget-box">
					<div class="email-wrapper">
						<div class="mail-list-container">
							<div class="mail-toolbar">
								
							</div>
							<div class="mail-box-list">
								@if (count($notifications) == 0)
								<div class="card-courses-list admin-courses">
									<span>Curently, you dont have any notifications.</span>
								</div>
								@else
									@foreach ($notifications as $r)
									<div class="ttr-accordion m-t10 m-b10 faq-bx">
										<div class="panel revs">
											<div class="acod-head">
												<h6 class="acod-title"> 
													<a 
													data-toggle="collapse"
													 href="#faq{{$r->ID }}" 
													 class="collapsed" 
													 data-parent="#faq{{$r->ID }}" style="display: flex; justify-content:space-between">
														
														<div> 
															<span>{{ $r->title }}</span>
														</div>
														<div>
															<span>{{ date("Y-m-d", strtotime($r->created_at)) }}</span>
														</div>
													</a>
												 </h6>
											</div>
											<div id="faq{{$r->ID }}" class="acod-body collapse show">
												<div class="acod-content">
                                                    {{ $r->message }}
													</div>
											</div>
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
</main>
@endsection