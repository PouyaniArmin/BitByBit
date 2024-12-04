	<?php

	use App\Utils\CsrfToken; ?>
	<div class="pt-3 text-center">
		<h3 style="color: #4C489D;;"><strong> Login </strong></h3>
	</div>
	<div class="container-login">
		<div class="screen">
			<div class="screen__content">
				<form class="login" method="post">
					<input type="hidden" name="csrf_token" value="<?php echo CsrfToken::generateToken() ?>">
					<div class="login__field">
						<i class="login__icon fas fa-user"></i>
						<input type="text" name="email" class="login__input" placeholder="Email">
					</div>
					<div class="login__field">
						<i class="login__icon fas fa-lock"></i>
						<input type="password" name="password" class="login__input" placeholder="Password">
					</div>
					<button class="button login__submit">
						<span class="button__text">Login</span>
						<i class="button__icon fas fa-chevron-right"></i>
					</button>
				</form>
				<!-- Forgot Password Link -->
				<div class="text-end mt-3 mx-2">
					<a href="forgot-password" class="btn btn-link text-decoration-none p-0 text-primary fw-bold text-danger">
						<i class="fas fa-question-circle me-1"></i> فراموشی رمز عبور؟
					</a>
				</div>

			</div>
			<div class="screen__background">
				<span class="screen__background__shape screen__background__shape3"></span>
				<span class="screen__background__shape screen__background__shape2"></span>
				<span class="screen__background__shape screen__background__shape1"></span>
			</div>
		</div>
	</div>