<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Penarikan</title>
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
                Edit Penarikan
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
                    <a href="?aksi=editPenarikan&idTarik=<?= $_GET['idTarik'] ?>" aria-current="page"
                        class="text-decoration-none">
                        Edit Penarikan
                    </a>
                </li>
            </div>
        </div>
        <div class="panel-body p-2">
            <div class="d-flex justify-content-center align-items-center flex-wrap">
                <div class="col-sm col-sm-7 col-md col-md-7">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h4 class="card-title fs-3 display-3 fst-normal text-center">Edit Penarikan</h4>
                        </div>
                        <div class="card-body my-2">
                            <?php $id = htmlspecialchars($_GET['idTarik']); ?>
                            <?php $ress = $koneksi->query("SELECT * FROM penarikan WHERE idTarik = '$id'"); ?>
                            <?php $data = mysqli_fetch_assoc($ress); ?>
                            <form action="?aksi=edit-penarikan" class="form-group" role="form"
                                enctype="multipart/form-data" method="post">
                                <input type="hidden" name="idTarik" value="<?= $id ?>">
                                <div class="form-inline my-2">
                                    <div class="row form-justify">
                                        <div class="form-label col-sm col-sm-4 col-md col-md-4">
                                            <label for="idUser">ID USER</label>
                                        </div>
                                        <div class="col-sm col-sm-1">:</div>
                                        <div class="col-sm col-sm-5 col-md col-md-5">
                                            <input type="text" readonly value="<?= $data['idUser'] ?>" name="idUser"
                                                id="idUser" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-inline my-2">
                                    <div class="row form-justify">
                                        <div class="form-label col-sm col-sm-4 col-md col-md-4">
                                            <label for="namaUser">Nama User</label>
                                        </div>
                                        <div class="col-sm col-sm-1">:</div>
                                        <div class="col-sm col-sm-5 col-md col-md-5">
                                            <input type="text" readonly value="<?= $data['namaUser'] ?>"
                                                name="namaUser" id="namaUser" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-inline my-2">
                                    <div class="row form-justify">
                                        <div class="form-label col-sm col-sm-4 col-md col-md-4">
                                            <label for="tanggal">Tanggal Penarikan</label>
                                        </div>
                                        <div class="col-sm col-sm-1">:</div>
                                        <div class="col-sm col-sm-5 col-md col-md-5">
                                            <input type="date" value="<?= $data['tglTarik'] ?>" name="tglTarik"
                                                id="tanggal" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-inline my-2">
                                    <div class="row form-justify">
                                        <div class="form-label col-sm col-sm-4 col-md col-md-4">
                                            <label for="jmlPenarikan">Jumlah Penarikan Saldo</label>
                                        </div>
                                        <div class="col-sm col-sm-1">:</div>
                                        <div class="col-sm col-sm-5 col-md col-md-5">
                                            <input type="text" id="jmlPenarikan"
                                                value="<?= $data['jmlPenarikan'] ?>" name="jmlPenarikan"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer my-2">
                                    <div class="text-end">
                                        <a href="?page=penarikanAdmin" aria-current="page">
                                            <button type="button" class="btn btn-default btn-outline-dark"
                                                style="width: 10%;"><i class="fas fa-arrow-left"></i>
                                            </button>
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save fa-fw fa-1x"></i>
                                            UPDATE Data
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