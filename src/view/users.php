<div class="container mt-5">
    <h2>لیست کاربران</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">نام کاربر</th>
                <th scope="col">ایمیل</th>
                <th scope="col">سمت</th>
                <th scope="col">عملیات</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>علی</td>
                <td>ali@example.com</td>
                <td>مدیر</td>
                <td>
                    <a href="/edit-user/1" class="btn btn-warning btn-sm">ویرایش</a>
                    <a href="/delete-user/1" class="btn btn-danger btn-sm">حذف</a>
                </td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>سارا</td>
                <td>sara@example.com</td>
                <td>نویسنده</td>
                <td>
                    <a href="/edit-user/2" class="btn btn-warning btn-sm">ویرایش</a>
                    <a href="/delete-user/2" class="btn btn-danger btn-sm">حذف</a>
                </td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>مهدی</td>
                <td>mahdi@example.com</td>
                <td>مدیر</td>
                <td>
                    <a href="/edit-user/3" class="btn btn-warning btn-sm">ویرایش</a>
                    <a href="/delete-user/3" class="btn btn-danger btn-sm">حذف</a>
                </td>
            </tr>
            <!-- ادامه لیست کاربران -->
        </tbody>
    </table>

    <!-- Pagination -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">قبلی</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">بعدی</a>
            </li>
        </ul>
    </nav>
</div>
