<?php
  include "../../login/controllerlogin.php";
  include "../controller/controllerpesan/controller.php";
 
  $id_pesan = $_GET['id'];
  $query = mysqli_query($con,"SELECT * FROM pemesanan WHERE id_pesan='$id_pesan'") or die(mysqli_error($con));
  $sql = mysqli_fetch_array($query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Page | Edit Fasilitas Hotel</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../layout/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../layout/dist/css/adminlte.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../../layout/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../../layout/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../../layout/plugins/jqvmap/jqvmap.min.css">
  <link rel="stylesheet" href="../../layout/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../../layout/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../../layout/plugins/summernote/summernote-bs4.min.css">
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
          <a href="../../profile/profile.php" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../../foto_user/<?php echo $_SESSION['foto_user']; ?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                <?php echo $_SESSION['nama_user']?>
                </h3>
                <p class="text-sm"><?php echo $_SESSION['role'];?></p>
              </div>
            </div>
          </a>
          <hr>
          <a href="../../logout/logout.php" class="dropdown-item dropdown-footer">Logout</a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="../../layout/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">HotelApp</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../foto_user/<?php echo $_SESSION['foto_user']?>" class="img-circle elevation-2" alt="User Image">
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
            <a href="../dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../pemesanan.php" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Daftar Pemesanan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../kamar.php" class="nav-link">
              <i class="nav-icon fas fa-bed"></i>
              <p>
                Daftar Kamar
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../fas_hotel.php" class="nav-link">
              <i class="nav-icon fas fa-tv"></i>
              <p>
                Daftar Fasilitas Hotel
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../daftar_user.php" class="nav-link">
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

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Pemesan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Detail Pemesan</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-user"> Detail Pemesan</i></h3>
            </div>
            <div class="card-body">
            <form action="" method="post">
              <div class="row ml-1"> 
                <div class="form-group">
                  <label for="nama_pemesan">Nama Pemesan</label><br>
                  <input type="text" name="nama_pemesan" class="form-control" value="<?=$sql['nama_pemesan'];?>" readonly>
                  <input type="hidden" name="id_pesan" class="form-control" value="<?=$sql['id_pesan'];?>" readonly>
                  <input type="hidden" name="id_kamar" class="form-control" value="<?=$sql['id_kamar'];?>" readonly>
                </div>
                <div class="form-group ml-2">
                  <label for="tgl_chekin">Tanggal Check In</label>
                  <input class="form-control" type="text" name="tgl_chekin" value="<?= date('d F Y',strtotime($sql['tgl_chekin']))?>" readonly>
                </div>
                <div class="form-group">
                  <label for="tgl_checkout">Tanggal Check Out</label>
                  <input class="form-control" type="text" name="tgl_checkout" value="<?= date('d F Y',strtotime($sql['tgl_checkout']))?>" readonly>
                </div>
                <div class="form-group ml-2">
                  <label for="tgl_pesan">Tanggal Pesan</label>
                  <input class="form-control" type="text" name="tgl_pesan" value="<?= date('d F Y',strtotime($sql['tgl_pesan']))?>" readonly>
                </div>
                <div class="form-group">
                  <label for="nama_kamar">Nama Kamar</label>
                  <input class="form-control" type="text" name="nama_kamar" value="<?=$sql['nama_kamar'];?>" readonly>
                </div>
                <div class="form-group ml-2">
                  <label for="harga_kamar">Harga Kamar</label>
                  <input class="form-control" type="text" name="harga_kamar" value="Rp<?= number_format($sql['harga_kamar'],'0',',','.');?>" readonly>
                </div>
                <div class="form-group">
                  <label for="jumlah_pesan">Jumlah Pesan</label>
                  <input class="form-control" type="text" name="jumlah_pesan" value="<?=$sql['jumlah_pesan'];?> Kamar" readonly>
                </div>
                <div class="form-group ml-2">
                  <label for="jumlah_menginap">Lamanya Menginap</label>
                  <input class="form-control" type="text" name="jumlah_menginap" value="<?=$sql['jumlah_menginap'];?> Malam" readonly>
                </div>
                <div class="form-group">
                  <label for="email">Email Pemesan</label>
                  <input class="form-control" type="text" name="email" value="<?=$sql['email'];?>" readonly>
                </div>
                <div class="form-group ml-2">
                  <label for="nohp">No.handphone/whatsapp</label>
                  <input class="form-control" type="text" name="nohp" value="<?=$sql['nohp'];?>" readonly>
                </div>
                <div class="form-group">
                  <label for="status">Status Saat Ini</label>
                  <input class="form-control" type="text" name="status" value="<?=$sql['status'];?>" readonly>
                </div>
                <div class="form-group ml-2">
                  <?php
                          $total = 0;
                          $total_harga = 0;
                          
                          $total = $sql['harga_kamar'] * $sql['jumlah_menginap'] * $sql['jumlah_pesan'];
                          $total_harga  += $total;
                      ?>
                  <label for="total_harga">Total Harga</label>
                  <input class="form-control" type="text" name="total_harga" value="Rp<?= number_format($total_harga,'0',',','.');?>" readonly>
                </div>
                <?php
                if($sql['status'] == "Pesan"){
                echo'
                  <div class="form-group">
                    <label for="status">Ubah Status</label>
                    <select name="status" class="form-control" required>
                      <option class="" disabled>-PILIH-</option>
                      <option value="Chekin">Check In</option>
                    </select>
                  </div>
                ';
                }
                if($sql['status'] == "Chekin"){
                echo'
                  <div class="form-group">
                    <label for="status">Ubah Status</label>
                    <select name="status" class="form-control" required>
                      <option  class="" disabled>-PILIH-</option>
                      <option value="Checkout">Check Out</option>
                    </select>
                  </div>
                ';
                }
                if($sql['status'] == "Pesan"){
                  echo'
                    <div class="form-gorup ml-2">
                      <label for="aksi">Aksi</label><br>
                      <a href="../pemesanan.php" class="btn btn-danger">Cancel</a>
                      <button class="btn btn-success ml-10" type="submit" name="edit">Update</button>
                    </div>
                  ';
                  }
                if($sql['status'] == "Chekin"){
                  echo'
                    <div class="form-gorup ml-2">
                      <label for="aksi">Aksi</label><br>
                      <a href="../pemesanan.php" class="btn btn-danger">Cancel</a>
                      <button class="btn btn-success ml-10" type="submit" name="edit">Update</button>
                    </div>
                  ';
                  }
                if($sql['status'] == "Checkout"){
                  echo'
                    <div class="form-gorup">
                      <label for="aksi">Aksi</label><br>
                      <a href="cetak.php?id='.$sql['id_pesan'].'" class="btn btn-success"><i class="fas fa-print"> Cetak</i></a>
                      <a href="../pemesanan.php" class="btn btn-danger">Cancel</a>
                    </div>
                  ';
                  }
                ?>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

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
<script src="../../layout/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../layout/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
