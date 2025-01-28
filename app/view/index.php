<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php require_once("../config/config.php"); ?>
        <?php $setting = $koneksi->query("SELECT * FROM setting")->fetch_array(); ?>
        <title><?php echo $setting['nama'] . " Dashboard" ?></title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link rel="stylesheet" href="preloader.css">
        <link rel="stylesheet" href="<?php echo base_url('dist/css/style-enfold.css') ?>">
        <script crossorigin="anonymous" lang="javascript">
        $(document).ready(function() {
            $(".preloader").fadeOut();
        })
        </script>
        <style type="text/css">
        /*---------------------------
        Preloader Area CSS Code  
        ----------------------------*/

        .card-body {
            padding: 10px 30px 20px;
        }

        /* ---Navbar--- */
        .warna-dark {
            background-color: #2a2b3d;
        }

        .navbar {
            border-bottom: 7px solid salmon;
        }

        .nav-item a:hover {
            background-color: #FCF234;
            transition: 0.5s;
            border-radius: 5px;
        }

        .text-white2 {
            color: #33383b;
        }

        .nav-item .text-white2:hover {
            color: black;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: turquoise;
            transition: 0.5s;
        }

        /* ---carousel--- */
        .carousel-item img {
            height: 520px;
            margin-top: 90px;
            text-transform: uppercase;
            font-family: 'Raleway', sans-serif;
            min-height: 20%;
        }

        .carousel-item h5 {
            font-weight: bold;
        }

        .carousel-item img {
            margin-top: 10px;
        }

        /* ---img-grid--- */
        .mgt50px {
            margin-top: 50px;
        }

        .box-1 {
            font-family: "lato", sans-serif;
        }

        .display {
            border-collapse: collapse;
            overflow: hidden;
            width: 100%;
            border-collapse: collapse;
            /*  border: 1px black solid;*/
            color: white;
        }

        .display td {
            color: black;
        }

        .display .shadow-tr {
            box-shadow: 0px 0px 9px 0px rgba(0, 0, 0, 0.1);
            font-size: 12px;
        }

        .display th {
            background-color: #398B93;
            text-align: center;
        }

        .display1 {
            border-collapse: collapse;
            overflow: hidden;
            width: 100%;
            border-collapse: collapse;
            /*  border: 1px black solid;*/
            color: white;
        }

        .display1 td {
            color: black;
            font-size: 9px;
        }

        .display1 .shadow-tr {
            box-shadow: 0px 0px 9px 0px rgba(0, 0, 0, 0.1);
            font-size: 12px;
        }

        .display1 th {
            background-color: #398B93;
            text-align: center;
        }

        /*pembeda */
        .works-section {
            padding: 3em 0;
            background: #F5F5F5;
        }

        .works-header {
            text-align: center;
            width: 85%;
            margin: 0 auto;
        }

        .works-header h3 {
            font-size: 2.5em;
            font-family: 'Arvo', serif;
            text-transform: uppercase;
            font-weight: 400;
            color: #ef664d;
        }

        .works-header h3 span {
            color: #fefefe;
        }

        .works-header p {
            line-height: 1.5em;

            font-size: 15px;
            color: #fefefe;
            padding: 25px 0;
        }

        .row .coloumn {
            margin: 0 10px;
            position: relative;
            width: calc(25% - 20px);
            min-height: 250px;
            background: #fff;
            float: left;
            box-sizing: border-box;
            overflow: hidden;
        }

        .row .coloumn:before {
            content: '';
            position: absolute;
            bottom: -100%;
            left: 0;
            width: 100%;
            height: 100%;
            background: #262626;
            z-index: 1;
            transition: .5s;
            mix-blend-mode: soft-light;
        }

        .row .coloumn:hover:before {
            bottom: 0;
        }

        .row .coloumn .imgBox {
            position: relative;
        }

        .row .coloumn .imgBox img {
            width: 100%;
            -webkit-transition: all .5s;
            -moz-transition: all .5s;
            -o-transition: all .5s;
            transition: all .5s;
        }

        .row .coloumn:hover .imgBox img {
            -ms-transform: scale(1.2);
            -moz-transform: scale(1.2);
            -webkit-transform: scale(1.2);
            -o-transform: scale(1.2);
            transform: scale(1.2);
        }

        .row .coloumn .details {
            position: absolute;
            bottom: -85px;
            left: 0;
            padding: 10px;
            box-sizing: border-box;
            background: rgba(0, 0, 0, .9);
            width: 100%;
            transition: .5s;
            z-index: 2;
        }

        .bannerimg {
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            background-position: center;
            background-size: cover;
            min-height: 550px;
        }

        .row .coloumn:hover .details {
            bottom: 0;
        }

        .row .coloumn .details h3 {
            margin-right: 25px;
            margin-top: 2px;
            padding: 5px 10px 0 0;
            color: #fff;
            font-weight: 500;
            text-align: right;
            text-transform: uppercase;
        }

        .row .coloumn .details h3 span {
            margin-right: 3px;
            margin-top: 2px;
            padding: 0;
            font-size: 14px;
            color: #8cd91a;
            font-weight: 900;
            text-transform: uppercase;
            position: relative;
            top: -6px;
        }

        .row .coloumn .details ul {
            margin: 0;
            padding: 0;
            direction: flex;
            float: right;
        }

        /*sidebar*/
        .logo-sidebar img {
            /*margin-top: 100px;*/
            padding-top: 115px;
            width: 100%;
            height: auto;
            border-radius: 50%;
        }

        .wrapper .header {
            z-index: 1;
            background: #22242A;
            position: fixed;
            width: calc(100% - 0%);
            height: 70px;
            display: flex;
            top: 0;
        }

        .wrapper .header .header-menu {
            width: calc(100% - 0%);
            height: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .wrapper .header .header-menu .title {
            color: #fff;
            font-size: 25px;
            text-transform: uppercase;
            font-weight: 900;
        }

        .wrapper .header .header-menu .title span {
            color: #4CCEE8;
            text-decoration: none;
        }

        .wrapper .header .header-menu .sidebar-btn {
            color: #fff;
            position: absolute;
            margin-left: 280px;
            font-size: 22px;
            font-weight: 900;
            cursor: pointer;
            transition: 0.3s;
            transition-property: color;
        }

        .wrapper .header .header-menu .sidebar-btn:hover {
            color: #4CCEE8;
        }

        .wrapper .header .header-menu ul {
            display: flex;
        }

        .wrapper .header .header-menu ul li a {
            background: #fff;
            color: #000;
            display: block;
            margin: 0 10px;
            font-size: 18px;
            width: 34px;
            height: 34px;
            line-height: 35px;
            text-align: center;
            border-radius: 50%;
            transition: 0.3s;
            transition-property: background, color;
            text-decoration: none;
        }

        .wrapper .header .header-menu ul li a:hover {
            background: #4CCEE8;
            color: #fff;
        }

        .wrapper .sidebar {
            z-index: 1;
            margin-top: -70px;
            background: #2F323A;
            position: fixed;
            top: 70px;
            width: 250px;
            height: 100%;
            transition: 0.3s;
            transition-property: width;
            overflow-y: auto;
        }

        .wrapper .sidebar .sidebar-menu {
            overflow: hidden;
        }

        .wrapper .sidebar .sidebar-menu .profile img {
            margin: 20px 0;
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }

        .wrapper .sidebar .sidebar-menu .profile p {
            color: #bbb;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .wrapper .sidebar .sidebar-menu .item {
            width: 250px;
            overflow: hidden;
        }

        .wrapper .sidebar .sidebar-menu .item .menu-btn {
            display: block;
            color: #fff;
            position: relative;
            padding: 15px 20px;
            transition: 0.3s;
            transition-property: color;
            text-decoration: none;
        }

        .wrapper .sidebar .sidebar-menu .item .menu-btn:hover {
            color: #4CCEE8;
        }

        .wrapper .sidebar .sidebar-menu .item .menu-btn i {
            margin-right: 20px;
        }

        .wrapper .sidebar .sidebar-menu .item .menu-btn .drop-down {
            float: right;
            font-size: 12px;
            margin-top: 3px;
        }

        .wrapper .sidebar .sidebar-menu .item .sub-menu {
            background: #3498DB;
            overflow: hidden;
            max-height: 0;
            transition: 0.3s;
            transition-property: background, max-height;
            text-decoration: none;
        }

        .wrapper .sidebar .sidebar-menu .item .sub-menu a {
            display: block;
            position: relative;
            color: #fff;
            white-space: nowrap;
            font-size: 15px;
            padding: 20px;
            transition: 0.3s;
            transition-property: background;
            text-decoration: none;
        }

        .wrapper .sidebar .sidebar-menu .item .sub-menu a:hover {
            background: #55B1F0;
        }

        .wrapper .sidebar .sidebar-menu .item .sub-menu a:not(last-child) {
            border-bottom: 1px solid #8FC5E9;
        }

        .wrapper .sidebar .sidebar-menu .item .sub-menu i {
            padding-right: 20px;
            font-size: 10px;
        }

        .wrapper .sidebar .sidebar-menu .item:target .sub-menu {
            max-height: 500px;
        }

        .wrapper .main-container {
            width: (100% - 250px);
            margin-top: 70px;
            margin-left: 250px;
            padding: 15px;
            background: url(background.jpg)no-repeat;
            background-size: cover;
            height: 100vh;
            transition: 0.3s;
        }

        .wrapper.collapse .sidebar {
            width: 70px;
        }

        .wrapper.collapse .sidebar .profile img,
        .wrapper.collapse .sidebar .profile p,
        .wrapper.collapse .sidebar a span {
            display: none;
        }

        .wrapper.collapse .sidebar .sidebar-menu .item .menu-btn {
            font-size: 23px;
        }

        .wrapper.collapse .sidebar .sidebar-menu .item .sub-menu i {
            font-size: 18px;
            padding-left: 3px;
        }

        .wrapper.collapse .main-container {
            width: calc(100% - 70px);
            margin-left: 70px;
        }

        .wrapper .main-container .card {
            background: #fff;
            padding: 15px;
            margin-bottom: 10px;
            font-size: 14px;
        }

        /* footer */
        .footer-distributed {
            background-color: #262626;
            box-sizing: border-box;
            width: 100%;
            text-align: left;
            font: bold 16px sans-serif;

            padding: 50px 50px;
            margin-top: 0;
        }

        .footer-distributed .footer-left,
        .footer-distributed .footer-center,
        .footer-distributed .footer-right {
            display: inline-block;
            vertical-align: top;
        }

        /* Footer left */

        .footer-distributed .footer-left {
            width: 40%;
        }

        .footer-distributed .footer-left .logo img {
            width: 40%;
        }

        .footer-distributed .footer-company-about span {
            display: block;
            color: #ffffff;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* The company logo */

        .footer-distributed h3 {
            color: #ffffff;
            font: normal 36px 'Cookie', cursive;
            margin: 0;
        }

        .footer-distributed h3 span {
            font-family: Montserrat;
            color: #5383d3;
        }

        /* Footer links */

        .footer-distributed .footer-links {
            color: #ffffff;
            margin: 20px 0 12px;
            padding: 0;
        }

        .footer-distributed .footer-links a {
            font-family: Montserrat;
            display: inline-block;
            line-height: 1.8;
            text-decoration: none;
            color: inherit;
        }

        .footer-distributed .footer-company-name {
            color: #8f9296;
            font-size: 14px;
            font-weight: normal;
            margin: 0;
        }

        /* Footer Center */

        .footer-distributed .footer-center {
            width: 35%;
        }

        .footer-distributed .footer-center i {
            background-color: #33383b;
            color: #ffffff;
            font-size: 25px;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            text-align: center;
            line-height: 42px;
            margin: 10px 15px;
            vertical-align: middle;
        }

        .footer-distributed .footer-center i.fa-envelope {
            font-size: 17px;
            line-height: 38px;
        }

        .footer-distributed .footer-center p {
            font-family: Montserrat;
            display: inline-block;
            color: #ffffff;
            vertical-align: middle;
            margin: 0;
        }

        .footer-distributed .footer-center p span {
            font-family: Montserrat;
            display: block;
            font-weight: normal;
            font-size: 14px;
            line-height: 2;
        }

        .footer-distributed .footer-center p a {
            font-family: Montserrat;
            color: #5383d3;
            text-decoration: none;
            ;
        }


        /* Footer Right */

        .footer-distributed .footer-right {
            width: 20%;
        }

        .footer-distributed .footer-company-about {
            line-height: 20px;
            color: #92999f;
            font-size: 13px;
            font-weight: normal;
            margin: 0;
        }

        .footer-distributed .footer-company-about span {
            display: block;
            color: #ffffff;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .footer-distributed .footer-icons {
            margin-top: 25px;
        }

        .footer-distributed .footer-icons a {
            display: inline-block;
            width: 35px;
            height: 35px;
            cursor: pointer;
            background-color: #33383b;
            border-radius: 2px;

            font-size: 20px;
            color: #ffffff;
            text-align: center;
            line-height: 35px;

            margin-right: 3px;
            margin-bottom: 5px;
        }
        </style>
    </head>

    <body>
        <!-- Layout Body Preloader -->
        <div id="preloader">
            <div class="spinner"></div>
        </div>
        <!-- Layout Body Preloader -->
        <!--Navbar-->
        <div id="content" style="display: none;">
            <hr class="bg-danger fw-bold fixed-top" style="height: 13px; margin: top 15px;">
            <nav class="navbar navbar-expand-lg navbar-light bg-body-secondary fixed-top">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php"><img src="../../assets/icon/logo.png" alt=""
                            style="width:130px; height: auto; object-fit: contain;"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mx-auto fw-semibold fs-4 fst-normal">
                            <li class="nav-item">
                                <a class="nav-link text-white2" aria-current="page" href="index.php">
                                    <i class="fas fa-home"></i> Beranda</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white2" aria-current="page" href="informasi.php">
                                    <i class="fas fa-info-circle"></i> Informasi Sampah</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white2" aria-current="page" href="setoran.php">
                                    <i class="fas fa-trash-restore-alt"></i> Setoran Sampah</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white2" aria-current="page" href="login.php">
                                    <i class="fas fa-fw fa-sign-in-alt fa-1x"></i> Login</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!--Carousel-->
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3"
                        aria-label="Slide 4"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active" for="01">
                        <img src="../../assets/carosel/car1.jpg" class="d-block w-100 bannerimg" alt="" id="01"
                            style=" filter: brightness(50%);">
                        <div class="carousel-caption d-none d-md-block ">
                            <h5>Proses Pemilahan</h5>
                            <p>Proses pemilahan lanjut oleh petugas bank sampah.</p>
                        </div>
                    </div>
                    <div class="carousel-item" for="02">
                        <img src="../../assets/carosel/car2.jpg" class="d-block w-100" alt="..." id="02"
                            style=" filter: brightness(50%);">
                        <div class="carousel-caption d-none d-md-block ">
                            <h5>Proses Penimbangan</h5>
                            <p>Proses penimbangan sampah oleh petugas bank sampah.</p>
                        </div>
                    </div>
                    <div class="carousel-item" for="03">
                        <img src="../../assets/carosel/car3.jpg" class="d-block w-100 bannerimg" alt="..." id="03"
                            style=" filter: brightness(50%);">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Stock Sampah</h5>
                            <p>Beberapa stock sampah di bank sampah yang sudah berhasil di timbang dan siap untuk di
                                jual.
                            </p>
                        </div>
                    </div>
                    <div class="carousel-item" for="04">
                        <img src="../../assets/carosel/car4.jpg" class="d-block w-100" alt="..." id="04"
                            style=" filter: brightness(50%);">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Penumpukan Sampah</h5>
                            <p>Penumpukan sampah yang belum dijadikan satu di dalam karung.</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <!--konten2-->
            <div class="container-about">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="title-un">BANK SAMPAH Apa Saja</h3>
                            <div class="title-un-icon"><i class="fas fa-dumpster"></i></div>
                            <p class="title-un-des" style="text-align: justify;">Bank sampah Apa Saja adalah organisasi
                                peduli lingkungan yang berlokasi di Dusun Pilang, Desa Apa Saja, Kecamatan Apa Saja.
                                Selain
                                bidang bank sampah kami juga berfokus pada pengelolaan sampah,
                                seperti komposting berbasis sampah, dan masih banyak lagi program yang kami kembangkan.
                                Saat
                                ini bank sampah Apa Saja melayani warga dusun pilang yang berjumlah lebih dari 100
                                kepala
                                keluarga. Hal itu menunjukan bahwa warga masyarakat dusun pilang sangat antusias dengan
                                adanya program ini, dan tentu bank sampah Apa Saja mendapatkan perhatian khusus dari
                                warga
                                sekitar. Jika Anda berminat untuk bergabung, silahkan ikuti langkah berikut ini</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-newsletter">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="title-un">4 TAHAP BANK SAMPAH Apa Saja</h3>
                            <div class="title-un-icon"><i class="fab fa-accusoft"></i></div>
                            <div class="title-un-des" style="text-align: justify;">4 Tahap Bank Sampah Apa Saja :
                                <ol>
                                    <li>Pendaftaran : Masyarakat yang ingin menyetorkan sampah harus mendaftar terlebih
                                        dahulu</li>
                                    <li>Pemilahan : Sampah harus dipilah berdasar jenis-jenisnya</li>
                                    <li>Penimbangan : Sampah ditimbang untuk mengetahui berat sampah yang akan
                                        disetorkan
                                    </li>
                                    <li>Mendapat Keuntungan : Masyarakat dapat memperoleh sejumlah uang jika sampah
                                        berhasil
                                        dijual</li>
                                </ol>
                            </div>
                            <div id="foo">
                                <section class="team">
                                    <div class="row mgt50px">
                                        <div class="coloumn">
                                            <div class="imgBox">
                                                <img src="../../assets/content/1.png">
                                            </div>
                                            <div class="details">
                                                <h3>Tahap 1<br><span>Lakukan Pendaftaran</span></h3>
                                            </div>
                                        </div>
                                        <div class="coloumn">
                                            <div class="imgBox">
                                                <img src="../../assets/content/2.png">
                                            </div>
                                            <div class="details">
                                                <h3>Tahap 2<br><span>Pemilahan Sampah</span></h3>
                                            </div>
                                        </div>
                                        <div class="coloumn">
                                            <div class="imgBox">
                                                <img src="../../assets/content/3.png">
                                            </div>
                                            <div class="details">
                                                <h3>Tahap 3<br><span>Penimbangan Sampah</span></h3>
                                            </div>
                                        </div>
                                        <div class="coloumn">
                                            <div class="imgBox">
                                                <img src="../../assets/content/4.png">
                                            </div>
                                            <div class="details">
                                                <h3>Tahap 4<br><span>Mendapat Keuntungan</span></h3>
                                            </div>
                                        </div>
                                        <div style="clear: both;"></div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--footer-->
            <br>
            <footer class="footer-distributed" style="width: 100%;">
                <div class="footer-left">

                    <div class="logo">
                        <img src="../../asset/icon/kementrian.png" alt="" style="width: 125px;">
                        <img src="../../asset/icon/logo.png" alt="" style="width: 225px;">
                    </div>
                    <br>
                    <p class="footer-company-about">
                        <span>Kementerian Lingkungan Hidup dan Kehutanan <br>
                            Direktorat Jenderal Pengelolaan Sampah, Limbah dan B3 <br>
                            Direktorat Pengelolaan Sampah
                        </span>
                    </p>
                    <h3>BANK SAMPAH Apa Saja</h3>
                </div>
                <div class="footer-center">
                    <div>
                        <i class="fa fa-map-marker"></i>
                        <p><span>Dusun Apa Saja</span></p>
                    </div>
                    <div>
                        <i class="fa fa-phone"></i>
                        <p><a href="sms:(+62)123456789">(+62)123456789</a></p>
                    </div>
                    <div>
                        <i class="fa fa-envelope"></i>
                        <p><a href="mailto:bank_apasaja@gmail.com">bank_apasaja@gmail.com</a></p>
                    </div>
                </div>
                <div class="footer-right">
                    <p class="footer-company-about">
                        <span>Kunjungi Sosial Media Kami!</span>
                        Untuk yang ingin lebih dekat dengan Bank Sampah Apa Saja, silahkan kunjungi sosial media kami
                        dibawah ini!
                    </p>
                    <div class="footer-icons">
                        <a href="#" target="_blank"><i class="fab fa-instagram-square"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-facebook-square"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-twitter-square"></i></a>
                    </div>
                </div>
            </footer>
        </div>
        <!-- Script sources -->
        <script src="preloader.js"></script>
        <script crossorigin="anonymous"
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
        </script>
        <script crossorigin="anonymous" src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js">
        </script>
        <script crossorigin="anonymous" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Script sources -->
    </body>

</html>