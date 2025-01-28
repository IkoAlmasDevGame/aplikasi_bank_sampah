<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tambah Penarikan</title>
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
                        <a href="?page=penarikanAdmin" aria-current="page" class="text-decoration-none">
                            Data Penarikan
                        </a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?aksi=tambahPenarikan" aria-current="page" class="text-decoration-none">
                            Tambah Penarikan
                        </a>
                    </li>
                </div>
            </div>
            <div class="panel-body p-2">
                <div class="d-flex justify-content-center align-items-center flex-wrap">
                    <div class="col-sm col-sm-7 col-md col-md-7">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h4 class="card-title fs-3 display-3 fst-normal text-center">Tambah Penarikan</h4>
                                <div class="form-inline my-2">
                                    <div class="row form-justify-3">
                                        <div class="form-label col-sm col-sm-4 col-md col-md-4">
                                            <label for="penyetor" class="fs-4 display-6 fw-normal text-dark">Nama
                                                Penyetor</label>
                                        </div>
                                        <div class="col-sm col-sm-1">:</div>
                                        <div class="col-sm col-sm-5 col-md col-md-5">
                                            <select name="" id="cmb_nama" required="required" class="form-select">
                                                <option value="">Pilih salah satu</option>
                                                <?php $r_nama = $koneksi->query("SELECT * FROM users"); ?>
                                                <?php foreach ($r_nama as $nmp): ?>
                                                <?php echo "<option value='$nmp[idUser].$nmp[namaUser].$nmp[saldo]'>$nmp[namaUser]</option>"; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body my-2">
                                <form action="?aksi=tambah-penarikan" role="form" enctype="multipart/form-data"
                                    method="post" class="form-group">
                                    <div class="tampung"></div>
                                    <div class="card-footer my-2">
                                        <div class="text-center">
                                            <a href="?page=penarikanAdmin" aria-current="page">
                                                <button type="button" class="btn btn-default btn-outline-dark"
                                                    style="width: 10%;"><i class="fas fa-arrow-left"></i>
                                                </button>
                                            </a>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save fa-fw fa-1x"></i>
                                                Simpan Data
                                            </button>
                                            <button type="reset" class="btn btn-danger">
                                                <i class="fas fa-eraser fa-fw fa-1x"></i>
                                                Hapus Semua
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>