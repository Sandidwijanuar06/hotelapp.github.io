<?php
    if(isset($_POST['edit'])){
        $id_user       = $_POST['id_user'];
        $nama_user     = $_POST['nama_user'];
        $username      = $_POST['username'];
        $password      = $_POST['password'];
        $no_hp         = $_POST['no_hp'];
        $alamat        = $_POST['alamat'];
        $foto_user_old = $_POST['foto_user_old'];
        $nama          = $_FILES['foto_user']['name'];

        $allowed_extension = array('png','jpg');
        $dot      = explode('.',$nama);
        $ekstensi = strtolower(end($dot));
        $ukuran   = $_FILES['foto_user']['size'];
        $file_tmp = $_FILES['foto_user']['tmp_name'];

        $foto_user = md5(uniqid($nama.true) . time()).'.'.$ekstensi;

        $query1 = mysqli_query($con,"UPDATE user SET nama_user='$nama_user',password='$password',username='$username' WHERE user.id_user='$id_user'");
        if($query1){
            echo'
            <script>
            alert("Berhasil Mengubah User");
            window.location.href="daftar_user.php"
            </script>
            '; 
        } else {
            echo'
                <script>
                alert("Gagal Mengubah User");
                window.location.href="daftar_user.php"
                </script>
            '; 
        }
        if(in_array($ekstensi, $allowed_extension) === true ){
            if($ukuran < 500000){
                unlink('../../foto_user/'.$foto_user_old);

                move_uploaded_file($file_tmp, '../../foto_user/'.$foto_user);
                $query = mysqli_query($con,"UPDATE user SET nama_user='$nama_user',foto_user='$foto_user',password='$password',username='$username' WHERE user.id_user='$id_user'");
                if($query){
                    echo'
                        <script>
                        alert("Berhasil Mengubah user");
                        window.location.href="daftar_user.php"
                        </script>
                    ';
                } else {
                    echo'
                        <script>
                        alert("Gagal Mengubah user");
                        window.location.href="daftar_user.php"
                        </script>
                    ';
                }
            } else {
                echo'
                    <script>
                        alert("Ukuran terlalu besar");
                        window.location.href="daftar_user.php"
                    </script>
                ';
            }
        } else {
            echo'
            <script>
                alert("Foto harus berupa PNG/JPG");
                window.location.href="daftar_user.php"
            </script>
        ';
        }
    }

    if(isset($_POST['register'])){
        $nama_user   = $_POST['nama_user'];
        $username  = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $alamat = $_POST['alamat'];
        $no_hp   = $_POST['no_hp'];
        $foto_user         = $_FILES['foto_user']['name'];

        $allowed_extension = array('png','jpg');
        $dot      = explode('.',$foto_user);
        $ekstensi = strtolower(end($dot));
        $ukuran   = $_FILES['foto_user']['size'];
        $file_tmp = $_FILES['foto_user']['tmp_name'];

        $foto_user = md5(uniqid($foto_user.true) . time()).'.'.$ekstensi;

        $cek = mysqli_query($con,"SELECT * FROM user WHERE username='$username'");

        $data = mysqli_num_rows($cek);
        if($data<1){
            if(in_array($ekstensi, $allowed_extension) === true ){
                if($ukuran < 500000) {
                    move_uploaded_file($file_tmp, '../foto_user/'.$foto_user);
                    $query = mysqli_query($con, "INSERT INTO user (nama_user,username,password,foto_user,no_hp,role,alamat) VALUES ('$nama_user','$username','$password','$foto_user','$no_hp','$role','$alamat')");
                    if($query){
                        echo'
                         <script>
                            alert("Berhasil menambahkan User");
                            window.location.href="../login.php"
                            </script>
                        ';
                    }
                } else {
                    echo'
                    <script>
                        alert("Ukuran terlalu besar");
                        window.location.href="../login.php"
                    </script>
                ';
                }
            } else {
                echo'
                <script>
                    alert("Foto harus berupa PNG/JPG");
                    window.location.href="../login.php"
                </script>
            ';
            }
        } else {
            echo'
                <script>
                    alert("Username yang anda masukan sudah terdaftar");
                    window.location.href="../login.php"
                </script>
            ';
        }
    }
?>