<!DOCTYPE html>
<html lang="en">
    @include('fixed.head')

<body id="bg">
	<div class="page-wraper">
		{{-- <div id="loading-icon-bx"></div> --}}
		<!-- Header Top ==== -->
		@include('fixed.navigation')
		<!-- Header Top END ==== -->
		<!-- Content -->
		@yield('content')
		<!-- Content END-->
		<!-- Footer ==== -->
        @include('fixed.footer')
		<!-- Footer END ==== -->
		<button class=" back-to-top fa fa-chevron-up"></button>
	</div>

	<!-- External JavaScripts -->
	@include('fixed.scripts')
</body>

</html>