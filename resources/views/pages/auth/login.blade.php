@extends('layouts.auth_layout')
{{-- 
@section('title') Home @endsection
@section('description') The main page of the shop. @endsection
@section('keywords') shop, online, home, best, sellers @endsection --}}

@section('content')
<div class="account-form">
	<div class="account-head" style="background-image:url({{ asset('assets/images/background/bg2.jpg') }});">
		<a href="{{ route("home") }}">
			<img src="{{ asset('assets/images/logo-icons/discover_time12-cropped-dark-removebg-preview.png') }}" alt="">
		</a>
	</div>
	<div class="account-form-inner">
		<div class="account-container">
			<div class="heading-bx left">
				<p>Return back <a href="{{ route('home')}}">home</a></p>
				<br>
				<h2 class="title-head ">Login to your <span>Account</span></h2>
				@if(session()->has('errorMessage'))
					<div class="alert alert-warning m-t20">
						{{ session()->get('errorMessage') }}
					</div>
				@endif
				<p>Don't have an account? <a href="{{ route('registerpage')}}">Create one here</a></p>
			</div>	
			<form class="contact-bx"method="POST" action="{{route('login')}}">
				@csrf
				<div class="row placeani">
					<div class="col-lg-12">
						<div class="form-group">
							<div class="input-group">
								<label>Your Email</label>
								<input name="dzEmail" type="text" required="" class="form-control">
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group">
							<div class="input-group"> 
								<label>Your Password</label>
								<input name="dzPassword" type="password" class="form-control" required="">
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group form-forget">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="customControlAutosizing">
								<label class="custom-control-label" for="customControlAutosizing">Remember me</label>
							</div>
						
						</div>
					</div>
					<div class="col-lg-12 m-b30">
						<button name="submit" type="submit" value="Submit" class="ud-btn ud-btn-primary ">Login</button>
						
					
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection