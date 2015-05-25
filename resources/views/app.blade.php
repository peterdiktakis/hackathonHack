<!DOCTYPE html>
<html lang="en" ng-app='travel'>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title')</title>
	<link href="{{ asset('/css/owl.carousel.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="/owl.carousel/owl-carousel/owl.carousel.css">
	<link rel="stylesheet" href="/owl.carousel/owl-carousel/owl.theme.css">
	<link rel="stylesheet" type="text/css" href="/css/bootstrap-datepicker.css" />
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link href="{{ asset('/css/nico.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/noham.css') }}" rel="stylesheet">

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

	@yield('headScripts')

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:100,200,400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<div class="name">
		<a href="/" style="text-decoration:none;"><h3>&#47;&#47;Hack</h3><a>
		</div>
		<div class="hack">
			<img src="/images/hackathon.png" alt="hackathon"/>
		</div>

		@yield('content')
		@yield('footer')
		@yield('page-script')
	</body>
</html>
