<div class="container mt-5">
    <h2>ویرایش پست</h2>
    <form action="/dashboard/posts/update" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <input type="hidden" name="id" value="<?php echo $id ?? null ?>" id="">
            <label for="title" class="form-label">عنوان پست</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $title?? null; ?>" required>
        </div>
        <div class="mb-3">
            <label for="content-editor" class="form-label">محتوا</label>
            <textarea name="content" id="content-editor">
                <?php echo base64_decode($content ?? false); ?>    
            </textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">تصویر پست</label>
            <input type="file" class="form-control" id="image" name="image">
            <small class="form-text text-muted">اگر تصویری بارگذاری نکنید، تصویر قبلی حفظ خواهد شد.</small>
        </div>
        <button type="submit" class="btn btn-success">ذخیره تغییرات</button>
        <a href="/dashboard/posts" class="btn btn-secondary">بازگشت به لیست پست‌ها</a>
    </form>
</div>

<script src="/js/editor.js"></script>