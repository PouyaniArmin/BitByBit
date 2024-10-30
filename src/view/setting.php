<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تنظیمات</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>تنظیمات</h2>
        <form action="/save-settings" method="POST">

            <!-- تنظیمات عمومی -->
            <h4>تنظیمات عمومی</h4>
            <div class="mb-3">
                <label for="siteTitle" class="form-label">عنوان سایت</label>
                <input type="text" class="form-control" id="siteTitle" name="siteTitle" value="عنوان فعلی سایت" required>
            </div>
            <div class="mb-3">
                <label for="siteDescription" class="form-label">توضیحات سایت</label>
                <textarea class="form-control" id="siteDescription" name="siteDescription" rows="3" required>توضیحات فعلی سایت</textarea>
            </div>
            <div class="mb-3">
                <label for="siteLogo" class="form-label">بارگذاری لوگو</label>
                <input type="file" class="form-control" id="siteLogo" name="siteLogo" accept="image/*">
                <small class="form-text text-muted">اگر لوگویی بارگذاری نکنید، لوگوی قبلی حفظ خواهد شد.</small>
            </div>

            <!-- تنظیمات کاربران -->
            <h4>تنظیمات کاربران</h4>
            <div class="mb-3">
                <label for="userRoles" class="form-label">مدیریت نقش‌ها</label>
                <select class="form-select" id="userRoles" name="userRoles">
                    <option value="admin">مدیر</option>
                    <option value="editor">نویسنده</option>
                    <option value="subscriber">کاربر عادی</option>
                </select>
            </div>

            <!-- تنظیمات نمایش -->
            <h4>تنظیمات نمایش</h4>
            <div class="mb-3">
                <label for="theme" class="form-label">انتخاب تم</label>
                <select class="form-select" id="theme" name="theme">
                    <option value="light">روشن</option>
                    <option value="dark">تیره</option>
                </select>
            </div>

            <!-- تنظیمات SEO -->

            <button type="submit" class="btn btn-primary">ذخیره تنظیمات</button>
        </form>
    </div>
</body>
</html>
