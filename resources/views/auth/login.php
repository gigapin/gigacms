<?php include '../resources/views/templates/auth.php' ?>

<?php include '../resources/views/partials/errors.php' ?>

<div class="login-box">
	<!-- /.login-logo -->
	<div class="card card-outline card-primary">
		<div class="card-header text-center">
			<a href="/" class="h1"><b>GiGaCMS</b></a>
		</div>
		<div class="card-body">
			<p class="login-box-msg">Sign in to start your session</p>

			<form action="/sign-in" method="post">
				<input type="hidden" name="_token" value="<?= isset($token) ? $token : "" ?>">
				<div class="input-group mb-3">
					<input type="email" class="form-control" id="email-login" placeholder="Email" name="email" focus>
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-envelope"></span>
						</div>
					</div>
				</div>
				<div class="input-group mb-3">
					<input type="password" class="form-control" placeholder="Password" name="password">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock"></span>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- <div class="col-8">
						<div class="icheck-primary">
							<input type="checkbox" id="remember">
							<label for="remember">
								Remember Me
							</label>
						</div>
					</div> -->
					<!-- /.col -->
					<div class="col-12 mb-2">
						<button type="submit" class="btn btn-primary btn-block">Sign In</button>
					</div>
					<!-- /.col -->
				</div>
			</form>

			<!-- <div class="social-auth-links text-center mt-2 mb-3">
				<a href="#" class="btn btn-block btn-primary">
					<i class="fab fa-facebook mr-2"></i> Sign in using Facebook
				</a>
				<a href="#" class="btn btn-block btn-danger">
					<i class="fab fa-google-plus mr-2"></i> Sign in using Google+
				</a>
			</div> -->
			<!-- /.social-auth-links -->

			<!-- <p class="mb-1">
				<a href="forgot-password.html">I forgot my password</a>
			</p> -->
			<p class="mb-0">
				<a href="/register" class="text-center">Register a new membership</a>
			</p>
		</div>
		<!-- /.card-body -->
	</div>
	<!-- /.card -->
</div>
<!-- /.login-box -->

<?php include '../resources/views/templates/footer-auth.php' ?>