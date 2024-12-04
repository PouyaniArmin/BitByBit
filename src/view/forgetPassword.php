<div class="mx-4">
	<?php

	use App\Utils\CsrfToken;

	if (isset($_SESSION['errors'])): ?>
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<?php foreach ($_SESSION['errors'] as $error): ?>
				<li><?php echo htmlspecialchars($error); ?></li>
			<?php endforeach; ?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
		<?php unset($_SESSION['errors']); ?>
	<?php endif; ?>

</div>
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow" style="width: 100%; max-width: 400px;">
        <div class="text-center mb-4">
            <h4 class="fw-bold text-primary">فراموشی رمز عبور</h4>
            <p class="text-muted">ایمیل خود را وارد کنید تا لینک بازیابی رمز عبور ارسال شود.</p>
        </div>
        <form method="post" action="/forgot-password">
            <!-- CSRF Token -->
            <input type="hidden" name="csrf_token" value="<?php echo CsrfToken::generateToken(); ?>">
            <!-- Email Field -->
            <div class="mb-3 text-end">
                <label for="email" class="form-label mx-3 fw-bold">ایمیل</label>
                <div class="input-group">
                    <input type="email" id="email" name="email" class="form-control">
                </div>
            </div>
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100">ارسال لینک بازیابی</button>
        </form>
        <!-- Back to Login -->
        <div class="text-center mt-3">
            <a href="/login" class="text-decoration-none text-primary">بازگشت به صفحه ورود</a>
        </div>
    </div>
</div>