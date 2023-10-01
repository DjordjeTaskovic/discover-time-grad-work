@extends("dashboard.layouts.layout")
@section("dashboard.content")

<main class="ttr-wrapper">
	<div class="page-banner ovbl-dark" style="height: 10rem;">
		<div class="container">
			<div class="page-banner-entry">
				<h1 class="text-white">Membership Info</h1>
			 </div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="db-breadcrumb">
			<ul class="db-breadcrumb-list">
				<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
				<li>Membership</li>
				@if (session()->has('message'))
					<div class="alert alert-success">
						{{ session('message') }}
					</div>
				@endif
			</ul>
		</div>	
			{{-- membership info --}}
			<div class="row">
				<div class="col-lg-12">
					<div class="widget-box" style="box-shadow: none">
						<div class="wc-title" style="display: flex">
							<h4>Membership info</h4>
						</div>
					</div>
				</div>
				
			</div>
			<div class="row" >
				@foreach ($subs as $s)
				<div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
					<div class="widget-card widget-bg2">					 
						<div class="wc-item">
							<h4 class="wc-title">
								{{ $s->difficulty }}
							</h4>
							<span class="wc-des">
								{{ $s->title }}
							</span>
							<span class="wc-stats">
								{{ $s->price }} $ <p style="font-size: 12px">/ {{ $s->duration_in_months }} months</p>
							</span>		
							<div class="progress wc-progress">
								
							</div>
							<span class="wc-progress-bx">
								<span class="wc-change">
									<a href="{{ route("u_sub_details",['id' => $s->ID]) }}" class="ud-btn ud-btn-primary">
										Details 
									</a>
								</span>
								
							</span>
						</div>				      
					</div>
				</div>
				@endforeach
				@if (count($subs) != 3)
					<div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
						<div class="widget-card widget-bg2">					 
							<div class="wc-item">
								<a href="{{ route("membership") }}" class="btn">
									<i  class="fa fa-plus"></i>
								</a>
								<span class="notification-text" style="padding-left: 20px">
									<span>Add</span>
								</span>
							</div>				      
						</div>
					</div>
				@endif
			</div>
		
	</div>
</main>
@endsection