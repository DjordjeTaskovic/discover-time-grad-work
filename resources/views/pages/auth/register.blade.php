@extends('layouts.auth_layout')
{{-- 
@section('title') Home @endsection
@section('description') The main page of the shop. @endsection
@section('keywords') shop, online, home, best, sellers @endsection --}}

@section('content')
<div class="account-form">
	<div class="account-head" 
	style="background-image:url({{ asset('assets/images/background/bg2.jpg') }});">
		<a href="{{ route('home')}}">
			<img src="{{ asset('assets/images/logo-icons/discover_time12-cropped-dark-removebg-preview.png') }}" alt="">
		</a>
	</div>
	<div class="account-form-inner">
		<div class="account-container">
			<div class="heading-bx left">	
				<p>Return back <a href="{{ route('home')}}">home</a></p>
				<br>
				<h2 class="title-head">Sign Up <span>Now</span></h2>
				<p>Login Your Account <a href="{{ route('loginpage')}}">Click here</a></p>
				
			</div>	
			<form class="contact-bx" method="POST" action="{{ route("register") }}">
				@csrf
				<div class="row placeani">
					<div class="col-lg-12">
						<div class="form-group">
							<div class="input-group">
								<label>Your Name</label>
								<input name="dzUsername" type="text"  class="form-control">
								@error('dzUsername')
								<div class="text-danger">
									{{$message}}
								</div>
								 @enderror
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group">
							<div class="input-group">
								<label>Your Email Address</label>
								<input name="dzEmail" type="email"  class="form-control">
								@error('dzEmail')
								<div class="text-danger">
									{{$message}}
								</div>
							 @enderror
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group">
							<div class="input-group"> 
								<label>Your Password</label>
								<input name="dzPassword" type="password" class="form-control">
								@error('dzPassword')
								<div class="text-danger">
									{{$message}}
								</div>
							 @enderror
							</div>
						</div>
					</div>
					
					<div class="col-lg-12 m-b30">
						<button name="submit" type="submit" value="Submit" class="ud-btn ud-btn-primary">Sign Up</button>
						@if(session()->has('errorMessage'))
						<div class="alert alert-danger">
							{{ session()->get('errorMessage') }}
						</div>
						@endif
					</div>
					
				</div>
			</form>
		</div>
	</div>
</div>
@endsection