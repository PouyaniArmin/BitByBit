   <?php use App\Utils\CsrfToken;?>
   <div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-4">ویرایش پروفایل</h5>
            <form action="/dashboard/users/updated" method="post" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?php echo CsrfToken::generateToken() ?? false?>">
                <input type="hidden" name="id" value="<?php echo $id ?? null ?>">
                <div class="mb-3">
                    <label for="username" class="form-label">نام کاربری</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $name ?? null ;?>" placeholder="عنوان پست را وارد کنید" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">ایمیل</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email ?? null ;?>" placeholder="ایمیل خود را وارد کنید" required>
                    </div>
                    <div class="form-text text-muted">لطفاً یک ایمیل معتبر وارد کنید.</div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                    <a href="#" class="btn btn-secondary">بازگشت</a>
                </div>
            </form>
        </div>
    </div>
</div>
