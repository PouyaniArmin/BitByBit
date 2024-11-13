<div class="container mt-5">
    <h2>ویرایش پست</h2>
    <form action="/dashboard/posts/update" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <input type="hidden" name="id" value="<?php echo $id?>" id="">
            <label for="title" class="form-label">عنوان پست</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>" required>
        </div>
        <div class="mb-3">
            <label for="content-editor" class="form-label">محتوا</label>
            <textarea name="content" id="content-editor">
                <?php echo base64_decode($content); ?>    
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

<script>
    tinymce.init({
        selector: '#content-editor',
        plugins: 'image link code lists',
        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | bullist numlist | code',
        height: 600,
        file_picker_types: 'image',

        forced_root_block: false,
        forced_br_newlines: true,
        forced_p_newlines: false,

        valid_elements: '*[*]',
        cleanup: true,
        file_picker_callback: function(callback, value, meta) {
            if (meta.filetype === 'image') {
                const input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                input.onchange = function() {
                    const file = this.files[0];
                    const reader = new FileReader();

                    reader.onload = function() {
                        callback(reader.result, {
                            alt: file.name
                        });
                    };
                    reader.readAsDataURL(file);
                };
                input.click();
            }
        }
    });
</script>
