<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Giuseppe Galari">

  <title>GiGaCMS</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="/adminlte/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="/adminlte/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="/adminlte/plugins/summernote/summernote-bs4.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="/css/custom.css">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->


    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="/dashboard" class="brand-link">
        <img src="/assets/images/Gigacms-logo-small.png" alt="GiGaCMS Logo" class="elevation-3">
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="/adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?= $_SESSION['user'] ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item menu-open">
              <a href="/dashboard" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard<i class="right fas fa-angle-left"></i></p>
              </a>
            </li>
            <li class="nav-item menu-open">
              <a href="/posts" class="nav-link">
                <i class="nav-icon fas fa-regular fa-file"></i>
                <p>Posts<i class="right fas fa-angle-left"></i></p>
              </a>
            </li>
            <li class="nav-item menu-open">
              <a href="/menus" class="nav-link">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>Menus<i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/menus" class="nav-link">
                    <p>Manage Menus</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/menu-items" class="nav-link">
                    <p>All Menu Items</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item menu-open">
              <a href="/categories" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>Categories<i class="right fas fa-angle-left"></i></p>
              </a>
            </li>
            <li class="nav-item menu-open">
              <a href="/posts" class="nav-link">
                <i class="nav-icon fas fa-tags"></i>
                <p>Tags<i class="right fas fa-angle-left"></i></p>
              </a>
            </li>
            <li class="nav-item menu-open">
              <a href="/posts" class="nav-link">
                <i class="nav-icon fas fa-comments"></i>
                <p>Comments<i class="right fas fa-angle-left"></i></p>
              </a>
            </li>
            <li class="nav-item menu-open">
              <a href="/posts" class="nav-link">
                <i class="nav-icon fas fa-cog"></i>
                <p>Settings<i class="right fas fa-angle-left"></i></p>
              </a>
            </li>
            <li class="nav-item menu-open">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>Users<i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/user-permissions" class="nav-link">
                    <p>User Permissions</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/users" class="nav-link">
                    <p>All Users </p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item menu-open">
              <a href="/logout" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>Logout<i class="right fas fa-angle-left"></i></p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">