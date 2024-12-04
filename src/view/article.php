<div class="container" dir="rtl">
    <div class="card text-bg-dark">
        <img src="<?php echo '/' .  htmlspecialchars($post['image']?? null,ENT_QUOTES,'UTF-8') ?>" class="card-img img-fluid custom-img" alt="...">
        <div class="card-img-overlay text-overlay">
            <h1 class="card-title text-center"><?php echo $post['title'] ?? null?></h1>
            <p class="card-text position-absolute bottom-0 start-0 m-2">
                <small>
                    <?php
                    $datetime = new DateTime($created_at ?? false);
                    echo $datetime->format('M j, Y \a\t h:i A');
                    ?>
                </small>
            </p>
        </div>
    </div>
    <hr class="py-3 pt-2">

    <!-- محتوا -->
    <div class="content m-4">
        <?php echo base64_decode($post['content'] ?? null); ?>
    </div>

    <hr>
    <div class="suggested-posts pt-4 py-2">
        <h4 class="py-4">مطالب پیشنهادی</h4>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="<?php echo '/' .htmlspecialchars($image?? false,ENT_QUOTES,'UTF-8') ?>" class="card-img-top featured-img-thumb" alt="...">
                    <div class="card-body">
                        <a href="">
                            <h5 class="card-title">عنوان مطلب پیشنهادی 1</h5>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="<?php echo htmlspecialchars('/images/bit.webp',ENT_QUOTES,'UTF-8')?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">عنوان مطلب پیشنهادی 2</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">عنوان مطلب پیشنهادی 3</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- بخش نظرات -->
    <hr>

    <div class="comments-section py-4">
        <div class="mx-4">
            <?php

            use App\Utils\CsrfToken;

            if (isset($_SESSION['errors'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php foreach ($_SESSION['errors'] as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['errors']); ?>
            <?php endif; ?>

            <h4>نظرات کاربران</h4>
            <!-- فرم ارسال نظر -->
            <form action="/post/<?php echo $post['id'] ?? null ?>" method="POST" class="mt-4">
                <input type="hidden" name="post_id" value="<?php echo $post['id']?? null ?>">
                <input type="hidden" name="csrf_token" value="<?php echo CsrfToken::generateToken() ?>">
                <div class="mb-3">
                    <label for="email" class="form-label">ایمیل شما</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="ایمیل خود را وارد کنید">
                </div>
                <div class="mb-3">
                    <label for="comment" class="form-label">نظر شما</label>
                    <textarea class="form-control" id="comment" name="comment" rows="4" placeholder="نظر خود را وارد کنید"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">ارسال نظر</button>
            </form>

            <hr>
            <!-- لیست نظرات قبلی -->
            <h5 class="mt-4">نظرات قبلی</h5>
            <div class="comment-list mt-3">
                <?php if (isset($comments) && is_array($comments)):?>
                <?php  $i=1;  foreach ($comments as $comment): ?>
                    <div class="comment-item py-2">
                        <h6>کاربر <?php echo $i?> (<?php echo $comment['email']?>)</h6>
                        <p><?php echo $comment['comment']?></p>
                    </div>
                <?php $i++; endforeach; ?>
                <?php endif;?>
            </div>
        </div>
    </div>