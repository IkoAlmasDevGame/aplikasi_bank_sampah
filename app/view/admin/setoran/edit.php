<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Setoran</title>
    <?php if ($_SESSION['level'] == 'admin'): ?>
        <?php require_once("../ui/header.php") ?>
        <?php require_once("../../../config/config.php") ?>
        <?php
        function query($query)
        {
            global $koneksi;
            $result = mysqli_query($koneksi, $query);
            $rows = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
            return $rows;
        }
        ?>
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
    </style>
</head>

<body>
    <?php require_once("../ui/sidebar.php") ?>
    <div class="panel panel-default bg-body-secondary rounded-3 p-4">
        <div class="panel-heading shadow-sm bg-light p-2">
            <h4 class="panel-title fs-2 display-2 fst-normal fw-semibold">
                Edit Setoran
            </h4>
            <div class="d-flex justify-content-end align-items-end flex-wrap">
                <li class="breadcrumb breadcrumb-item">
                    <a href="?page=beranda" aria-current="page" class="text-decoration-none">
                        Beranda
                    </a>
                </li>
                <li class="breadcrumb breadcrumb-item">
                    <a href="?page=setoranAdmin" aria-current="page" class="text-decoration-none">
                        Data Setoran
                    </a>
                </li>
                <li class="breadcrumb breadcrumb-item">
                    <a href="?aksi=editSetoran&idSetoran=<?= $_GET['idSetoran'] ?>" aria-current="page"
                        class="text-decoration-none">
                        Edit Setoran
                    </a>
                </li>
            </div>
        </div>
        <div class="panel-body my-2">
            <section class="content">
                <div class="content-wrapper">
                    <?php $id = htmlspecialchars($_GET['idSetoran']); ?>
                    <?php $setor = query("SELECT * FROM setoran WHERE idSetor = '$id'")[0]; ?>
                    <?php $idu = $setor['idUser']; ?>
                    <?php $users = query("SELECT * FROM users WHERE idUser = '$idu'")[0]; ?>
                    <?php $ids = $setor['idSampah']; ?>
                    <?php $sampah = query("SELECT * FROM sampah WHERE idSampah = '$ids'")[0]; ?>
                    <div class="d-flex justify-content-center align-items-center flex-wrap">
                        <div class="col-sm col-sm-7 col-md col-md-7">
                            <div class="card shadow mb-3">
                                <div class="card-header py-2">
                                    <h4 class="card-title fs-2 fw-medium text-dark
                                     text-center display-5 fst-normal">Edit Setoran</h4>
                                </div>
                                <div class="card-body my-2">
                                    <form action="?aksi=setoran-edit" role="form" class="form-group"
                                        enctype="multipart/form-data" method="post">
                                        <input type="hidden" name="idSetoran" value="<?= $setor['idSetor'] ?>">
                                        <div class="form-inline my-2">
                                            <div class="row form-justify">
                                                <div class="form-label col-sm col-sm-4 col-md col-md-4">
                                                    <label for="penyetor">Nama Penyetor</label>
                                                </div>
                                                <div class="col-sm col-sm-1">:</div>
                                                <div class="col-sm col-sm-5 col-md col-md-5">
                                                    <select name="penyetor" id="penyetor" required="required"
                                                        class="form-select">
                                                        <?php $no = mysqli_query($koneksi, "SELECT * FROM users"); ?>
                                                        <?php $jumlahData = mysqli_num_rows($no); ?>
                                                        <?php for ($i = 0; $i < $jumlahData; $i++) { ?>
                                                            <?php $namapenyetor = query("SELECT namaUser FROM users")[$i]; ?>
                                                            <?php foreach ($namapenyetor as $nmp) : ?>
                                                                <option <?php if ($users['namaUser'] == $nmp) { ?>
                                                                    value="<?php echo $nmp; ?>" selected <?php } ?>>
                                                                    <?php echo $nmp; ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline my-2">
                                            <div class="row form-justify">
                                                <div class="form-label col-sm col-sm-4 col-md col-md-4">
                                                    <label for="sampah">Nama Sampah</label>
                                                </div>
                                                <div class="col-sm col-sm-1">:</div>
                                                <div class="col-sm col-sm-5 col-md col-md-5">
                                                    <select name="sampah" id="sampah" required="required"
                                                        class="form-select">
                                                        <?php $no = mysqli_query($koneksi, "SELECT * FROM sampah"); ?>
                                                        <?php $jumlahData = mysqli_num_rows($no); ?>
                                                        <?php for ($i = 0; $i < $jumlahData; $i++) { ?>
                                                            <?php $namasampah = query("SELECT namaSampah FROM sampah")[$i]; ?>
                                                            <?php foreach ($namasampah as $ns) : ?>
                                                                <option <?php if ($sampah['namaSampah'] == $ns) { ?>
                                                                    value="<?php echo $ns; ?>" selected <?php } ?>>
                                                                    <?php echo $ns; ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline my-2">
                                            <div class="row form-justify">
                                                <div class="form-label col-sm col-sm-4 col-md col-md-4">
                                                    <label for="tanggal">Tanggal Setoran</label>
                                                </div>
                                                <div class="col-sm col-sm-1">:</div>
                                                <div class="col-sm col-sm-5 col-md col-md-5">
                                                    <input type="date" name="tanggal" id="tanggal"
                                                        required="required"
                                                        value="<?php echo $setor["tglSetor"]; ?>"
                                                        class="form-control date-formate">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline my-2">
                                            <div class="row form-justify-2">
                                                <div class="form-label col-sm col-sm-4 col-md col-md-4">
                                                    <label for="berat">Berat</label>
                                                </div>
                                                <div class="col-sm col-sm-1">:</div>
                                                <div class="col-sm col-sm-5 col-md col-md-5">
                                                    <input type="text" value="<?php echo $setor["berat"]; ?>"
                                                        inputmode="numeric" maxlength="15" name="berat" id="berat"
                                                        placeholder="Harga/Kg" required="required"
                                                        class="form-control">
                                                    <select name="satuan" id="satuan" required="required"
                                                        class="form-select">
                                                        <option <?php if ($sampah['satuan'] == 'KG') { ?> value="KG"
                                                            selected <?php } ?>>KG</option>
                                                        <option <?php if ($sampah['satuan'] == 'PC') { ?> value="PC"
                                                            selected <?php } ?>>PC</option>
                                                        <option <?php if ($sampah['satuan'] == 'LT') { ?> value="LT"
                                                            selected <?php } ?>>LT</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer my-2">
                                            <div class="text-center">
                                                <a href="?page=setoranAdmin" aria-current="page">
                                                    <button type="button" class="btn btn-default btn-outline-dark"
                                                        style="width: 10%;"><i class="fas fa-arrow-left"></i>
                                                    </button>
                                                </a>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save fa-fw fa-1x"></i>
                                                    Update Data
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php require_once("../ui/footer.php") ?>