<?php
if ($_SESSION['level'] == '') {
    header("location:../../../login.php");
    exit(0);
}
?>

<?php if ($_SESSION['level'] == 'admin') { ?>
    <?php require_once("../../../config/config.php"); ?>
    <?php
    $baseFiles = $koneksi->query("SELECT * FROM admins WHERE IdAdmin = '$_SESSION[IdAdmin]' and level = '$_SESSION[level]'");
    $baseFile = mysqli_fetch_array($baseFiles);

    ?>
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
                                    <div class="col-sm-4 col-md-4">
                                        <label for="">username</label>
                                    </div>
                                    <div class="col-sm-1 col-md-1">:</div>
                                    <div class="col-sm-6 col-md-6">
                                        <?php echo $baseFile['usernameAdmin']; ?>
                                    </div>
                                </div>
                            </h4>
                            <hr class="dropdown-divider">
                            <h4 class="fs-6 fw-normal text-start text-dark">
                                <div class="form-inline row justify-content-start align-items-start flex-wrap my-2">
                                    <div class="col-sm-4 col-md-4">
                                        <label for="">nama profile</label>
                                    </div>
                                    <div class="col-sm-1 col-md-1">:</div>
                                    <div class="col-sm-6 col-md-6">
                                        <?php echo $baseFile['namaAdmin']; ?>
                                    </div>
                                </div>
                            </h4>
                            <hr class="dropdown-divider">
                            <h4 class="fs-6 fw-normal text-start text-dark">
                                <div class="form-inline row justify-content-start align-items-start flex-wrap my-2">
                                    <div class="col-sm-4 col-md-4">
                                        <label for="">Jabatan</label>
                                    </div>
                                    <div class="col-sm-1 col-md-1">:</div>
                                    <div class="col-sm-6 col-md-6">
                                        <?php echo $baseFile['level'] ?>
                                    </div>
                                </div>
                            </h4>
                            <hr class="dropdown-divider my-2">
                            <div class="text-center">
                                <a href="?page=setting&idSetting=1" class="btn btn-sm btn-success mx-2">
                                    <i class="fas fa-fw fa-building fa-1x"></i>
                                    Website Setting
                                </a>
                                <a href="?page=user-profile&IdAdmin=<?= $_SESSION['IdAdmin'] ?>"
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
                <a href="#" data-bs-target="#kategori" data-bs-toggle="collapse" class="nav-link collapsed">
                    <i class="bi bi-menu-button-wide"></i>
                    <div class="fs-6 display-4 text-dark fw-normal">Data</div>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul class="nav-content collapse" data-bs-parent="#sidebar-nav" id="kategori">
                    <li class="nav-item">
                        <a href="?page=pengguna" class="nav-link" aria-current="page">
                            <i class="fa-regular fa-circle fa-fw fa-1x"></i>
                            <div class="fs-6 display-4 fw-normal hover-text">Data Pengguna</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="?page=sampahAdmin" class="nav-link" aria-current="page">
                            <i class="fa-regular fa-circle fa-fw fa-1x"></i>
                            <div class="fs-6 display-4 fw-normal hover-text">Data Sampah</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="?page=setoranAdmin" class="nav-link" aria-current="page">
                            <i class="fa-regular fa-circle fa-fw fa-1x"></i>
                            <div class="fs-6 display-4 fw-normal hover-text">Data Setoran</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="?page=penarikanAdmin" class="nav-link" aria-current="page">
                            <i class="fa-regular fa-circle fa-fw fa-1x"></i>
                            <div class="fs-6 display-4 fw-normal hover-text">Data Penarikan</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="?page=penjualanAdmin" class="nav-link" aria-current="page">
                            <i class="fa-regular fa-circle fa-fw fa-1x"></i>
                            <div class="fs-6 display-4 fw-normal hover-text">Data Penjualan</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="?page=beritaAdmin" class="nav-link" aria-current="page">
                            <i class="fa-regular fa-circle fa-fw fa-1x"></i>
                            <div class="fs-6 display-4 fw-normal hover-text">Data Berita</div>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" data-bs-target="#post" data-bs-toggle="collapse" class="nav-link collapsed">
                    <i class="bi bi-menu-button-wide"></i>
                    <div class="fs-6 display-4 text-dark fw-normal">Grafik</div>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul class="nav-content collapse" data-bs-parent="#sidebar-nav" id="post">
                    <li class="nav-item">
                        <a href="?page=monitoringAdmin" class="nav-link" aria-current="page">
                            <i class="fa-regular fa-circle fa-fw fa-1x"></i>
                            <div class="fs-6 display-4 fw-normal hover-text">Grafik Monitoring</div>
                        </a>
                    </li>
                </ul>
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
    <?php } else { ?>
        <?php header("location:../../../login.php"); ?>
        <?php exit(0); ?>
    <?php } ?>