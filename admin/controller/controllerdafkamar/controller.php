<?php

    if(isset($_POST['tambah'])){
        $nama_kamar   = $_POST['nama_kamar'];
        $harga_kamar  = $_POST['harga_kamar'];
        $jumlah_kamar = $_POST['jumlah_kamar'];
        $keterangan   = $_POST['keterangan'];
        $nama         = $_FILES['foto_kamar']['name'];

        $allowed_extension = array('png','jpg');
        $dot      = explode('.',$nama);
        $ekstensi = strtolower(end($dot));
        $ukuran   = $_FILES['foto_kamar']['size'];
        $file_tmp = $_FILES['foto_kamar']['tmp_name'];

        $foto_kamar = md5(uniqid($nama.true) . time()).'.'.$ekstensi;

        $cek = mysqli_query($con,"SELECT * FROM kamar WHERE nama_kamar='$nama_kamar'");

        $data = mysqli_num_rows($cek);
        if($data<1){
            if(in_array($ekstensi, $allowed_extension) === true ){
                if($ukuran < 500000) {
                    move_uploaded_file($file_tmp, '../../foto_kamar/'.$foto_kamar);
                    $query = mysqli_query($con, "INSERT INTO kamar (nama_kamar,harga_kamar,jumlah_kamar,foto_kamar,keterangan) VALUES ('$nama_kamar','$harga_kamar','$jumlah_kamar','$foto_kamar','$keterangan')");
                    if($query){
                        echo'
                         <script>
                            alert("Berhasil menambahkan kamar");
                            window.location.href="../kamar.php"
                            </script>
                        ';
                    }
                } else {
                    echo'
                    <script>
                        alert("Ukuran terlalu besar");
                        window.location.href="../kamar.php"
                    </script>
                ';
                }
            } else {
                echo'
                <script>
                    alert("Foto harus berupa PNG/JPG");
                    window.location.href="../kamar.php"
                </script>
            ';
            }
        } else {
            echo'
                <script>
                    alert("Nama yang anda masukan sudah terdaftar");
                    window.location.href="../kamar.php"
                </script>
            ';
        }
    }

    if(isset($_POST['edit'])){
        $id_kamar       = $_POST['id_kamar'];
        $nama_kamar     = $_POST['nama_kamar'];
        $jumlah_kamar   = $_POST['jumlah_kamar'];
        $harga_kamar    = $_POST['harga_kamar'];
        $foto_kamar_old = $_POST['foto_kamar_old'];
        $nama           = $_FILES['foto_kamar']['name'];

        $allowed_extension = array('png','jpg');
        $dot      = explode('.',$nama);
        $ekstensi = strtolower(end($dot));
        $ukuran   = $_FILES['foto_kamar']['size'];
        $file_tmp = $_FILES['foto_kamar']['tmp_name'];

        $foto_kamar = md5(uniqid($nama.true) . time()).'.'.$ekstensi;

        $query1 = mysqli_query($con,"UPDATE kamar SET nama_kamar='$nama_kamar',harga_kamar='$harga_kamar',jumlah_kamar='$jumlah_kamar' WHERE kamar.id_kamar='$id_kamar'");
        if($query1){
            echo'
            <script>
            alert("Berhasil Mengubah kamar");
            window.location.href="../kamar.php"
            </script>
            '; 
        } else {
            echo'
                <script>
                alert("Gagal Mengubah kamar");
                window.location.href="../kamar.php"
                </script>
            '; 
        }
        if(in_array($ekstensi, $allowed_extension) === true ){
            if($ukuran < 500000){
                unlink('../../foto_kamar/'.$foto_kamar_old);

                move_uploaded_file($file_tmp, '../../foto_kamar/'.$foto_kamar);
                $query = mysqli_query($con,"UPDATE kamar SET nama_kamar='$nama_kamar',foto_kamar='$foto_kamar',harga_kamar='$harga_kamar',jumlah_kamar='$jumlah_kamar' WHERE kamar.id_kamar='$id_kamar'");
                if($query){
                    echo'
                        <script>
                        alert("Berhasil Mengubah kamar");
                        window.location.href="../kamar.php"
                        </script>
                    ';
                } else {
                    echo'
                        <script>
                        alert("Gagal Mengubah kamar");
                        window.location.href="../kamar.php"
                        </script>
                    ';
                }
            } else {
                echo'
                    <script>
                        alert("Ukuran terlalu besar");
                        window.location.href="../kamar.php"
                    </script>
                ';
            }
        } else {
            echo'
            <script>
                alert("Foto harus berupa PNG/JPG");
                window.location.href="../kamar.php"
            </script>
        ';
        }
    }

    if(isset($_GET['foto_kamar'])){
        $id_kamar   = $_GET['id_kamar'];
        $foto_kamar = $_GET['foto_kamar'];

        $select = mysqli_query($con,"SELECT * FROM kamar WHERE kamar.id_kamar='$id_kamar'");
        $sql = mysqli_fetch_array($select);

        unlink('./../foto_kamar/'.$sql['foto_kamar']);
        $query1 = mysqli_query($con,"DELETE FROM kamar WHERE kamar.id_kamar='$id_kamar'");
           
        if($query1){
            echo'
            <script>
            alert("Berhasil Hapus kamar");
            window.location.href="kamar.php"
            </script>
            '; 
        } else {
            echo'
                <script>
                alert("Gagal Hapus kamar");
                window.location.href="kamar.php"
                </script>
            '; 
        }
    }

    if(isset($_POST['tambahfas'])){
        $id_kamar           = $_POST['id_kamar'];
        $nama_fasilitas     = $_POST['nama_fasilitas'];
        $kualitas_fas_kamar = $_POST['kualitas_fas_kamar'];

        $query = mysqli_query($con,"INSERT INTO fasilitas_kamar (id_kamar,nama_fasilitas,kualitas_fas_kamar) VALUES ('$id_kamar','$nama_fasilitas','$kualitas_fas_kamar')");
        if($query){
            echo"
                <script>
                alert('Berhasil menambahkan fasilitas');
                window.location.href='../detail/fas_kamar.php?id=$id_kamar'
                </script>
            "; 
        } else {
            echo"
            <script>
            alert('Gagal menambahkan fasilitas');
            window.location.href='../detail/fas_kamar.php?id=$id_kamar'
            </script>
        "; 
        }
    }

    if(isset($_POST['editfas'])){
        $id_fas_kamar       = $_POST['id_fas_kamar'];
        $id_kamar           = $_POST['id_kamar'];
        $nama_fasilitas     = $_POST['nama_fasilitas'];
        $kualitas_fas_kamar = $_POST['kualitas_fas_kamar'];

        $cek = mysqli_query($con,"SELECT * FROM fasilitas_kamar WHERE nama_fasilitas='$nama_fasilitas'");
        $sql = mysqli_fetch_array($cek);

        if($sql<1){
            $query = mysqli_query($con,"UPDATE fasilitas_kamar SET nama_fasilitas='$nama_fasilitas',kualitas_fas_kamar='$kualitas_fas_kamar' WHERE fasilitas_kamar.id_fas_kamar='$id_fas_kamar'");
            if($query){
                echo"
                    <script>
                    alert('Berhasil Mengubah fasilitas');
                    window.location.href='../detail/fas_kamar.php?id=$id_kamar'
                    </script>
                "; 
            } else {
                echo"
                    <script>
                    alert('Gagal Mengubah fasilitas');
                    window.location.href='../detail/fas_kamar.php?id=$id_kamar'
                    </script>
                "; 
            }
        } else {
            echo"
                <script>
                alert('Nama fasilitas yang dimasukan sudah terdaftar!');
                window.location.href='edit_fas_kamar.php?id=$id_fas_kamar'
                </script>
            "; 
        }
    }

    if(isset($_POST['deletefas'])){
        $id_fas_kamar = $_POST['id_fas_kamar'];
        $id_kamar     = $_POST['id_kamar'];

        $query = mysqli_query($con,"DELETE FROM fasilitas_kamar WHERE fasilitas_kamar.id_fas_kamar='$id_fas_kamar'");
        if($query){
            echo"
                <script>
                alert('Berhasil Menghapus fasilitas');
                window.location.href='fas_kamar.php?id=$id_kamar'
                </script>
            "; 
        } else {
            echo"
                <script>
                alert('Gagal Menghapus fasilitas');
                window.location.href='fas_kamar.php?id=$id_kamar'
                </script>
            "; 
        }
    }
?>