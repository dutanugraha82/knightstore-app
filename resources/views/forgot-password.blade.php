
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
		<title>Knight Store - Forgot Password</title>
	</head>

<body class="bg-theme bg-dark">
	<!--wrapper-->
	<div class="wrapper">
		<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container-fluid">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
					<div class="col mx-auto">
						<div class="card">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="text-center">
										<h3 class="">Reset Password</h3>
									</div>
									<div class="form-body">
										<form action="{{ route('requestResetPassword') }}" class="row g-3" method="POST">
											@csrf
											<div class="col-12 mt-4">
												<input type="text" class="form-control" placeholder="masukan email anda" name="email">
											</div>
											<div class="text-center">
												<small>Harap periksa email anda yang didaftarkan untuk mendapatkan link reset password setelah halaman memuat!</small>
											</div>
											<div class="col-12 mt-5">
												<div class="d-grid">
													<button type="submit" class="btn btn-light"><i class="bx bxs-key"></i>Send Reset Password Link</button>
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
</body>

</html>