<?php
if ($_SESSION['users_akses'] == '') {
    header("location:../../../login.php");
    exit(0);
}
?>

<?php if ($_SESSION['users_akses'] == 'pengguna'): ?>
    <?php require_once("../../../config/config.php"); ?>
    <?php
    $baseFiles = $koneksi->query("SELECT * FROM users WHERE idUser = '$_SESSION[idUser]'");
    $baseFile = mysqli_fetch_array($baseFiles);
    ?>
    <?php if ($setting['status'] == '1'): ?>
        <!-- ======= Header ======= -->
        <header id="header" class="header fixed-top d-flex align-items-center" style="position:fixed">
            <div class="d-flex align-items-center justify-content-between">
                <a href="" role="button" class="logo d-flex align-items-center fs-5 fst-normal fw-semibold">
                    <?php echo "$setting[nama]"; ?>
                </a>
                <i class="bi bi-list toggle-sidebar-btn"></i>
            </div><!-- End Logo -->

            <nav class="header-nav ms-auto mx-3">
                <ul class="d-flex justify-content-center align-items-center mx-auto">
                    <li class="nav-item dropdown pe-3">
                        <a class="nav-link d-flex align-items-center pe-0" href="#" role="button" data-bs-toggle="dropdown"
                            aria-controls="dropdown">
                            <i class="fa fa-regular fa-calendar fa-2x"></i>
                            <span class="d-none d-md-block dropdown-toggle ps-2"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <?php require_once("../ui/calendar.php") ?>
                        </ul>
                    </li>
                    <li class="nav-item dropdown pe-4">
                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" role="button"
                            data-bs-toggle="dropdown" aria-controls="dropdown">
                            <?php $dir = __DIR__ . "../../../../assets/default/user_logo.png"; ?>
                            <?php if ($baseFile['gambar'] != $dir) { ?>
                                <img src="../../../../assets/foto/<?= $baseFile['gambar'] ?>" class="img-responsive rounded-2"
                                    style="width: 25px; max-width: 100%;" alt="<?= $baseFile['gambar'] ?>">
                            <?php } else { ?>
                                <img src="<?php echo $dir; ?>" class="img-responsive rounded-2"
                                    style="width: 25px; max-width: 100%;" alt="user_logo.png">
                            <?php } ?>
                            <span class="d-none d-md-block dropdown-toggle ps-2"></span>
                        </a>
                        <!-- End Profile Iamge Icon -->
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li class="dropdown-header">
                                <h4 class="fs-6 fw-normal text-start text-dark">
                                    <div class="form-inline row justify-content-start align-items-start flex-wrap my-2">
                                        <div class="col-sm col-sm-5 col-md-5">
                                            <label for="">Nama Lengkap</label>
                                        </div>
                                        <div class="col-sm-1 col-md-1">:</div>
                                        <div class="col-sm-6 col-md-6">
                                            <?php echo $baseFile['namaUser']; ?>
                                        </div>
                                    </div>
                                </h4>
                                <hr class="dropdown-divider">
                                <h4 class="fs-6 fw-normal text-start text-dark">
                                    <div class="form-inline row justify-content-start align-items-start flex-wrap my-2">
                                        <div class="col-sm col-sm-5 col-md-5">
                                            <label for="">username</label>
                                        </div>
                                        <div class="col-sm-1 col-md-1">:</div>
                                        <div class="col-sm-6 col-md-6">
                                            <?php echo $baseFile['username']; ?>
                                        </div>
                                    </div>
                                </h4>
                                <hr class="dropdown-divider">
                                <h4 class="fs-6 fw-normal text-start text-dark">
                                    <div class="form-inline row justify-content-start align-items-start flex-wrap my-2">
                                        <div class="col-sm col-sm-5 col-md-5">
                                            <label for="">Saldo</label>
                                        </div>
                                        <div class="col-sm-1 col-md-1">:</div>
                                        <div class="col-sm-6 col-md-6">
                                            <?php echo "Rp. " . number_format($baseFile['saldo'], 2, ",", "."); ?>
                                        </div>
                                    </div>
                                </h4>
                                <hr class="dropdown-divider">
                                <h4 class="fs-6 fw-normal text-start text-dark">
                                    <div class="form-inline row justify-content-start align-items-start flex-wrap my-2">
                                        <div class="col-sm col-sm-5 col-md-5">
                                            <label for="">Jumlah Setoran</label>
                                        </div>
                                        <div class="col-sm-1 col-md-1">:</div>
                                        <div class="col-sm-6 col-md-6">
                                            <?php echo $baseFile['jmlSetoran']; ?>
                                        </div>
                                    </div>
                                </h4>
                                <hr class="dropdown-divider">
                                <h4 class="fs-6 fw-normal text-start text-dark">
                                    <div class="form-inline row justify-content-start align-items-start flex-wrap my-2">
                                        <div class="col-sm col-sm-5 col-md-5">
                                            <label for="">Jabatan</label>
                                        </div>
                                        <div class="col-sm-1 col-md-1">:</div>
                                        <div class="col-sm-6 col-md-6">
                                            <?php echo $_SESSION['users_akses'] ?>
                                        </div>
                                    </div>
                                </h4>
                                <hr class="dropdown-divider my-2">
                                <div class="text-center">
                                    <a href="?page=user-profile&idUser=<?= $_SESSION['idUser'] ?>"
                                        class="btn btn-sm btn-info mx-2">
                                        <i class="fas fa-fw fa-user fa-1x"></i>
                                        Profile
                                    </a>
                                    <a href="?page=logout"
                                        onclick="return confirm('Apakah anda ingin keluar dari website ini ?')"
                                        aria-current="page" class="btn btn-sm btn-danger mx-1">
                                        <i class="fas fa-fw fa-sign-out-alt fa-1x"></i>
                                        Log Out
                                    </a>
                                </div>
                            </li>
                        </ul><!-- End Profile Dropdown Items -->
                    </li><!-- End Profile Nav -->
                </ul>
            </nav><!-- End Icons Navigation -->
        </header>
        <!-- ======= Header ======= -->
        <!-- ======= Sidebar ======= -->
        <aside id="sidebar" style="background: rgba(100, 107, 107, 1);" class="sidebar">
            <ul class="sidebar-nav" id="sidebar-nav">
                <li class="nav-item">
                    <a href="?page=beranda" aria-current="page" class="nav-link collapsed">
                        <i class="fas fa-tachometer-alt fa-1x"></i>
                        <div class="fs-6 display-4 text-dark fw-normal">Dashboard</div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="?page=hasilUser" aria-current="page" class="nav-link collapsed">
                        <i class="fas fa-comments-dollar fa-1x"></i>
                        <div class="fs-6 display-4 text-dark fw-normal">Hasil Pengumpulan</div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="?page=setoranUser" aria-current="page" class="nav-link collapsed">
                        <i class="fas fa-comments-dollar fa-1x"></i>
                        <div class="fs-6 display-4 text-dark fw-normal">Transaksi Penarikan</div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="?page=pengumpulanUser" aria-current="page" class="nav-link collapsed">
                        <i class="fas fa-chart-bar fa-1x"></i>
                        <div class="fs-6 display-4 text-dark fw-normal">Grafik Pengumpulan</div>
                    </a>
                </li>
            </ul>
        </aside>
        <!-- ======= Sidebar ======= -->
        <main id="main" class="main">
            <section class="section dashboard">
                <div class="row">

                    <!-- Left side columns -->
                    <div class="col-lg-8">
                        <div class="row">

                        </div>

                    </div><!-- End Right side columns -->

                </div>
            </section>
        <?php endif; ?>
    <?php else: ?>
    <?php endif; ?>