<div class="mx-4">
<?php

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
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ایجاد پست جدید</h5>
            <form  method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="postTitle" class="form-label">عنوان پست</label>
                    <input type="text" class="form-control" id="postTitle" name="postTitle" placeholder="عنوان پست را وارد کنید">
                </div>
                <div class="mb-3">
                    <label for="postImage" class="form-label">بارگذاری تصویر</label>
                    <input type="file" class="form-control" id="postImage" name="postImage" accept="image/*">
                </div>
                <div class="mb-3">
                    <label for="content-editor" class="form-label">محتوا</label>
                    <textarea name="content" id="content-editor">
                    </textarea>
                </div>

                <button type="submit" class="btn btn-primary">ذخیره پست</button>
            </form>
        </div>
    </div>
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