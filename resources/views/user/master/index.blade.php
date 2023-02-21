<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }} " type="image/png" />
	<!--plugins-->
	<link href="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }} " rel="stylesheet" />
	<link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }} " rel="stylesheet" />
	<link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }} " rel="stylesheet" />
	<link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }} " rel="stylesheet" />
	<!-- loader-->
	<link href="{{ asset('assets/css/pace.min.css') }} " rel="stylesheet" />
	<script src="{{ asset('assets/js/pace.min.js') }} "></script>
	<!-- Bootstrap CSS -->
	<link href="{{ asset('assets/css/bootstrap.min.css') }} " rel="stylesheet">
	<link href="{{ asset('assets/css/bootstrap-extended.css') }} " rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/icons.css') }} " rel="stylesheet">
	{{-- Box Icon --}}
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	@stack('css')

	<title>Knight Card - Web Store</title>
</head>

<body class="bg-theme bg-theme9">
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		@include('user.partials.sidebar')
		<!--end sidebar wrapper -->
		<!--start header -->
		@include('user.partials.header')
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				@yield('breadcrumbs')
				@yield('content')
			</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		@include('user.partials.footer')
	</div>
	<!--end wrapper-->
	
	<!-- Bootstrap JS -->
	<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }} "></script>
	<!--plugins-->
	<script src="{{ asset('assets/js/jquery.min.js') }} "></script>
	<script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }} "></script>
	<script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }} "></script>
	<script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }} "></script>
	<!--app JS-->
	<script src="{{ asset('assets/js/app.js') }} "></script>
	{{-- Boox icon --}}
	<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
	@stack('js')
</body>

</html>