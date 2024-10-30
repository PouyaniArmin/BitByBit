<div class="container mt-5">
        <h2>ایجاد دسته‌بندی جدید</h2>
        <form action="/save-category" method="POST">
            <div class="mb-3">
                <label for="categoryName" class="form-label">نام دسته‌بندی</label>
                <input type="text" class="form-control" id="categoryName" name="categoryName" placeholder="نام دسته‌بندی را وارد کنید" required>
            </div>
            <button type="submit" class="btn btn-primary">ایجاد دسته‌بندی</button>
        </form>

        <h3 class="mt-5">لیست دسته‌بندی‌ها</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>نام دسته‌بندی</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>دسته‌بندی اول</td>
                    <td>
                        <a href="/edit-category/1" class="btn btn-warning btn-sm">ویرایش</a>
                        <form action="/delete-category/1" method="POST" style="display:inline;">
                            <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>دسته‌بندی دوم</td>
                    <td>
                        <a href="/edit-category/2" class="btn btn-warning btn-sm">ویرایش</a>
                        <form action="/delete-category/2" method="POST" style="display:inline;">
                            <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                        </form>
                    </td>
                </tr>
                <!-- سایر دسته‌بندی‌ها -->
            </tbody>
        </table>
    </div>