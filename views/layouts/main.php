<?php 
use app\core\Application;
?>
<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
      <title>Hello, world!</title>
   </head>
   <body>
   <!--
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      
         <div class="container-fluid">
         
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav me-auto mb-2 mb-lg-0">
               <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="/">Home</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="/contact">Contact</a>
               </li>
               <?php if (Application::isGuest()): ?>
               <li class="nav-item">
                  <a class="nav-link" href="/register">Register</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="/login">Login</a>
               </li>
               <?php else: ?>
               <li class="nav-item">
                  <a class="nav-link" href="/profile">Profile</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="/logout">Welcome, <?php echo Application::$app->user->getDisplayName(); ?> (Logout)</a>
               </li>
               <?php endif; ?>
               
            </div>
         </div>
         <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
         
      </nav> -->




      <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-0 py-3">
  <div class="container-xl">
    <!-- Logo -->
    <a class="navbar-brand" href="#">
      <img src="https://preview.webpixels.io/web/img/logos/clever-light.svg" class="h-8" alt="...">
    </a>
    <!-- Navbar toggle -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Collapse -->
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <!-- Nav -->
      <div class="navbar-nav mx-lg-auto">
        <a class="nav-item nav-link" href="/">Home</a>
        <a class="nav-item nav-link" href="/about">About</a>
        <a class="nav-item nav-link" href="/books">Books</a>
        <a class="nav-item nav-link" href="/contact">Contact</a>
        <?php if(Application::hasWritePermission()): ?>
         <a class="nav-item nav-link active" href="/writeArticle">Write article</a>
         <?php endif; ?>
      </div>
      
      <?php if (Application::isGuest()): ?>
      <div class="navbar-nav ms-lg-4">
        <a class="nav-item nav-link" href="/login">Log in</a>
      </div>
      <div class="d-flex align-items-lg-center mt-3 mt-lg-0">
        <a href="/register" class="btn btn-sm btn-primary w-full w-lg-auto">
          Register
        </a>
      </div>
      <?php else: ?>
      <div class="navbar-nav ms-lg-4">
        <a class="nav-item nav-link" href="/logout">Log out</a>
      </div>
      <?php endif; ?>
    </div>
  </div>
</nav>




      <div class="container">
         <?php if (Application::$app->session->getFlash("success")): ?>
            <div class="alert alert-success mt-4">
               <?php echo Application::$app->session->getFlash("success") ?>
            </div>
         <?php endif; ?>
         {{content}}
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
   </body>
</html>

