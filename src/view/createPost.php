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
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="postTitle" class="form-label">عنوان پست</label>
                            <input type="text" class="form-control" id="postTitle" name="postTitle" placeholder="عنوان پست را وارد کنید">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="category" class="form-label">دسته‌بندی</label>
                            <select name="category_id" id="category" class="form-select">
                                <option value="">انتخاب دسته‌بندی</option>
                                <?php if(isset($categories) && is_array($categories)):?>
                                <?php
                                foreach ($categories as $category) : ?>
                                    <option value="<?php echo $category['id']; ?>">
                                        <?php echo htmlspecialchars($category['category_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                                <?php endif;?>
                            </select>
                        </div>
                    </div>

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
<script src="/js/editor.js"></script>