<?php 
session_start();
require '../database.php';
require '../templates/functions.php';

if (!isset($_SESSION['isUserLoggedIn'])){
  header('Location:index.php');
  exit();
}

$admin = getAdminInfo($conn, $_SESSION['admin_email']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>StreamlineMinds Admin Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">


  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">StreamlineMinds</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?=$admin['full_name']?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?=$admin['full_name']?></h6>
              <span>Web Developer</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>


            <li>
              <a class="dropdown-item d-flex align-items-center" href="../templates/logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid"></i>
          <span>Add Post</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="index.php">
        <i class="bi bi-list-ol"></i>
          <span>Manage Post</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <!-- <i class="bi bi-grid"></i> -->
          <i class="bi bi-file-post"></i>
          <span>Manage Category</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <!-- <i class="bi bi-grid"></i> -->
          <i class="bi bi-postcard-fill"></i>
          <span>Add Post</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link " href="index.php">
                  <i class="bi bi-kanban"></i>

          <span>Statistics</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link " href="index.php">
          
          <span>Blog Theme</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link " href="index.php">
        
          <span>Profile Settings</span>
        </a>
      </li>

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

   

<div class="col-lg-12">
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Add Post</h5>

    <div class="panel-body ">
      <div class="form">
      <form action="../templates/add-post.php" method="post" class="container-fluid" enctype="multipart/form-data">


          <div class="form-group">
            <div class="col-sm-12">
              <input placeholder="Enter the title of the post" type="text" class="form-control" name="post_title">
            </div><br>            
          </div>

          <div class="form-group">
            <textarea placeholder="Enter the post content" class="tinymce-editor" name="post_content">
                
            </textarea><br>
          </div>

          
          <div class="row mb-3 col-sm-12">
          <?php 
                      $categories = getAllCategoryName($conn);
                      ?>
                  <label class="col-sm-2 col-form-label">Select</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="post_category">

                      <option selected>Select Post Category</option>
                      
                      <?php
                      foreach ($categories as $category){
                        ?>
                          <option value="<?=$category['category_id']?>"><?=$category['category_name']?></option>

                        
                        <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3 col-sm-12">
                  <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                  <div class="col-sm-10">
                  <input class="form-control" type="file" id="formFile" name="image[]" accept="image/*" multiple>

                  </div>
                  <br><br>

                  <div class="col-sm-10">
                    <button type="submit" name="addpost" class="btn btn-primary">Add Post</button>
                  </div>
        </form>
      </div>
    </div>
    

  </div>
</div>

</div>

  </main><!-- End #main -->

  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>@ankman</span></strong>. All Rights Reserved
    </div>

  </footer>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>