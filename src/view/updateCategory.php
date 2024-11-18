<div class="container mt-5">
    <h2>ویرایش دسته‌بندی</h2>
    <form action="/dashboard/category/updated" method="POST">
        <input type="hidden" name="id" value="<?php echo $id?>">
        <div class="mb-3">
            <label for="categoryName" class="form-label">نام دسته‌بندی</label>
            <input type="text" class="form-control" id="categoryName" name="category_name" value="<?php echo $category_name ?>" required>
        </div>
        <button type="submit" class="btn btn-success">ذخیره تغییرات</button>
        <a href="/categories" class="btn btn-secondary">بازگشت به لیست دسته‌بندی‌ها</a>
    </form>
</div>