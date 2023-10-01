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
				<div class="error-page">
					<h3>Ooopps :(</h3>
					<h5>Error code: 500</h5>
					<p>The server has encountered a situation it does not know how to handle.</p>
						@if(session()->has('errorMessage'))
							<div class="alert alert-danger">
								{{ session()->get('errorMessage') }}
							</div>
						@endif
					<div class="">
						<a href="{{ route("home") }}" class="ud-btn ud-btn-primary">Back To Home</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection