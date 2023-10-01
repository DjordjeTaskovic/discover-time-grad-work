@extends('dashboard.layouts.layout')


<!--Main container start -->	
@section("dashboard.content")
<main class="ttr-wrapper">
	<div class="container-fluid">
		<div class="db-breadcrumb">
			<h4 class="breadcrumb-title">Mailbox</h4>
			<ul class="db-breadcrumb-list">
				<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
				<li>Mailbox Archive</li>
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
								<ul>
									<li class="active">
										<a href="{{ route('ad_mailbox') }}"><i class="fa fa-envelope-o"></i> Inbox
											<span class="badge badge-success">{{ count($mail) }}</span>
										</a>
									</li>
									<li>
										<a href="#"><i class="fa fa-archive"></i>Archive
											<span class="badge badge-success">{{ count($arch_mail) }}</span></a>
									</li>
								</ul>
							</div>
						</div>
						<div class="mail-list-container">
							<div class="mail-toolbar">
								<div class="check-all">
									{{--  --}}
								</div>
								<div class="mail-search-bar">
									{{--  --}}
								</div>
							</div>
							<div class="mail-box-list">
								@if(count($arch_mail) == 0)
								<div class="mail-list-info">
									<div class="checkbox-list">
										<div class="custom-control custom-checkbox checkbox-st1">
										</div>
									</div>
									<div class="mail-list-title">
										<h6>Curently, there are no archived mails.</h6>
									</div>
								</div>
								@else
								@foreach ($arch_mail as $m)
									<div class="mail-list-info">
										<div class="checkbox-list">
											<div class="custom-control custom-checkbox checkbox-st1">
											</div>
										</div>
										<div class="mail-list-title">
											<h6>{{ $m->name }}</h6>
										</div>
										<div class="mail-list-title-info">
											<p>{{ $m->message }}</p>
										</div>
										<div class="mail-list-time">
											<span>{{$m->created_at }}</span>
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