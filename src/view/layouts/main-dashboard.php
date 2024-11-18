<!doctype html>
<html lang="fa" dir="rtl">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
  <link rel="stylesheet" href="/style/main-dashboard.css">
  <!-- chart js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!--editor-->
  <script src="https://cdn.tiny.cloud/1/5eh8tkgr02f8fedv3gx83rhqdzfjsrfqqfgsfzt58t18itev/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

  <title>داشبورد</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page">نام کاربر</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/logout">خروج</a>
          </li>
        </ul>
        <span class="navbar-text">
          <strong class="fs-5">
            <a href="">داشبورد</a>
          </strong>
        </span>
      </div>
    </div>
  </nav>

  <main>
    <div class="d-flex py-4">
      <div class="flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
        <ul class="nav nav-pills flex-column mb-auto">
          <li class="nav-item">
            <a href="#" class="nav-link active">داشبورد</a>
          </li>
          <li>
            <a href="#" class="nav-link">پست‌ها</a>
          </li>

          <li>
            <a href="#" class="nav-link">دسته بندی</a>
          </li>
          <li>
            <a href="#" class="nav-link">کاربران</a>
          </li>

          <li>
            <a href="#" class="nav-link">تنظیمات</a>
          </li>
        </ul>
      </div>

      <div class="flex-grow-1 p-3">

        {{content}}
      </div>
    </div>


  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>