<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>Lecture Content</title>

		<link rel="stylesheet" href="{{ asset('reveal.js_files/dist/reset.css') }}">
		<link rel="stylesheet" href="{{ asset('reveal.js_files/dist/reveal.css') }}">
		<link rel="stylesheet" href="{{ asset('reveal.js_files/dist/theme/night.css') }}">
		<link rel="stylesheet" href="{{ asset('reveal.js_files/dist/custom_layout.css') }}">
		<!-- Theme used for syntax highlighted code -->
		<link rel="stylesheet" href="{{ asset('reveal.js_files/plugin/highlight/monokai.css') }}">
        {{-- fontawesome --}}
        <link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome/css/font-awesome.min.css') }}">
	</head>
	<body>
		@php
			$largeText =  $lecture->data_description;
        // Check if the text ends with '..', then remove it.
            if (substr($largeText, -2) === '..') {
                $largeText = substr($largeText, 0, -2);
            }
            $segmentsArray = explode('..', $largeText);

		@endphp	
		<div class="reveal">
			<div class="slides">
				<!-- Intro Slide -->
				<section>
					<div class="wrapper">
						<div class="card3">
							<div class="card-inner">
								<div class="card-title">
									<h1>{{ $lecture->lecture_name }}</h1>
								</div>
								<div class="card-links fragment fade-up">
									<ul>
										<li>{{ $lecture->period_time }}</li>
										<li>{{ $lecture->period_name }}</li>
										<li>{{ $lecture->category_name }}</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</section>
				<!-- Intro Slide end -->
				{{-- rsis --}}
				<section>
					<div class="wrapper">
							<div class="card1">
								<div class="card-inner">
									<div class="card-title">
										<h2>Introduction</h2>
									</div>
									<div class="card-content ">
										<p class="card-text">{{ $segmentsArray[0].'.' }}</p>
									</div>
									<div class="card-links fragment fade-up">
										<a href="#">Know more > </a>
									</div>
								</div>
							</div>
							<div class="card2" style="background-image: url('{{ asset('assets/images/historical_data/'.$lecture->cover_image) }}');
							background-size:cover; overflow: hidden;
							background-position: 10%; filter: brightness(0.7);">
							</div>
					</div>
				</section>
				{{-- otrs --}}
				<section>
					<div class="wrapper">
						<div class="card4">
							<div class="card-inner1">
								<h2>Background</h2>
									<p class="card-text">{{ $segmentsArray[1].'.' }}</p>
							</div>
						</div>
						<div class="card5">
								<div class="card-inner1">
									<div class="card-content">
										<p class="card-text">{{ $segmentsArray[2].'.' }}</p>
									</div>
									<hr>
									<div class="card-content fragment fade-up">
										<p class="card-text">{{ $segmentsArray[3].'.' }}</p>

									</div>
									<hr>
									
								</div>
						</div>
					</div>
				</section>
				{{-- lsis --}}
				<section>
					<div class="wrapper">
							<div class="card2" style="background-image: url('{{ asset('assets/images/historical_data/'.$lecture->cover_image) }}');
								background-size:cover; overflow: hidden;
								background-position: 35%; filter: brightness(0.7);">
							</div>
							<div class="card1">
								<div class="card-inner">
									<div class="card-title">
										<h2>Background</h2>
									</div>
									<div class="card-content fragment fade-up">
										<p class="card-text">{{ $segmentsArray[4].'.' }}</p>

									</div>
									<div class="card-links fragment fade-up">
										<a href="#">Know more > </a>
									</div>
								</div>
							</div>
					</div>
				</section>
				{{-- otrs rev --}}
				<section>
					<div class="wrapper">
						<div class="card5">
								<div class="card-inner1">
									<div class="card-content fragment fade-up">
										<p class="card-text">{{ $segmentsArray[5].'.' }}</p>
									</div>
									<hr>
									<div class="card-content fragment fade-up">
										<p class="card-text">{{ $segmentsArray[6].'.' }}</p>
									</div>
									<hr>
								</div>
						</div>
						<div class="card4">
							<div class="card-inner1">
								<h2>Further In</h2>
								<p class="card-text"> {{ $segmentsArray[7].'.' }}</p>

							</div>
						</div>
					</div>
				</section>
				{{-- rfs --}}
				<section>
					<div class="wrapper">
							<div class="card1">
								<div class="card-inner">
									<div class="card-content fragment fade-up">
										<p class="card-text">{{ $segmentsArray[8].'.' }}</p>

									</div>
									<div class="card-content fragment fade-up">
										<p class="card-text">{{ $segmentsArray[9].'.' }}</p>

									</div>
								</div>
							</div>
							<div class="card2" style="background-image: url('{{ asset('assets/images/historical_data/'.$lecture->cover_image) }}');
							background-size:cover; overflow: hidden;
							background-position: 60%; filter: brightness(0.7);">
							</div>
					</div>
				</section>
				{{-- rfs --}}
				<section>
					<div class="wrapper">
							<div class="card1">
								<div class="card-inner">
									<div class="card-content fragment fade-up">
										<p class="card-text">{{ $segmentsArray[10].'.' }}</p>

									</div>
									<div class="card-content fragment fade-up">
										<p class="card-text">{{ $segmentsArray[11].'.' }}</p>

									</div>
								</div>
							</div>
							<div class="card2" style="background-image: url('{{ asset('assets/images/historical_data/'.$lecture->cover_image) }}');
							background-size:cover; overflow: hidden;
							background-position: 60%; filter: brightness(0.7);">
							</div>
					</div>
				</section>
				{{-- img 1 --}}
				<section>
					<div class="wrapper" style="margin-top:4rem;">
						@foreach ($lecture->images as $img)
							<div class="card6">
								<div class="card-inner">
									<div class="card-content">
										<h4>{{ $img->title }}</h4>
									</div>
									<div class="card-image" 
									style="background-image: url('{{ asset('assets/images/historical_data/inner_images/'.$img->url)}}');
									background-size:cover; overflow: hidden;
									background-position: 50%; filter: brightness(0.7);">
									
									</div>
									<div class="card-content">
										<span>{{ $img->text }}</span>
									</div>
								</div>
							</div>
						@endforeach
							
					</div>
				</section>
			
				{{-- lfs --}}
				<section>
					<div class="wrapper">
							<div class="card2" style="background-image: url('{{ asset('assets/images/historical_data/'.$lecture->cover_image) }}');
								background-size:cover; overflow: hidden;
								background-position: 85%; filter: brightness(0.7);">
								</div>
							<div class="card1">
								<div class="card-inner">
									<h2>Achievements </h2>
									<div class="card-content fragment fade-up">
										<p class="card-text">{{ $segmentsArray[12].'.' }}</p>
									</div>
									<div class="card-content fragment fade-up">
										<p class="card-text">{{ $segmentsArray[13].'.' }}</p>
									</div>
								</div>
							</div>
							
					</div>
				</section>
				{{-- lfs --}}
				<section>
					<div class="wrapper">
							<div class="card2" style="background-image: url('{{ asset('assets/images/historical_data/'.$lecture->cover_image) }}');
								background-size:cover; overflow: hidden;
								background-position: 85%; filter: brightness(0.7);">
								</div>
							<div class="card1">
								<div class="card-inner">
									
									<div class="card-content fragment fade-up">
										<p class="card-text">{{ $segmentsArray[13].'.' }}</p>
									</div>
									<div class="card-content fragment fade-up">
										<p class="card-text">{{ $segmentsArray[14].'.' }}</p>
									</div>
								</div>
							</div>
							
					</div>
				</section>
				{{-- rfs --}}
				<section>
					<div class="wrapper">
							<div class="card1">
								<div class="card-inner">
									<div class="card-content fragment fade-up">
										<p class="card-text">{{ $segmentsArray[15].'.' }}</p>

									</div>
									<div class="card-content fragment fade-up">
										<p class="card-text">{{ $segmentsArray[16].'.' }}</p>

									</div>
								</div>
							</div>
							<div class="card2" style="background-image: url('{{ asset('assets/images/historical_data/'.$lecture->cover_image) }}');
							background-size:cover; overflow: hidden;
							background-position: 60%; filter: brightness(0.7);">
							</div>
					</div>
				</section>
					{{-- rsis --}}
					<section>
						<div class="wrapper">
								<div class="card1">
									<div class="card-inner">
										<div class="card-title">
											<h2>Conclusion</h2>
										</div>
										<div class="card-content fragment fade-up">
											<p class="card-text">{{ $segmentsArray[17].'.' }}</p>
										</div>
									</div>
								</div>
								<div class="card2" style="background-image: url('{{ asset('assets/images/historical_data/'.$lecture->cover_image) }}');
								background-size:cover; overflow: hidden;
								background-position: 10%; filter: brightness(0.7);">
								</div>
						</div>
					</section>
				{{-- ending --}}
				<section style="text-align: left;">
					<div class="wrapper">
						<div class="card-inner1">
							<h1>This is the end of Lecture</h1>
							<p>
								- <a href="#">Thank you for you attention.</a> <br>
								- <a href="#">Make sure to give it a rating of your choice!</a> <br>
								- <a href="{{ route("lecture_content_finished",['id'=>$lecture->LectureID]) }}">
									Return back <i class="fa fa-sign-out" aria-hidden="true"></i></a>
							</p>
						</div>
					</div>
				</section>

				

			</div>
		</div>

		<script src="{{ asset('reveal.js_files/dist/reveal.js')}}"></script>
		<script src="{{ asset('reveal.js_files/plugin/notes/notes.js')}}"></script>
		<script src="{{ asset('reveal.js_files/plugin/markdown/markdown.js')}}"></script>
		<script src="{{ asset('reveal.js_files/plugin/highlight/highlight.js')}}"></script>

		<script>
			
			Reveal.initialize({
				hash: true,
				controls: true,
				progress: true,
				history: false,
				center: false,
				// embedded: false,
				transition: 'fade',
				slideNumber: 'c/t',
				width: 1640,
				height: 1000,

				// Learn about plugins: https://revealjs.com/plugins/
				plugins: [ RevealMarkdown, RevealHighlight, RevealNotes ],
				
			});
		</script>
		
	</body>
</html>
