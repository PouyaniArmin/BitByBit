<div class="container" dir="rtl">

    <h1 class="mb-4 pt-4 py-4">نتایج</h1>

    <?php if (isset($result) && is_array($result)): ?>
        <ul class="list-group">
            <?php foreach ($result as $item): ?>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-2">
                            <?php echo $item['title'] ?>
                        </div>
                        <div class="col-9">

                            <p class="text-truncate"><?php
                                                        $decodedContent = base64_decode($item['content']);
                                                        $content = mb_convert_encoding($decodedContent, 'UTF-8', 'auto');
                                                        $content = strip_tags($content);
                                                        echo $content; ?>
                            </p>
                        </div>
                        <div class="col-1">

                            <p><a href="/post/<?php echo $item['id'] ?>"> نمایش </a></p>
                        </div>
                    </div>

                </li>
            <?php endforeach ?>
        </ul>
    <?php endif;
    if (is_array($result) && count($result) <= 0): ?>
        <div class="container text-center mt-5">
        <div role="alert">
            <h4 class="alert-heading">نتیجه‌ای یافت نشد!</h4>
            <p>متأسفیم، جستجوی شما هیچ نتیجه‌ای برنگرداند.</p>
            <hr>
            <p class="mb-0">لطفاً عبارت دیگری را امتحان کنید.</p>
        </div>
    </div>
    <?php endif; ?>
</div>