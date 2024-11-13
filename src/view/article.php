<div class="container" dir="rtl">
    <div class="card text-bg-dark">
        <img src="<?php echo $image ?>" class="card-img img-fluid custom-img" alt="...">
        <div class="card-img-overlay text-overlay">
            <h1 class="card-title text-center"><?php echo $title ?></h1>
            <p class="card-text position-absolute bottom-0 start-0 m-2">
                <small>
                    <?php 
                    $datetime = new DateTime($created_at);
                    echo $datetime->format('M j, Y \a\t h:i A'); 
                    ?>
                </small>
            </p>
        </div>
    </div>
    <hr class="py-3 pt-2">
    
    <!-- محتوا -->
    <div class="content m-4">
        <?php echo base64_decode($content); ?>
    </div>

   <hr>
    <div class="suggested-posts pt-4 py-2">
        <h4 class="py-4">مطالب پیشنهادی</h4>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="<?php echo $image?>" class="card-img-top featured-img-thumb" alt="...">
                    <div class="card-body">
                        <a href=""><h5 class="card-title">عنوان مطلب پیشنهادی 1</h5></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="image2.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">عنوان مطلب پیشنهادی 2</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="image3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">عنوان مطلب پیشنهادی 3</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
