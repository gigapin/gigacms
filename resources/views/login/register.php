<?php include '../resources/views/templates/auth.php' ?>

<?php include '../resources/views/partials/errors.php' ?>

<div class="register-box">
	<div class="card card-outline card-primary">
		<div class="card-header text-center">
			<img src="/assets/images/Gigacms-logo-small.png" alt="Gigacms Logo">
		</div>
		<div class="card-body">
			<p class="login-box-msg">Register a new membership</p>

			<form action="/signup" method="POST">
				<input type="hidden" name="_token" value="<?= $token ?>">
				<div class="input-group mb-3">
					<input type="text" class="form-control" placeholder="Name" name="name">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-user"></span>
						</div>
					</div>
				</div>
				<div class="input-group mb-3">
					<input type="text" class="form-control" placeholder="User name" name="username">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-user"></span>
						</div>
					</div>
				</div>
				<div class="input-group mb-3">
					<input type="email" class="form-control" placeholder="Email" name="email">
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
				<div class="input-group mb-3">
					<input type="password" class="form-control" placeholder="Retype password" name="password-confirm">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock"></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="icheck-primary">
							<input type="checkbox" id="agreeTerms" name="terms" value="agree">
							<label for="agreeTerms">
								I agree to the <a href="#">Terms and Conditions</a>
							</label>
						</div>
					</div>
				</div>
				<div class="row mt-2 mb-2">
					<!-- /.col -->
					<div class="col-12">
						<button type="submit" class="btn btn-primary btn-block">Register</button>
					</div>
					<!-- /.col -->
				</div>
			</form>

			<!-- <div class="social-auth-links text-center">
				<a href="#" class="btn btn-block btn-primary">
					<i class="fab fa-facebook mr-2"></i>
					Sign up using Facebook
				</a>
				<a href="#" class="btn btn-block btn-danger">
					<i class="fab fa-google-plus mr-2"></i>
					Sign up using Google+
				</a>
			</div> -->

			<a href="/login" class="text-center">I already have a membership</a>
		</div>
		<!-- /.form-box -->
	</div><!-- /.card -->
</div>
<!-- /.register-box -->

<?php include '../resources/views/templates/footer-auth.php' ?>