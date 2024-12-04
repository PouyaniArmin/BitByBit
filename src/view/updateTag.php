<div class="container mt-5">
    <h2>ویرایش تگ</h2>
    <form action="/dashboard/tag/updated" method="POST">
        <input type="hidden" name="id" value="<?php echo $id ?? null ?>">
        <div class="mb-3">
            <label for="tagName" class="form-label">نام تگ</label>
            <input type="text" class="form-control" id="tagName" name="tag_name" value="<?php echo $tag_name ?? null  ?>" required>
        </div>
        <button type="submit" class="btn btn-success">ذخیره تغییرات</button>
        <a href="/categories" class="btn btn-secondary">بازگشت به لیست تگ‌ها</a>
    </form>
</div>