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
<div class="pt-3 text-center">
    <h3 style="color: #4C489D;"><strong> ثبت نام </strong></h3>
</div>
<div class="container-register">
    <div class="screen">
        <div class="screen__content">
            <form class="register" method="post">
                <input type="hidden" name="csrf_token" value="<?php echo CsrfToken::generateToken() ?>">
                <div class="register__field">
                    <i class="register__icon fas fa-user"></i>
                    <input type="text" name="name" class="register__input" placeholder="نام کاربری">
                </div>
                <div class="register__field">
                    <i class="register__icon fas fa-envelope"></i>
                    <input type="text" name="email" class="register__input" placeholder="ایمیل">
                </div>
                <div class="register__field">
                    <i class="register__icon fas fa-lock"></i>
                    <input type="password" name="password" class="register__input" placeholder="رمزعبور">
                </div>
                <div class="register__field">
                    <i class="register__icon fas fa-lock"></i>
                    <input type="password" name="confirmPassword" class="register__input" placeholder="تکرار رمزعبور">
                </div>
                <button class="button register__submit">
                    <span class="button__text">ثبت نام</span>
                    <i class="button__icon fas fa-chevron-right"></i>
                </button>
            </form>
        </div>
        <div class="screen__background">
            <span class="screen__background__shape screen__background__shape3"></span>
            <span class="screen__background__shape screen__background__shape2"></span>
            <span class="screen__background__shape screen__background__shape1"></span>
        </div>
    </div>
</div>
<script>
    // بستن خودکار فلش‌پیام‌ها بعد از 5 ثانیه
    setTimeout(function() {
        let alertNode = document.querySelector('.alert');
        if (alertNode) {
            alertNode.classList.remove('show');
            alertNode.classList.add('fade');
            setTimeout(() => alertNode.remove(), 500); // حذف کامل از DOM پس از fade
        }
    }, 5000); // زمان بستن خودکار بر حسب میلی‌ثانیه
</script>