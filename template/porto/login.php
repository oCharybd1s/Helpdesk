<!doctype html>
<html class="fixed">

<head>

	<!-- Basic -->
	<meta charset="UTF-8">

	<meta name="keywords" content="HTML5 Admin Template" />
	<meta name="description" content="Porto Admin - Responsive HTML5 Template">
	<meta name="author" content="okler.net">

	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<!-- Web Fonts  -->
	<link href="template/porto/https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

	<!-- Vendor CSS -->
	<link rel="stylesheet" href="template/porto/vendor/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="template/porto/vendor/animate/animate.css">

	<link rel="stylesheet" href="template/porto/vendor/font-awesome/css/all.min.css" />
	<link rel="stylesheet" href="template/porto/vendor/magnific-popup/magnific-popup.css" />
	<link rel="stylesheet" href="template/porto/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

	<!-- Theme CSS -->
	<link rel="stylesheet" href="template/porto/css/theme.css" />

	<!-- Skin CSS -->
	<link rel="stylesheet" href="template/porto/css/skins/default.css" />

	<!-- Theme Custom CSS -->
	<link rel="stylesheet" href="template/porto/css/custom.css">

	<!-- Head Libs -->
	<script src="template/porto/vendor/modernizr/modernizr.js"></script>

</head>

<body>
	<!-- start: page -->
	<section class="body-sign">
		<div class="center-sign">
			<!-- 	<a href="template/porto//" class="logo float-left">
					<img src="template/porto/img/logo.png" height="54" alt="Porto Admin" />
				</a> -->

			<div class="panel card-sign">
				<div class="card-title-sign mt-3 text-right">
					<h2 class="title text-uppercase font-weight-bold m-0"><i class="fas fa-user mr-1"></i> Login</h2>
				</div>
				<div class="card-body">
					<form method="post" id="form-login">
						<div class="form-group mb-3">
							<label>Username</label>
							<div class="input-group">
								<input name="username" id="nik" type="text" class="form-control form-control-lg" />
								<span class="input-group-append">
									<span class="input-group-text">
										<i class="fas fa-user"></i>
									</span>
								</span>
							</div>
						</div>

						<div class="form-group mb-3">
							<div class="clearfix">
								<label class="float-left">Password</label>
							</div>
							<div class="input-group">
								<input name="password" id="password" type="password" class="form-control form-control-lg" />
								<span class="input-group-append">
									<span class="input-group-text">
										<i class="fas fa-lock"></i>
									</span>
								</span>
							</div>
						</div>

						<div class="row">
							<!-- <div class="col-sm-8">
									<div class="checkbox-custom checkbox-default">
										<input id="RememberMe" name="rememberme" type="checkbox"/>
										<label for="RememberMe">Remember Me</label>
									</div>
								</div> -->
							<div class="col-sm-4 text-right">
								<button type="button" name="target" value="login" class="btn btn-primary mt-2" onclick="login()">Masuk</button>
							</div>
						</div>

					</form>
				</div>
			</div>

			<p class="text-center text-muted mt-3 mb-3"></p>
		</div>
	</section>
	<!-- end: page -->

	<!-- Vendor -->
	<script src="template/porto/vendor/jquery/jquery.js"></script>
	<script src="template/porto/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
	<script src="template/porto/vendor/popper/umd/popper.min.js"></script>
	<script src="template/porto/vendor/bootstrap/js/bootstrap.js"></script>
	<script src="template/porto/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="template/porto/vendor/common/common.js"></script>
	<script src="template/porto/vendor/nanoscroller/nanoscroller.js"></script>
	<script src="template/porto/vendor/magnific-popup/jquery.magnific-popup.js"></script>
	<script src="template/porto/vendor/jquery-placeholder/jquery.placeholder.js"></script>

	<!-- Theme Base, Components and Settings -->
	<script src="template/porto/js/theme.js"></script>
	<?php require sis_core('js/autoload.php'); ?>

	<!-- Theme Custom -->
	<!-- <script src="template/porto/js/custom.js"></script> -->

	<!-- Theme Initialization Files -->
	<!-- <script src="template/porto/js/theme.init.js"></script> -->
	<script type="text/javascript">
		$('body').on('click', function(e) {
			if (e.target.name == 'username' || e.target.name == 'password') {} else {
				$('[name="username"]').focus();
			}
		});

		$('[name="username"]').keypress(function(event) {
			if (event.keyCode == 13) {
				$('[name="password"]').focus();
			}
		});
		$('[name="password"]').keypress(function(event) {
			if (event.keyCode == 13) {
				login();
				// $('[name="submit"]').trigger('click');
			}
		});

		function login() {
			var username = $('#nik').val();
			var password = $('#password').val();
			var result = sendPost('Auth', {
				type_submit : 'login',
				username : username,
				password : password,
			});

			if (result.status == 'success') {
				swalLoading(result.message);
				setTimeout(function() {
					page.directTo('/');
				}, 500);
			} else {
				swalMessage(result.message);
			}
		}
	</script>
</body>

</html>