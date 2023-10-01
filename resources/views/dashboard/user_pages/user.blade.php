@extends("dashboard.layouts.layout")
@section("dashboard.content")

<main class="ttr-wrapper">
	<div class="page-banner ovbl-dark" style="height: 10rem;">
		<div class="container">
			<div class="page-banner-entry">
				<h1 class="text-white">User Profile</h1>
			 </div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="db-breadcrumb">
			<ul class="db-breadcrumb-list">
				<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
				<li>User Profile</li>
			</ul>
		</div>	
		<!-- Your Profile Views Chart -->
		<div class="row">
			<div class="col-md-12 m-b30">
				<div class="widget-box">
					<div class="wc-title">
						<h4>Profile</h4>
					</div>
					<div class="widget-inner">
						<form class="edit-profile m-b30" 
						    action="{{ route("u_user_update") }}" method="POST" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="_method" value="PUT" />
								<div class="form-group row">
									<div class="col-sm-10  ml-auto">
										<div class="card-courses-user-pic">
										<img  src="{{ asset('assets/images/profile/'.$user->photo) }}" alt="image">
										</div>
										<h3>Personal Details</h3>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Full Name</label>
									<div class="col-sm-7">
										<input type="hidden" class="form-control" id="ID" name="ID"
										value="{{ $user->ID  }}"/>
										<input class="form-control" type="text" value="{{ $user->username }}" name="username">
										@error('username')
											<div class="alert alert-danger">
												{{$message}}
											</div>
										 @enderror
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Email</label>
									<div class="col-sm-7">
										<input class="form-control" type="text" value="{{ $user->email }}" name="email">
										@error('email')
											<div class="alert alert-danger">
												{{$message}}
											</div>
										 @enderror
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Phone No.</label>
									<div class="col-sm-7">
										<input class="form-control" type="text" value="{{ $user->phone }}" name="phone">
										@error('phone')
											<div class="alert alert-danger">
												{{$message}}
											</div>
										 @enderror
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">User Role</label>
									<div class="col-sm-7">
										<input class="form-control" type="text" value="{{ $user->role_name }}" disabled>
									</div>
								</div>
								
								<div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>

						<br>
						<br>
							<div class="">
								<div class="form-group row">
									<div class="col-sm-10 ml-auto">
										<h3>Password Changes</h3>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">New Password</label>
									<div class="col-sm-7">
										<input class="form-control" type="password" value="" name="password">
										@error('password')
											<div class="alert alert-danger">
												{{$message}}
											</div>
										 @enderror
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Re Type Password</label>
									<div class="col-sm-7">
										<input class="form-control" type="password" value="" name="re_password">
										@error('re_password')
											<div class="alert alert-danger">
												{{$message}}
											</div>
										 @enderror
									</div>
								</div>
							</div>
							<br>
							<br>
							<div class="">
								<div class="form-group row">
									<div class="col-sm-10 ml-auto">
										<h3>Photo change</h3>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Profile photo</label>
									<div class="col-sm-7">
										<input class="form-control" type="file" name="profile">
										@error('profile')
											<div class="alert alert-danger">
												{{$message}}
											</div>
										 @enderror
									</div>
								</div>
							</div>
							<div class="">
								<div class="">
									<div class="row">
										<div class="col-sm-2">
										</div>
										<div class="col-sm-7">
											<button type="submit" class="btn">Save changes</button>
											<button type="reset" class="btn-secondry">Cancel</button>
										</div>
									</div>
								</div>
							</div>
								
						</form>
					
					</div>
				</div>
			</div>
			<!-- Your Profile Views Chart END-->
		</div>
	
		
	</div>
</main>
@endsection