
<div class="container mt-5">
    <h2>ویرایش پست</h2>
    <form action="/update-post/1" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">عنوان پست</label>
            <input type="text" class="form-control" id="title" name="title" value="عنوان فعلی پست" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">محتوا</label>
            <textarea class="form-control" id="content" name="content" rows="5" required>متن فعلی پست</textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">تصویر پست</label>
            <input type="file" class="form-control" id="image" name="image">
            <small class="form-text text-muted">اگر تصویری بارگذاری نکنید، تصویر قبلی حفظ خواهد شد.</small>
        </div>
        <button type="submit" class="btn btn-success">ذخیره تغییرات</button>
        <a href="/posts" class="btn btn-secondary">بازگشت به لیست پست‌ها</a>
    </form>
</div>