<!DOCTYPE html>
<html lang="en">
    @include('fixed.head')

<body id="bg">
	<div class="page-wraper">
		<div id="loading-icon-bx"></div>
		<!-- Content -->
		@yield('content')
		<!-- Content END-->
	</div>

	<!-- External JavaScripts -->
	@include('fixed.scripts')
</body>

</html>