<?php
    include "../login/controllerlogin.php";
    include "../admin/controller/controllerpesan/controller.php";

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>ROYAL HOTEL | Booking</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Favicons -->
        <link href="img/favicon.ico" rel="icon">
        <link href="img/apple-favicon.png" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet"> 

        <!-- Vendor CSS File -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="vendor/slick/slick.css" rel="stylesheet">
        <link href="vendor/slick/slick-theme.css" rel="stylesheet">
        <link href="vendor/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

        <!-- Main Stylesheet File -->
        <link href="css/hover-style.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>
        <!-- Header Section Start -->
        <header id="header">
            <a href="index.php" class="logo"><img src="img/logo.jpg" alt="logo"></a>
            <div class="phone"><i class="fa fa-phone"></i>+1 234 567 8900</div>
            <div class="mobile-menu-btn"><i class="fa fa-bars"></i></div>
            <nav class="main-menu top-menu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="room.php">Rooms</a></li>
                    <li><a href="amenities.php">Amenities</a></li>
                    <li class="active"><a href="booking.php">Booking</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                </ul>
            </nav>
        </header>
        <!-- Header Section End -->
        
        <!-- Booking Section Start -->
        <div id="booking">
            <div class="container">
                <div class="section-header">
                    <h2>Booking Kamar</h2>
                    <p>
                        Jika anda ingin booking kamar dihotel kami silahkan isi data dibawah ini dengan lengkap dan benar!
                    </p>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="booking-form">
                            <div id="success"></div>
                            <form method="post" novalidate="novalidate">
                                <div class="form-row">
                                    <div class="control-group col-md-6">
                                        <label>Nama Lengkap</label>
                                        <input type="text" class="form-control" id="fname" placeholder="Nama Lengkap" name="nama_pemesan" required="required" data-validation-required-message="Mohon masukan nama anda" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group col-md-6">
                                        <label>Jumlah menginap</label>
                                        <input type="number" class="form-control" id="lname" placeholder="Berapa malam akan menginap" name="jumlah_menginap" required="required" data-validation-required-message="Mohon masukan jumlah menginap" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="control-group col-md-6">
                                        <label>No.Handhpone/Whatsapp</label>
                                        <input type="number" class="form-control" id="mobile" placeholder="No.handphone/whatsapp" name="nohp" required="required" data-validation-required-message="Mohon Masukan no handphone/whatsapp anda" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group col-md-6">
                                        <label>Email</label>
                                        <input type="email" class="form-control"  placeholder="email" name="email" required="required" data-validation-required-message="Mohon Masukan email" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="control-group col-md-6">
                                        <label>Check-In</label>
                                        <input type="date" class="form-control" id="date-1"  required="required" name="tgl_chekin" data-validation-required-message="Mohon masukan tanggal chekin"/>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group col-md-6">
                                        <label>Check-Out</label>
                                        <input type="date" class="form-control" id="date-2"  required="required" name="tgl_checkout" data-validation-required-message="Mohon masukan tanggal checkout"/>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="control-group col-md-6">
                                        <label>Pilih Kamar</label>
                                        <select name="nama_kamar" class="form-control" onchange='changeValue(this.value)' id="nama_kamar" required>
                                            <option value="pilih" readonly>-PiLIH-</option>
                                            <?php
                                            $query = mysqli_query($con,"SELECT * FROM kamar order by nama_kamar esc");
                                            $result = mysqli_query($con,"SELECT * FROM kamar");
                                            $data1 = "var harga_kamar = new Array();\n;";
                                            $data2 = "var id_kamar = new Array();\n;";
                                            while ($row = mysqli_fetch_array($result)) {
                                                echo '<option name="nama_kamar" value="'.$row['nama_kamar'] . '">' . $row['nama_kamar'] . '</option>';
                                                $data1 .= "harga_kamar['" . $row['nama_kamar'] . "'] = {harga_kamar:'" .  addslashes($row['harga_kamar'])."'};\n";  
                                                $data2 .= "id_kamar['" . $row['nama_kamar'] . "'] = {id_kamar:'" .  addslashes($row['id_kamar'])."'};\n";  
                                                }  
                                            ?>
                                        </select>
                                    </div>
                                    <div class="control-group col-md-6">
                                        <label>Harga Kamar</label>
                                        <input type="number" class="form-control" name="harga_kamar" id="harga_kamar" placeholder="Harga_kamar" required readonly />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group col-md-6">
                                        <label>Jumlah Pesan</label>
                                        <input type="number" class="form-control" name="jumlah_pesan" placeholder="Jumlah pesan kamar" required/>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group col-md-6">
                                        <label>Tanggal Pesan</label>
                                        <input type="date" class="form-control" id="date-2"  required="required" name="tgl_pesan" data-validation-required-message="Mohon masukan tanggal Pesan"/>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group col-md-6">
                                        <input type="hidden" class="form-control" name="id_kamar" id="id_kamar" placeholder="Id kamar"  readonly required/>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>

                                <div class="button">
                                    <button type="submit" name="tambah" >Booking</button>
                                </div>
                                <script type="text/javascript">
                                <?php
                                    echo $data1;
                                    echo $data2;
                                ?>
                                function changeValue(id){
                                    document.getElementById('harga_kamar').value = harga_kamar[id].harga_kamar;
                                    document.getElementById('id_kamar').value = id_kamar[id].id_kamar;
                                };
                                </script>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Booking Section End -->
        
        <!-- Footer Section Start -->
        <div id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="social">
                            <a href=""><li class="fa fa-instagram"></li></a>
                            <a href=""><li class="fa fa-twitter"></li></a>
                            <a href=""><li class="fa fa-facebook-f"></li></a>
                        </div>
                    </div>
                    <div class="col-12">
                        <p>Copyright &#169; 2045 <a href="">Your Site Name</a> All Rights Reserved.</p>
						
						<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
						<p>Designed By <a href="https://htmlcodex.com">HTML Codex</a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Section End -->
        
        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

        <!-- Vendor JavaScript File -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/jquery/jquery-migrate.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/easing/easing.min.js"></script>
        <script src="vendor/stickyjs/sticky.js"></script>
        <script src="vendor/superfish/hoverIntent.js"></script>
        <script src="vendor/superfish/superfish.min.js"></script>
        <script src="vendor/wow/wow.min.js"></script>
        <script src="vendor/slick/slick.min.js"></script>
        <script src="vendor/tempusdominus/js/moment.min.js"></script>
        <script src="vendor/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="vendor/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
        
        <!-- Booking Javascript File -->
        <script src="js/booking.js"></script>
        <script src="js/jqBootstrapValidation.min.js"></script>
  
        <!-- Main Javascript File -->
        <script src="js/main.js"></script>
    </body>
</html>
