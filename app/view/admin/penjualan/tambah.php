<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Penjualan</title>
        <?php if ($_SESSION['level'] == 'admin'): ?>
        <?php require_once("../ui/header.php") ?>
        <?php require_once("../../../config/config.php") ?>
        <?php else: ?>
        <?php header('location:../ui/header.php?page=beranda') ?>
        <?php exit(0) ?>
        <?php endif; ?>
        <style type="text/css">
        .form-justify {
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        .form-justify-2 {
            justify-content: center;
            align-items: start;
            flex-wrap: wrap;
        }

        .form-justify-3 {
            justify-content: start;
            align-items: start;
            flex-wrap: wrap;
        }
        </style>
        <!-- <script type="text/javascript">
        function sum() {
            var saldo = document.getElementById('saldo').value;
            var jumlahkeluar = document.getElementById('jmlPenarikan').value;
            var result = parseInt(saldo) - parseInt(jumlahkeluar);
            if (!isNaN(result)) {
                document.getElementById('totalSaldo').value = result;
            }
        }
    </script> -->
    </head>

    <body>
        <?php require_once("../ui/sidebar.php") ?>
        <div class="panel panel-default bg-body-secondary rounded-3 p-4">
            <div class="panel-heading shadow-sm p-2">
                <h4 class="panel-title fs-2 display-2 fst-normal fw-semibold">
                    <i class="bx bx-fw bx-wallet fa-1x"></i>
                    Tambah Penarikan
                </h4>
                <div class="d-flex justify-content-end align-items-end flex-wrap">
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beranda" aria-current="page" class="text-decoration-none">
                            Beranda
                        </a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=penjualanAdmin" aria-current="page" class="text-decoration-none">
                            Data Penjualan
                        </a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?aksi=tambahPenjualan" aria-current="page" class="text-decoration-none">
                            Tambah Penjualan
                        </a>
                    </li>
                </div>
            </div>
            <div class="panel-body p-2">
                <div class="d-flex justify-content-center align-items-center flex-wrap">
                    <div class="col-sm col-sm-7 col-md col-md-7">
                        <div class="card shadow mb-3">
                            <div class="card-header py-2">
                                <h4 class="card-title fs-3 display-3 fst-normal text-center">Tambah Data Penjualan</h4>
                                <div class="form-inline my-1">
                                    <div class="row form-justify-3">
                                        <div class="form-label col-sm col-sm-4 col-md col-md-4">
                                            <label for="sampah" class="fs-4 display-6 fw-normal text-dark">
                                                Nama Sampah
                                            </label>
                                        </div>
                                        <div class="col-sm col-sm-1">:</div>
                                        <div class="col-sm col-sm-5 col-md col-md-5">
                                            <select name="" id="cmb_sampah" required="required" class="form-select">
                                                <option value="">Pilih salah satu</option>
                                                <?php $r_sampah = $koneksi->query("SELECT * FROM sampah"); ?>
                                                <?php foreach ($r_sampah as $nmp): ?>
                                                <?php echo "<option value='$nmp[idSampah].$nmp[namaSampah]'>$nmp[idSampah] - $nmp[namaSampah]</option>"; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body my-1">
                                <form action="?aksi=tambah-penjualan" role="form" class="form-group"
                                    enctype="multipart/form-data" method="post">
                                    <div class="tampung"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>