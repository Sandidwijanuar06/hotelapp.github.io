<?php

    if(isset($_POST['tambahfashotel'])){
        $nama_fasilitas   = $_POST['nama_fasilitas'];
        $kualitas_fas_hotel  = $_POST['kualitas_fas_hotel'];
        $keterangan = $_POST['keterangan'];
        $foto_fas_hotel         = $_FILES['foto_fas_hotel']['name'];

        $allowed_extension = array('png','jpg');
        $dot      = explode('.',$foto_fas_hotel);
        $ekstensi = strtolower(end($dot));
        $ukuran   = $_FILES['foto_fas_hotel']['size'];
        $file_tmp = $_FILES['foto_fas_hotel']['tmp_name'];

        $foto_fas_hotel = md5(uniqid($foto_fas_hotel.true) . time()).'.'.$ekstensi;

        $cek = mysqli_query($con,"SELECT * FROM fasilitas_hotel WHERE nama_fasilitas='$nama_fasilitas'");

        $data = mysqli_num_rows($cek);
        if($data<1){
            if(in_array($ekstensi, $allowed_extension) === true ){
                if($ukuran < 5000000) {
                    move_uploaded_file($file_tmp, '../../foto_fas_hotel/'.$foto_fas_hotel);
                    $query = mysqli_query($con, "INSERT INTO fasilitas_hotel (nama_fasilitas, kualitas_fas_hotel, foto_fas_hotel, keterangan) VALUES ('$nama_fasilitas', '$kualitas_fas_hotel', '$foto_fas_hotel', '$keterangan')");
                    if($query){
                        echo'
                         <script>
                            alert("Berhasil menambahkan fasilitas");
                            window.location.href="../fas_hotel.php"
                            </script>
                        ';
                    }
                } else {
                    echo'
                    <script>
                        alert("Ukuran terlalu besar");
                        window.location.href="../fas_hotel.php"
                    </script>
                ';
                }
            } else {
                echo'
                <script>
                    alert("Foto harus berupa PNG/JPG");
                    window.location.href="../fas_hotel.php"
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
        $id_fas_hotel       = $_POST['id_fas_hotel'];
        $kualitas_fas_hotel = $_POST['kualitas_fas_hotel'];
        $nama_fasilitas     = $_POST['nama_fasilitas'];
        $keterangan         = $_POST['keterangan'];
        $foto_fas_hotel_old = $_POST['foto_fas_hotel_old'];
        $nama               = $_FILES['foto_fas_hotel']['name'];

        $allowed_extension = array('png','jpg');
        $dot      = explode('.',$nama);
        $ekstensi = strtolower(end($dot));
        $ukuran   = $_FILES['foto_fas_hotel']['size'];
        $file_tmp = $_FILES['foto_fas_hotel']['tmp_name'];

        $foto_fas_hotel = md5(uniqid($nama.true) . time()).'.'.$ekstensi;

        $query1 = mysqli_query($con,"UPDATE fasilitas_hotel SET nama_fasilitas='$nama_fasilitas',keterangan='$keterangan',kualitas_fas_hotel='$kualitas_fas_hotel' WHERE fasilitas_hotel.id_fas_hotel='$id_fas_hotel'");
        if($query1){
            echo'
            <script>
            alert("Berhasil Mengubah fasilitas");
            window.location.href="../fas_hotel.php"
            </script>
            '; 
        } else {
            echo'
                <script>
                alert("Gagal Mengubah fasilitas");
                window.location.href="../fas_hotel.php"
                </script>
            '; 
        }
        if(in_array($ekstensi, $allowed_extension) === true ){
            if($ukuran < 500000){
                unlink('../../foto_fas_hotel/'.$foto_fas_hotel_old);

                move_uploaded_file($file_tmp, '../../foto_fas_hotel/'.$foto_fas_hotel);
                $query = mysqli_query($con,"UPDATE fasilitas_hotel SET nama_fasilitas='$nama_fasilitas',foto_fas_hotel='$foto_fas_hotel',keterangan='$keterangan',kualitas_fas_hotel='$kualitas_fas_hotel' WHERE fasilitas_hotel.id_fas_hotel='$id_fas_hotel'");
                if($query){
                    echo'
                        <script>
                        alert("Berhasil Mengubah fasilitas");
                        window.location.href="../fas_hotel.php"
                        </script>
                    ';
                } else {
                    echo'
                        <script>
                        alert("Gagal Mengubah fasilitas");
                        window.location.href="../fas_hotel.php"
                        </script>
                    ';
                }
            } else {
                echo'
                    <script>
                        alert("Ukuran terlalu besar");
                        window.location.href="../fas_hotel.php"
                    </script>
                ';
            }
        } else {
            echo'
            <script>
                alert("Foto harus berupa PNG/JPG");
                window.location.href="../fas_hotel.php"
            </script>
        ';
        }
    }

    if(isset($_GET['foto_fas_hotel'])){
        $id_fas_hotel   = $_GET['id_fas_hotel'];
        $foto_fas_hotel = $_GET['foto_fas_hotel'];

        $select = mysqli_query($con,"SELECT * FROM fasilitas_hotel WHERE fasilitas_hotel.id_fas_hotel='$id_fas_hotel'");
        $sql = mysqli_fetch_array($select);

        unlink('./../foto_fas_hotel/'.$sql['foto_fas_hotel']);
        $query1 = mysqli_query($con,"DELETE FROM fasilitas_hotel WHERE fasilitas_hotel.id_fas_hotel='$id_fas_hotel'");
           
        if($query1){
            echo'
            <script>
            alert("Berhasil Hapus fasilitas");
            window.location.href="fas_hotel.php"
            </script>
            '; 
        } else {
            echo'
                <script>
                alert("Gagal Hapus fasilitas");
                window.location.href="fas_hotel.php"
                </script>
            '; 
        }
    }
?>