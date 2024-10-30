<div class="container mt-3">
    <div class="row">
        <div class="col-md-12 justify-contetn-center">
            <div class="container mt-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">تعداد پست‌ها</h5>
                        <canvas id="postsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="container mt-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">تعداد کاربران</h5>
                        <canvas id="usersChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
        <div class="container mt-5">
    <div class="card">
        <div class="card-body text-center">
            <h5 class="card-title">بازدیدهای سایت</h5>
            <canvas id="visitsChart" width="500" height="250"></canvas>
        </div>
    </div>
</div>
        </div>
    </div>
</div>
<!-- posts -->
<script>
    var ctx = document.getElementById('postsChart').getContext('2d');
    var postsChart = new Chart(ctx, {
        type: 'bar', // نوع نمودار؛ می‌توانید 'line' یا 'pie' هم انتخاب کنید
        data: {
            labels: ['ژانویه', 'فوریه', 'مارس', 'آوریل', 'می', 'ژوئن'], // ماه‌ها یا برچسب‌های زمانی
            datasets: [{
                label: 'تعداد پست‌ها',
                data: [12, 19, 3, 5, 2, 3], // داده‌های نمونه برای تعداد پست‌ها
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<!-- users -->
<script>
    var ctx = document.getElementById('usersChart').getContext('2d');
    var usersChart = new Chart(ctx, {
        type: 'pie', // نوع نمودار دایره‌ای
        data: {
            labels: ['فعال', 'غیرفعال', 'جدید'], // دسته‌بندی کاربران
            datasets: [{
                label: 'تعداد کاربران',
                data: [120, 45, 30], // تعداد کاربران در هر دسته
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)', // رنگ برای دسته کاربران فعال
                    'rgba(255, 99, 132, 0.2)', // رنگ برای دسته کاربران غیرفعال
                    'rgba(54, 162, 235, 0.2)' // رنگ برای دسته کاربران جدید
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            }
        }
    });
</script>
<!-- site view -->
 <script>
    var ctx = document.getElementById('visitsChart').getContext('2d');
    var visitsChart = new Chart(ctx, {
        type: 'line', // نوع نمودار خطی
        data: {
            labels: ['شنبه', 'یک‌شنبه', 'دوشنبه', 'سه‌شنبه', 'چهارشنبه', 'پنج‌شنبه', 'جمعه'], // روزهای هفته
            datasets: [{
                label: 'بازدیدهای روزانه',
                data: [120, 150, 180, 90, 200, 170, 130], // داده‌های نمونه بازدیدها
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                fill: true, // پر کردن زیر نمودار
                tension: 0.4 // انحنای نمودار
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                }
            }
        }
    });
</script>
