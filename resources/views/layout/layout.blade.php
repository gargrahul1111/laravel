<!doctype html>
<html lang="en">
<head>
	@include('layout.partials.head')
</head>
<body>
	<div class="container">
		@yield('content')
	</div><!-- /.container -->


<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	@include('layout.partials.footer-scripts');
</body>
</html>