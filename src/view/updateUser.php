  <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">ایجاد پست جدید</h5>
                <form action="/save-post" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="postTitle" class="form-label">عنوان پست</label>
                        <input type="text" class="form-control" id="postTitle" name="postTitle" placeholder="عنوان پست را وارد کنید" required>
                    </div>
                    <div class="mb-3">
                        <label for="postImage" class="form-label">بارگذاری تصویر</label>
                        <input type="file" class="form-control" id="postImage" name="postImage" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="postContent" class="form-label">محتوای پست</label>
                        <textarea id="postContent" name="postContent" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">ذخیره پست</button>
                </form>
            </div>
        </div>
    </div>