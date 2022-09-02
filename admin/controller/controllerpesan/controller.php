<?php
    if(isset($_POST['tambah'])){
        $id_kamar        = $_POST['id_kamar'];
        $nama_pemesan    = $_POST['nama_pemesan'];
        $harga_kamar     = $_POST['harga_kamar'];
        $tgl_chekin      = $_POST['tgl_chekin'];
        $tgl_checkout    = $_POST['tgl_checkout'];
        $jumlah_pesan    = $_POST['jumlah_pesan'];
        $nama_kamar      = $_POST['nama_kamar'];
        $email           = $_POST['email'];
        $nohp            = $_POST['nohp'];
        $tgl_pesan       = $_POST['tgl_pesan'];
        $jumlah_menginap = $_POST['jumlah_menginap'];


        if($tgl_chekin > date('Y-m-d')){
            $query = mysqli_query($con,"INSERT INTO pemesanan (id_kamar,nama_pemesan,harga_kamar,tgl_chekin,tgl_pesan,tgl_checkout,jumlah_pesan,nama_kamar,email,nohp,jumlah_menginap)
            VALUES ('$id_kamar','$nama_pemesan','$harga_kamar','$tgl_chekin','$tgl_pesan','$tgl_checkout','$jumlah_pesan','$nama_kamar','$email','$nohp','$jumlah_menginap')");
            $id = mysqli_insert_id($con);    
            if($query){
                echo"
                    <script>
                    alert('Berhasil Pesan');
                    window.location.href='../detailpesan/detail.php?id=".$id."'
                    </script>
                ";
            } else {
                echo'
                    <script>
                    alert("Gagal Pesan");
                    window.location.href="booking.php"
                    </script>
                ';
            }
        } else {
            echo'
                <script>
                alert("Tanggal Chekin Harus setelah Tanggal sebelumnya");
                window.location.href="booking.php"
                </script>
            ';
        }
        
    }   

    if(isset($_POST['edit'])){
        $id_pesan     = $_POST['id_pesan'];
        $id_kamar     = $_POST['id_kamar'];
        $jumlah_pesan = $_POST['jumlah_pesan'];
        $status       = $_POST['status'];
        
        $cek = mysqli_query($con, "SELECT * FROM kamar WHERE kamar.id_kamar='$id_kamar'");
        $data = mysqli_fetch_array($cek);
        $jumlahawal = $data['jumlah_kamar'];

        if($jumlahawal >= $jumlah_pesan){

            // jika cukup
            $jumlahakhir = $jumlahawal - $jumlah_pesan;
            $jumlah_pesan = $jumlah_pesan;
            $query1 = mysqli_query($con,"UPDATE pemesanan SET status='$status' WHERE pemesanan.id_pesan='$id_pesan'");
            $query2 = mysqli_query($con,"UPDATE kamar SET jumlah_kamar='$jumlahakhir' WHERE kamar.id_kamar='$id_kamar'");
            if($query1&&$query2){
                echo"
                <script>
                alert('Berhasil Update Status');
                window.location.href='detail_pesan.php?id=".$id_pesan."'
                </script>
            ";
            } else {
                echo"
                <script>
                alert('Gagal Update Status');
                window.location.href='detail_pesan.php?id=".$id_pesan."'
                </script>
            ";
            }
        } else {
            echo"
                <script>
                alert('Stok Kamar Tidak Cukup');
                window.location.href='detail_pesan.php?id=".$id_pesan."'
                </script>
            ";
        } 
        if($status=="Checkout"){
            $jumlahakhir = $jumlahawal + $jumlah_pesan;
            $jumlah_pesan =$jumlah_pesan;
            $query2 = mysqli_query($con,"UPDATE kamar SET jumlah_kamar='$jumlahakhir' WHERE kamar.id_kamar='$id_kamar'");
            if($query2){
                echo"
                    <script>
                    alert('Berhasil CheckOut');
                    window.location.href='detail_pesan.php?id=".$id_pesan."'
                    </script>
                ";
            } else {
                echo"
                    <script>
                    alert('Gagal CheckOut');
                    window.location.href='detail_pesan.php?id=".$id_pesan."'
                    </script>
                ";
            }
        }  
    }
?>