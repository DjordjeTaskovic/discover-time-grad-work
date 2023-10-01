@extends("dashboard.layouts.layout")
@section("dashboard.content")
<main class="ttr-wrapper">
	<div class="container-fluid">
		<div class="db-breadcrumb">
			<h4 class="breadcrumb-title">Add Event</h4>
			<ul class="db-breadcrumb-list">
				<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
				<li>Calendar</li>
				<li>Add Event</li>

			</ul>
		</div>	
		<div class="row">
			<div class="col-lg-12">
				<div class="widget-box" style="box-shadow: none">
					<div class="wc-title" style="display: flex">
						<h4>Add Calendar Event</h4>
						@if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                      @endif
					</div>
				</div>
			</div>
			
		</div>
		<!-- Your Profile Views Chart -->
		<div class="row">
			<div class="col-md-12 m-b30">
				<div class="widget-box">
					<div class="widget-inner">
						<form class="edit-profile m-b30" 
						    action="{{ route("u_add_calendar_event_form") }}" method="POST" enctype="multipart/form-data">
							@csrf
								<div class="form-group row">
									<div class="col-12">
										<h3>Details</h3>
										@php
											// Set the timezone
											date_default_timezone_set('Europe/Belgrade');

											// Get the current date and time
											$currentDate = date('Y-m-d'); // Format: YYYY-MM-DD
											$currentTime = date('H:i:s'); // Format: HH:MM:SS

											// Calculate the end date (current date + one day)
											$endDate = date('Y-m-d', strtotime($currentDate . ' +2 day'));

											// Calculate the end time (current time + two hours)
											$endTime = date('H:i:s', strtotime($currentTime . ' +2 hours'));
										@endphp
									</div>
								</div>
								<div class="form-group row">
									<div class="col-12">
										<div class="row">
											<div class="col-lg-6 col-sm-12">
												<div class="row">
													<div class="col-12">
														<label class="col-form-label">Event name</label>
														<input class="form-control" type="text" value="" name="name" placeholder="write here..">
														@error('name')
															<div class="alert alert-danger">
																{{$message}}
															</div>
														@enderror
													</div>
												</div>
												<div class="row">
														
													<div class="col-6">
														<label class="col-form-label">Start date <span style="font-style: italic;color:gray;">(curent date is selected) </span></label>
														<input class="form-control" type="date" value="{{ $currentDate }}" name="start_date" placeholder="">
														@error('start_date')
															<div class="alert alert-danger">
																{{$message}}
															</div>
														@enderror
													</div>
													<div class="col-6">
														<label class="col-form-label">End date <span style="font-style: italic;color:gray;">(estemated date is selected) </span></label>
														<input class="form-control" type="date" value="{{ $endDate }}" name="end_date">
														@error('end_date')
															<div class="alert alert-danger">
																{{$message}}
															</div>
														@enderror
													</div>
													<div class="col-6">
														<label class="col-form-label">Start Time <span style="font-style: italic;color:gray;">(curent time is selected) </span></label>
														<input class="form-control" type="time" value="{{ $currentTime }}" name="start_time">
														@error('start_time')
															<div class="alert alert-danger">
																{{$message}}
															</div>
														@enderror
													</div>
													<div class="col-6">
														<label class="col-form-label">End Time <span style="font-style: italic;color:gray;">(estemated time is selected) </span></label>
														<input class="form-control" type="time" value="{{ $endTime }}" name="end_time">
														@error('end_time')
															<div class="alert alert-danger">
																{{$message}}
															</div>
														@enderror
													</div>
												</div>
												<div class="row">
													<div class="col-12">
														<label class="col-form-label">Pick an event to add event to:</label>
																<select class="form-select" aria-label="Default select example"
																 name="lecture[]" id="lang-select">
																	<option value="0" selected>
																		Select lecture from bellow
																	</option>
																	@foreach ($lectures as $l)
																			<option value="{{ $l->ID }}">
																				<i class="fa fa-clock-o"></i>
																				{{ $l->lecture_name }}
																			</option>
																	@endforeach
																</select>
																@error('lecture.*')
																<div class="alert alert-danger">
																	{{$message}}
																</div>
															@enderror
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-12">
										<button type="submit" class="btn">Save changes</button>
										<button type="reset" class="btn-secondry">Cancel</button>
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