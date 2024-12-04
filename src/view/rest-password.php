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
<div class="container mt-5 text-end">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-primary text-white">
                    <h4>بازنشانی رمز عبور</h4>
                </div>
                <div class="card-body">
                    <form action="/process-reset-password" method="POST">
                        <!-- CSRF Token -->
                        <input type="hidden" name="csrf_token" value="<?php echo CsrfToken::generateToken()?>">
                        <input type="hidden" name="id" value="<?php echo $id ?? null ?>">
                        
                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">رمز عبور جدید</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="رمز عبور جدید خود را وارد کنید" >
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">تأیید رمز عبور</label>
                            <input type="password" name="confirmPassword" id="confirm_password" class="form-control" placeholder="رمز عبور جدید خود را تأیید کنید" >
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">بازنشانی رمز عبور</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>