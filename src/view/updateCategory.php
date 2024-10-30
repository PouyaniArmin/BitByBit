<div class="container mt-5">
        <h2>ویرایش دسته‌بندی</h2>
        <form action="/update-category/1" method="POST">
            <div class="mb-3">
                <label for="categoryName" class="form-label">نام دسته‌بندی</label>
                <input type="text" class="form-control" id="categoryName" name="categoryName" value="نام فعلی دسته‌بندی" required>
            </div>
            <button type="submit" class="btn btn-success">ذخیره تغییرات</button>
            <a href="/categories" class="btn btn-secondary">بازگشت به لیست دسته‌بندی‌ها</a>
        </form>
    </div>