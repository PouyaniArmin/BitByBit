<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>لیست پست‌ها</h3>
        <a href="/dashboard/posts/create" class="btn btn-primary">ایجاد پست جدید</a>

    </div>

    <div class="list-group">
        <?php if (isset($data)&& is_array($data)) :?>
        <?php foreach ($data as $items): ?>
            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1"><?php echo $items['title'] ?></h5>
                    <small class="text-muted">تاریخ: <?php echo date('d F Y', strtotime($items['created_at'])) ?></small>
                </div>
                <div>
                    <span class="badge bg-primary rounded-pill">بازدید: ۱۵۰</span>
                    <span class="badge bg-success rounded-pill">وضعیت: منتشر شده</span>
                </div>
                <div>
                    <a href="/dashboard/posts/update/<?php echo $items['id'] ?>" class="btn btn-sm btn-secondary me-2">ویرایش</a>
                    <!-- <form action="/dashboard/posts/update/<?php echo $items['id'] ?>" method="get" style="display: inline;">
                        <button type="submit" class="btn btn-sm btn-secondary me-2">ویرایش</button>
                    </form> -->
                    <form action="/dashboard/posts/delete" method="post" style="display: inline;">
                        <input type="hidden" name="id" value="<?php echo $items['id'] ?>">
                        <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                    </form>

                </div>
            </div>
        <?php endforeach; ?>
        <?php endif;?>
    </div>
</div>