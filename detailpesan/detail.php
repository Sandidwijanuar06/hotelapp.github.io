<?php
    include "../login/controllerlogin.php";
    $id_pesan = $_GET['id'];
    $query = mysqli_query($con,"SELECT * FROM pemesanan WHERE pemesanan.id_pesan='$id_pesan'");
    $data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
    <title>Booking Invoice</title>
    <style>
      body {
        font-family: Arial, Helvetica, sans-serif;
        line-height: 24px;
      }
      table {
        width: 100%;
        border-collapse: collapse;
      }
      table td {
        vertical-align: top;
      }
      .header h1 {
        font-size: xx-large;
      }
      .nota {
        margin-top: 20px;
      }
      .nota th,
      .nota td {
        padding: 10px;
        border-bottom: 1px solid #cccccc;
        text-align: center;
      }
      .nota thead tr {
        background-color: #dddddd;
      }
    </style>
  </head>
  <body>
    <!-- ./Regeister -->

    <table  id="example1" class="table table-bordered table-striped nota">
      <h1>Booking Detail</h1>
      <div class="row ml-1 mt-5">  
        <div class="col-sm-2">
            Harga Perkamar:
            <input type="text" class="form-control" value="Rp.<?= number_format($data['harga_kamar'],'0',',','.')?>" disabled>
        </div>
      </div>
      <br>
      <thead>
        <tr>
          <th style="width: 5px;">No.</th>
          <th>Nama Kamar</th>
          <th>Jumlah Pesan</th>
          <th>Lamanya</th>
          <th>Nama Pemesan</th>
          <th>Tgl Checkin</th>
          <th>Tgl Checkout</th>
          <th>Tgl Pesan</th>
          <th>Nohp/wa</th>
          <th>email</th>
          <th>Total Harga</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $total = 0;
          $total_harga = 0;
          
          $total = $data['harga_kamar'] * $data['jumlah_menginap'] * $data['jumlah_pesan'];
          $total_harga  += $total;
        ?>
        <tr>
          <td>1.</td>
          <td><?=$data['nama_kamar'];?></td>
          <td><?=$data['jumlah_pesan'];?> Kamar.</td>
          <td><?=$data['jumlah_menginap'];?> Malam</td>
          <td><?=$data['nama_pemesan']?></td>
          <td><?=$data['tgl_chekin']?></td>
          <td><?=$data['tgl_checkout']?></td>
          <td><?=$data['tgl_pesan']?></td>
          <td><?=$data['nohp']?></td>
          <td><?=$data['email']?></td>
          <td>Rp. <?= number_format($total,'2',',','.')?></td>
        </tr>
      </tbody>
    </table>
    <!-- ./Nota -->
    <p>
      <i>Terimakasih telah melakukan reservasi dihotel kami.</i>
    </p>
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
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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

