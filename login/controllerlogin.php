<?php
    session_start();

    $con = mysqli_connect('localhost','root','','aplikasihotel');

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = mysqli_query($con,"SELECT * FROM user WHERE username='$username' AND password='$password'");
        $hitung = mysqli_num_rows($query);

        if($hitung>0){
            $data = mysqli_fetch_array($query);

            // jikaadmin
            if($data['role']=="Admin") {
                $_SESSION['nama_user'] = $data['nama_user'];
                $_SESSION['username']  = $data['username'];
                $_SESSION['password']  = $data['password'];
                $_SESSION['foto_user'] = $data['foto_user'];
                $_SESSION['no_hp']     = $data['no_hp'];
                $_SESSION['alamat']    = $data['alamat'];
                $_SESSION['role']      = $data['role'];

                header('location:admin/dashboard.php');
             // jika resepsionis
            } elseif($data['role']=="Resepsionis") {
                $_SESSION['id_user']   = $data['id_user'];
                $_SESSION['nama_user'] = $data['nama_user'];
                $_SESSION['username']  = $data['username'];
                $_SESSION['password']  = $data['password'];
                $_SESSION['foto_user'] = $data['foto_user'];
                $_SESSION['no_hp']     = $data['no_hp'];
                $_SESSION['alamat']    = $data['alamat'];
                $_SESSION['role']      = $data['role'];

                header('location:resepsionis/dashboard.php');
            } else {
                echo'
                    <script>
                        alert("Gagal Login");
                        window.location.href="login.php"
                    </script>
                ';
            }
        } else {
            echo'
            <script>
                alert("Gagal Login");
                window.location.href="login.php"
            </script>
        ';
        }
    }

?>