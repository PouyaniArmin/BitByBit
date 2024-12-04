<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <link rel="stylesheet" href="/style/main.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <!-- icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
</head>

<body class="d-flex flex-column min-vh-100">
  <nav class="navbar navbar-expand-lg navbar-light py-4">
    <div class="container">
      <a class="navbar-brand" href="#">BitByBit</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" style="font-size: 18px;" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">خانه</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">دسته بندی</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">تماس با ما</a>
          </li>
        </ul>
      </div>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">ثبت نام</a>
          </li>
          <li class="nav-item me-3">
            <a class="nav-link" href="#">ورورد</a>
          </li>
          <li class="nav-item">
          </li>
          <form action="/search" method="GET" class="d-flex" role="search" style="font-size: 0.8rem;">
            <input class="form-control form-control-sm me-2" type="search" name="search" style="width:150px" placeholder="جستجو" aria-label="Search">
            <button class="btn btn-sm btn-outline-primary " style="font-size: 0.8rem;" type="submit">جستجو</button>
          </form>
        </ul>
      </div>
    </div>
  </nav>
  <main class="flex-grow-1 py-2">
    <div class="mx-4">
      <?php

      use App\Utils\FlashMessage;

      if (FlashMessage::hasMessage('errors')):
        $errors = FlashMessage::getMessage('errors'); ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?php foreach ($errors as $error): ?>
            <li><?php echo htmlspecialchars($error); ?></li>
          <?php endforeach; ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>
    </div>
    <div class="mx-4">
      <?php
      if (FlashMessage::hasMessage('success')):
        $messages = FlashMessage::getMessage('success'); ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?php foreach ($messages as $message): ?>
            <li><?php echo htmlspecialchars($message); ?></li>
          <?php endforeach; ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>
    </div>

    {{content}}
  </main>
  <!-- footer -->
  <footer class="bg-dark text-light py-4">
    <div class="container text-center">
      <div class="d-flex justify-content-center mb-3">
        <!-- آیکون‌های شبکه‌های اجتماعی -->
        <a href="#" class="text-light me-3" aria-label="Facebook"><i class="bi bi-facebook fs-4"></i></a>
        <a href="#" class="text-light me-3" aria-label="Twitter"><i class="bi bi-twitter fs-4"></i></a>
        <a href="#" class="text-light me-3" aria-label="Instagram"><i class="bi bi-instagram fs-4"></i></a>
        <a href="#" class="text-light me-3" aria-label="LinkedIn"><i class="bi bi-linkedin fs-4"></i></a>
      </div>
      <div>
        <small>© 2024 تمامی حقوق محفوظ است.</small>
      </div>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
<script src="/js/falshMessage.js"></script>

</html>