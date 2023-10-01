<!DOCTYPE html>
<html lang="en">
    @include('dashboard.fixed.head')
<body class="ttr-opened-sidebar ttr-pinned-sidebar">
	@include('dashboard.fixed.navigation')
	@include('dashboard.fixed.sidebar')

	
	<!--Main container start -->
	@yield('dashboard.content')
	<div class="ttr-overlay"></div>

<!-- External JavaScripts -->
    @include('dashboard.fixed.scripts')
</body>

</html>