
<!doctype html>
<html lang="en">

	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--favicon-->
		<link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png" />
		<!-- loader-->
		<link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
		<script src="{{ asset('assets/js/pace.min.js') }}"></script>
		<!-- Bootstrap CSS -->
		<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet">
	  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
		<link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    {{-- Box Icon --}}
	  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
		<title>Knight Store - Login</title>
	</head>

<body class="bg-theme bg-dark">
	<!--wrapper-->
	<div class="wrapper">
		<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container-fluid">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
					<div class="col mx-auto">
						@if(Session::has('success'))
						<div class="alert alert-outline-white shadow-sm alert-dismissible fade show py-2 mb-4">
							<div class="d-flex align-items-center">
								<div class="font-35 text-white"><i class="bx bxs-check-circle"></i>
								</div>
								<div class="ms-3">
									<h6 class="mb-0 text-white">Sukses!</h6>
									<div>{{ Session::get('success') }}</div>
								</div>
							</div>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						@elseif(Session::has('error'))
						<div class="alert alert-outline-white shadow-sm alert-dismissible fade show py-2 mb-4">
							<div class="d-flex align-items-center">
								<div class="font-35 text-white"><i class="bx bxs-message-square-x"></i>
								</div>
								<div class="ms-3">
									<h6 class="mb-0 text-white">Error!</h6>
									<div>{{ Session::get('error') }}</div>
								</div>
							</div>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						@endif
						<div class="card">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="text-center">
										<h3 class="">Login</h3>
										<p>Belum punya akun ? <a href="{{ route('register') }}">Daftar</a>
										</p>
									</div>

									<div class="login-separater text-center mb-4"> <span>Login dengan Email</span>
										<hr/>
									</div>
									<div class="form-body">
										<form action="/authenticating" class="row g-3" method="POST">
											@csrf
											<div class="col-12">
												<label for="email" class="form-label">Email</label>
												<input type="email" class="form-control" id="email" placeholder="Email" name="email">
											</div>
											<div class="col-12">
												<label for="password" class="form-label">Password</label>
												<div class="input-group" id="show_hide_password">
													<input type="password" name="password" class="form-control border-end-0" id="password" placeholder="Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
												</div>
												<div class="contianer mt-3 text-decoration-underline">
													<a href="{{ route('forgotPassword') }}">Forgot Password? <small>(click here)</small></a>
												</div>
											</div>
											{{-- <div class="col-md-12 text-end">
												<a href="authentication-forgot-password.html">Forgot Password ?</a>
											</div> --}}
											<div class="col-12 mt-5">
												<div class="d-grid">
													<button type="submit" class="btn btn-light"><i class="bx bxs-lock-open"></i>Login</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->

	<!--plugins-->
	<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
	</script>
</body>

</html>