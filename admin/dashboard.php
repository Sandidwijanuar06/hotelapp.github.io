<?php
  include "../login/controllerlogin.php";

  // Status Chek in
  $query1 = mysqli_query($con,"SELECT * FROM pemesanan WHERE pemesanan.status='chekin'");
  $sql1 = mysqli_num_rows($query1);
  // Status pesan
  $query2 = mysqli_query($con,"SELECT * FROM pemesanan WHERE pemesanan.status='pesan'");
  $sql2 = mysqli_num_rows($query2);
  // Status Chekout
  $query4 = mysqli_query($con,"SELECT * FROM pemesanan WHERE pemesanan.status='checkout'");
  $sql4 = mysqli_num_rows($query4);
  // Jumlah Pemesanan
  $query3 = mysqli_query($con,"SELECT * FROM pemesanan");
  $sql3 = mysqli_num_rows($query3);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Page | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../layout/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../layout/dist/css/adminlte.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../layout/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../layout/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../layout/plugins/jqvmap/jqvmap.min.css">
  <link rel="stylesheet" href="../layout/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../layout/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../layout/plugins/summernote/summernote-bs4.min.css">
  <script type="text/javascript" src="../chartjs/dist/Chart.js"></script>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="../profile/profile.php" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../foto_user/<?php echo $_SESSION['foto_user']; ?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                <?php echo $_SESSION['nama_user']?>
                </h3>
                <p class="text-sm"><?php echo $_SESSION['role'];?></p>
              </div>
            </div>
          </a>
          <hr>
          <a href="../logout/logout.php" class="dropdown-item dropdown-footer">Logout</a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="../layout/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">HotelApp</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../foto_user/<?php echo $_SESSION['foto_user']?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['nama_user']?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pemesanan.php" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Daftar Pemesanan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="kamar.php" class="nav-link">
              <i class="nav-icon fas fa-bed"></i>
              <p>
                Dafatar Kamar
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="fas_hotel.php" class="nav-link">
              <i class="nav-icon fas fa-tv"></i>
              <p>
                Dafatar Fasilitas Hotel
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="daftar_user.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Daftar User
              </p>
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
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?=$sql3?></h3>

                <p>Semua Pemesanan</p>
              </div>
              <div class="icon">
                <i class="fas fa-shopping-cart"></i>
              </div>
              <a href="pemesanan.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?=$sql2?></h3>

                <p>Jumlah Pesan</p>
              </div>
              <div class="icon">
                <i class="fas fa-check"></i>
              </div>
              <a href="pemesanan.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?=$sql1;?></h3>

                <p>Jumlah Check In</p>
              </div>
              <div class="icon">
                <i class="fas fa-calendar-check"></i>
              </div>
              <a href="pemesanan.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?=$sql4?></h3>

                <p>Jumlah Check Out</p>
              </div>
              <div class="icon">
                <i class="fas fa-calendar-minus"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div style="width: 800px; margin: 0px auto;">
        <canvas id="myChart"></canvas>
    </div>
  </div>

  <footer class="main-footer">
    
  <footer class="main-footer">
    <strong>30 Agustus 2022 <a href="https://adminlte.io">Sandi Dwi Januar</a>.</strong> Aplikasi Pemesanan Hotel.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../layout/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../layout/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
  var ctx = document.getElementById("myChart").getContext('2d');

  var myChart = new Chart(ctx, {

    type: 'bar',

    data: {

      labels: ["Semua", "Pesan", "Chekin", "Chekout"],

      datasets: [{

        label: '',

        data: [

        <?php 

        $semua = mysqli_query($con,"SELECT * FROM pemesanan");

        echo mysqli_num_rows($semua);

        ?>, 

        <?php 

        $pesan = mysqli_query($con,"SELECT * FROM pemesanan WHERE status='pesan'");

        echo mysqli_num_rows($pesan);

        ?>, 

        <?php 

        $Chekin = mysqli_query($con,"SELECT * FROM pemesanan WHERE status='Chekin'");

        echo mysqli_num_rows($Chekin);

        ?>, 

        <?php 

        $Checkout = mysqli_query($con,"SELECT * FROM pemesanan where status='Checkout'");

        echo mysqli_num_rows($Checkout);

        ?>

        ],

        backgroundColor: [

        'rgba(255, 99, 132, 0.2)',

        'rgba(54, 162, 235, 0.2)',

        'rgba(255, 206, 86, 0.2)',

        'rgba(75, 192, 192, 0.2)'

        ],

        borderColor: [

        'rgba(255,99,132,1)',

        'rgba(54, 162, 235, 1)',

        'rgba(255, 206, 86, 1)',

        'rgba(75, 192, 192, 1)'

        ],

        borderWidth: 1

      }]

    },

    options: {

      scales: {

        yAxes: [{

          ticks: {

            beginAtZero:true

          }

        }]

      }

    }

  });

</script>
</body>
</html>
