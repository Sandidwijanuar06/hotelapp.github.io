<?php
  include "../login/controllerlogin.php";
  include "controller/controllerpesan/controller.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Page | Pemesanan</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../layout/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../layout/dist/css/adminlte.min.css">
   <!-- DataTables -->
   <link rel="stylesheet" href="../layout/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../layout/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../layout/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
                Daftar Kamar
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="fas_hotel.php" class="nav-link">
              <i class="nav-icon fas fa-tv"></i>
              <p>
                Daftar Fasilitas Hotel
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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daftar Pemesanan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Daftar Pemesanan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tabel Daftar Pemesanan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama Pemesan</th>
                    <th>Tanggal Pesan</th>
                    <th>Tanggal Check In</th>
                    <th>Tanggal Check Out</th>
                    <th>Nama Kamar</th>
                    <th>Harga Kamar</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      $query = mysqli_query($con,"SELECT * FROM pemesanan");
                      $no = 1;
                      while ($data = mysqli_fetch_array($query)) {
                        $nama_pemesan    = $data['nama_pemesan'];
                        $tgl_pesan       = $data['tgl_pesan'];
                        $tgl_chekin      = $data['tgl_chekin'];
                        $tgl_checkout    = $data['tgl_checkout'];
                        $nama_kamar      = $data['nama_kamar'];
                        $jumlah_pesan    = $data['jumlah_pesan'];
                        $jumlah_menginap = $data['jumlah_menginap'];
                        $status          = $data['status'];
                        $email           = $data['email'];
                        $nohp            = $data['nohp'];
                        $id_kamar        = $data['id_kamar'];
                        $harga_kamar     = $data['harga_kamar'];
                        $id_pesan        = $data['id_pesan'];
                    ?>
                    <tr>
                      <td><?=$no++?></td>
                      <td><?=$nama_pemesan?></td>
                      <td><?= date('d F y', strtotime($tgl_pesan))?></td>
                      <td><?= date('d F y', strtotime($tgl_chekin))?></td>
                      <td><?= date('d F y', strtotime($tgl_checkout))?></td>
                      <td><?=$nama_kamar?></td>
                      <td>Rp<?= number_format($harga_kamar,'0',',','.')?></td>
                      <td>
                        <a href="detail/detail_pesan.php?id=<?=$data['id_pesan']?>" class="btn btn-warning"><i class="fas fa-eye"></i></a>
                      </td>
                    </tr>
                    <?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
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
<!-- DataTables  & Plugins -->
<script src="../layout/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../layout/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../layout/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../layout/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../layout/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../layout/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../layout/plugins/jszip/jszip.min.js"></script>
<script src="../layout/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../layout/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../layout/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../layout/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../layout/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
