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
    <h2>ایجاد دسته‌بندی جدید</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="categoryName" class="form-label">نام دسته‌بندی</label>
            <input type="text" class="form-control" id="categoryName" name="category_name" placeholder="نام دسته‌بندی را وارد کنید">
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
            <?php $i = 1;
            foreach ($data as $item): ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $item['category_name'] ?></td>
                    <td>
                        <a href="/dashboard/category/update/<?php echo $item['id']?>" class="btn btn-warning btn-sm">ویرایش</a>
                        <form action="/dashboard/category/delete/<?php echo $item['id']?>" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $item['id']?>">   
                        <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                        </form>
                    </td>
                </tr>
            <?php $i++;
            endforeach; ?>
            <!-- سایر دسته‌بندی‌ها -->
        </tbody>
    </table>
</div>