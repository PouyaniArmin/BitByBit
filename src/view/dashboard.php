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
    var postData = <?php echo json_encode($posts, JSON_UNESCAPED_UNICODE); ?>;

    var months = [];
    var postCounts = [];

    postData.forEach(function(post) {
        months.push(post.month); 
        postCounts.push(post.post_count); 
    });

    var ctx = document.getElementById('postsChart').getContext('2d');
    var postsChart = new Chart(ctx, {
        type: 'bar', 
        data: {
            labels: months, 
            datasets: [{
                label: 'تعداد پست‌ها',
                data: postCounts,
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
    var userStats = <?php echo json_encode($users, JSON_UNESCAPED_UNICODE); ?>;

    var verifiedCount = 0;
    var unverifiedCount = 0;
    userStats.forEach(function(stat) {
        if (stat.is_email_verified == 1) {
            verifiedCount = stat.total; 
        } else if (stat.is_email_verified == 0) {
            unverifiedCount = stat.total; 
        }
    });
    var ctx = document.getElementById('usersChart').getContext('2d');
    var usersChart = new Chart(ctx, {
        type: 'pie', 
        data: {
            labels: ['تایید شده', 'تایید نشده'], 
            datasets: [{
                label: 'تعداد کاربران',
                data: [verifiedCount, unverifiedCount], 
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 99, 132, 0.2)' 
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)'
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
    var visitStats = <?php echo json_encode($vists, JSON_UNESCAPED_UNICODE); ?>;

var labels = [];
var data = [];
visitStats.forEach(function(stat) {
    labels.push(stat.date); 
        data.push(stat.views);  
});
var ctx = document.getElementById('visitsChart').getContext('2d');
var visitsChart = new Chart(ctx, {
    type: 'line', 
    data: {
        labels: labels, 
        datasets: [{
            label: 'بازدیدهای روزانه',
            data: data, 
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 2,
            fill: true, 
            tension: 0.4 
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