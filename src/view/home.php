<div class="container">
    <div class="row g-2">
        <div class="col-8 pt-3">
            <div class="card text-bg-dark lasted-post my-4 mx-auto text-end">
                <img src="<?php echo htmlspecialchars($image ?? false,ENT_QUOTES,'UTF-8')?>" class="card-img" alt="...">
                <div class="card-img-overlay d-flex flex-column justify-content-end">
                    <h5 class="card-title"><?php echo $title ?? null ?></h5>
                    <!-- <p class="card-text "></p> -->
                    <div class="d-flex justify-content-between text-white">
                        <small><i class="bi bi-clock"></i> 3 دقیقه پیش</small>
                        <small><i class="bi bi-person-fill"></i>آرمین غلامی </small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 my-5">
            <div class="d-flex justify-content-center">
                <img class="thumbnail" src="/images/bit.webp" alt="">
            </div>
            <div class="container text-end pt-4">
                <p class="">برنامه‌نویسی وب </p>
                <a class="fs-5" href="">طراحی وب: راهکارهای بهینه برای طراحی وبسایت</a>
            </div>

            <div class="container text-end pt-4">
                <p class=""> برنامه‌نویسی موبایل</p>
                <a class="fs-5" href="">UX/UI: بهترین شیوه‌ها برای طراحی تجربه کاربری</a>
            </div>

            <div class="container text-end pt-4">
                <p class="">هوش مصنوعی</p>
                <a class="fs-5" href="">ابزارها: بهترین ابزارها برای توسعه پروژه‌های هوش مصنوعی</a>
            </div>

        </div>
    </div>
    <hr>
    <!-- all posted laste 3 post -->
    <div class="container">
        <div class="container custom-link">
            <div class="row">
                <div class="col-6">

                    <a class="" href="#">
                        نمایش همه
                    </a>
                </div>
                <div class="col-6">
                    <h4 class="text-end"><strong>جدیدترین مقالات</strong></h4>
                </div>
            </div>
        </div>
        <div class="row g-2 justify-content-end py-4">
            <div class="col-4 py-4">
                <div class="card text-bg-dark">
                    <img src="<?php echo htmlspecialchars('/images/bit.webp',ENT_QUOTES,'UTF-8')?>" class="card-img img-thumb" alt="...">
                    <div class="card-img-overlay">
                        <h5 class="card-title bg-white text-dark text-center w-50">دسته بندی</h5>
                    </div>
                </div>
                <div class="text-end justify-content-end">
                    <a class="text-muted fs-5" href="">راهکارهای بهینه برای طراحی وبسایت</a>
                </div>
            </div>
            <div class="col-4 py-4">
                <div class="card text-bg-dark">
                    <img src="<?php echo htmlspecialchars('/images/Office-planting.jpg',ENT_QUOTES,'UTF-8')?>" class="card-img img-thumb" alt="...">
                    <div class="card-img-overlay">
                        <h5 class="card-title bg-white text-dark text-center w-50">دسته بندی</h5>
                    </div>
                </div>
                <div class="text-end justify-content-end">
                    <a class="text-muted fs-5" href="">راهکارهای بهینه برای طراحی وبسایت</a>
                </div>
            </div>
            <div class="col-4 py-4">
                <div class="card text-bg-dark">
                    <img src="<?php echo htmlspecialchars('/images/three.jpg',ENT_QUOTES,'UTF-8')?>" class="card-img img-thumb" alt="...">
                    <div class="card-img-overlay">
                        <h5 class="card-title bg-white text-dark text-center w-50">دسته بندی</h5>
                    </div>
                </div>
                <div class="text-end justify-content-end">
                    <a class="text-muted fs-5" href="">راهکارهای بهینه برای طراحی وبسایت</a>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <!-- most view -->
    <div class="container py-4">
        <div class="py-4 m-2 text-end">
            <h2>پربازدید ترین ها</h2>
        </div>
        <div class="py-4">
            <div class="card d-flex flex-row-reverse justify-content-end text-end">
                <img src="<?php echo htmlspecialchars('/images/ubuntu18.webp',ENT_QUOTES,'UTF-8')?>" class="card-img-right" alt="تصویر کارت" style="width: 300px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">عنوان کارت</h5>
                    <p class="card-text">توضیحات کارت. این متن می‌تواند توضیحات مختصری درباره‌ی محتوای کارت باشد.</p>
                    <div class="d-flex justify-content-end gap-2">
                        <small><i class="bi bi-clock"></i> 3 دقیقه پیش</small>
                        <small><i class="bi bi-person-fill"></i>آرمین غلامی </small>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-4">
            <div class="card d-flex flex-row-reverse justify-content-end text-end">
                <img src="<?php echo htmlspecialchars('/images/bit.webp',ENT_QUOTES,'UTF-8')?>" class="card-img-right" alt="تصویر کارت" style="width: 300px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">عنوان کارت</h5>
                    <p class="card-text">توضیحات کارت. این متن می‌تواند توضیحات مختصری درباره‌ی محتوای کارت باشد.</p>
                    <div class="d-flex justify-content-end gap-2">
                        <small><i class="bi bi-clock"></i> 3 دقیقه پیش</small>
                        <small><i class="bi bi-person-fill"></i>آرمین غلامی </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>