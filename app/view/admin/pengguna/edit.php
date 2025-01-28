<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Pengguna</title>
        <?php if ($_SESSION['level'] == 'admin'): ?>
        <?php require_once("../ui/header.php") ?>
        <?php require_once("../../../config/config.php") ?>
        <?php else: ?>
        <?php header('location:../ui/header.php?page=beranda') ?>
        <?php exit(0) ?>
        <?php endif; ?>
    </head>

    <body>
        <?php require_once("../ui/sidebar.php") ?>
        <div class="panel panel-default bg-body-secondary rounded-3 p-4">
            <div class="panel-heading shadow-sm bg-light p-2">
                <h4 class="panel-title fs-2 display-2 fst-normal fw-semibold">
                    <i class="fa fa-fw fa-1x fa-user-alt"></i>
                    Data Pengguna
                </h4>
                <div class="d-flex justify-content-end align-items-end flex-wrap">
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beranda" aria-current="page" class="text-decoration-none">
                            Beranda
                        </a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=pengguna" aria-current="page" class="text-decoration-none">
                            Data Pengguna
                        </a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?aksi=editpengguna&idUser=<?= $_GET['idUser'] ?>" aria-current="page"
                            class="text-decoration-none">
                            Data Pengguna
                        </a>
                    </li>
                </div>
            </div>
            <div class="panel-body py-2">
                <section class="content">
                    <div class="content-wrapper">
                        <?php $id = htmlspecialchars($_GET['idUser']); ?>
                        <?php $pengguna = $users->pengguna_edit($id); ?>
                        <?php $data = mysqli_fetch_array($pengguna); ?>
                        <div class="d-flex justify-content-center align-items-center flex-wrap">
                            <div class="col-sm col-sm-7 col-md col-md-7">
                                <div class="card shadow mb-3">
                                    <div class="card-header py-3">
                                        <h4 class="card-title text-center">Edit Data Pengguna</h4>
                                    </div>
                                    <div class="card-body my-2">
                                        <form action="?aksi=pengguna-edit" class="form-group" role="form"
                                            enctype="multipart/form-data" method="post">
                                            <input type="hidden" name="idUser" value="<?= $data["idUser"]; ?>">
                                            <div class="form-inline my-2">
                                                <div class="row justify-content-center align-items-center flex-wrap">
                                                    <div class="form-label col-sm col-sm-4 col-md col-md-4">
                                                        <div class="laebl label-default form-check-label">
                                                            <label for="nama">Nama Lengkap</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm col-sm-1">:</div>
                                                    <div class="col-sm col-sm-6 col-md col-md-6">
                                                        <input type="text" name="nama" required="required"
                                                            value="<?php echo $data["namaUser"]; ?>"
                                                            class="form-control"
                                                            placeholder="Masukkan Nama Lengkap Anda" id="nama">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-inline my-2">
                                                <div class="row justify-content-center align-items-start flex-wrap">
                                                    <div class="form-label col-sm col-sm-4 col-md col-md-4">
                                                        <div class="laebl label-default form-check-label">
                                                            <label for="gambar">Foto</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm col-sm-1">:</div>
                                                    <div class="col-sm col-sm-6 col-md col-md-6">
                                                        <div class="form-icon img-thumbnail w-25">
                                                            <img <?php if ($data['gambar'] != ""): ?>
                                                                src="../../../../assets/foto/<?= $data['gambar'] ?>"
                                                                <?php else: ?>
                                                                src="https://th.bing.com/th/id/OIP.jxhJvX2q8gLQmiFuOWa1bAHaHa?w=161&h=180&c=7&r=0&o=5&pid=1.7"
                                                                <?php endif; ?> id="preview" alt="" width="64"
                                                                class="img-rounded img-fluid">
                                                        </div>
                                                        <div class="form-control my-3">
                                                            <input type="file" name="gambar" id="gambar"
                                                                accept="image/*" class="form-control-file"
                                                                onchange="previewImage(this)" aria-required="true">
                                                        </div>
                                                        <input type="checkbox" name="ganti" class="form-check-input"
                                                            id=""> Jika anda ingin ubah foto (Klick Here)
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-inline my-2">
                                                <div class="row justify-content-center align-items-center flex-wrap">
                                                    <div class="form-label col-sm col-sm-4 col-md col-md-4">
                                                        <div class="laebl label-default form-check-label">
                                                            <label for="nik">Nomor Induk Kependudukan</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm col-sm-1">:</div>
                                                    <div class="col-sm col-sm-6 col-md col-md-6">
                                                        <input type="text" maxlength="16" required="required"
                                                            inputmode="numeric" name="nik" id="nik" class="form-control"
                                                            value="<?= $data['nik'] ?>"
                                                            placeholder="Masukkan Nomor Induk Kewarganegaraan">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-inline my-2">
                                                <div class="row justify-content-center align-items-center flex-wrap">
                                                    <div class="form-label col-sm col-sm-4 col-md col-md-4">
                                                        <div class="laebl label-default form-check-label">
                                                            <label for="alamat">Alamat</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm col-sm-1">:</div>
                                                    <div class="col-sm col-sm-6 col-md col-md-6">
                                                        <input type="text" name="alamat" required="required"
                                                            maxlength="100" id="alamat" class="form-control"
                                                            value="<?= $data['alamat'] ?>"
                                                            placeholder="Masukkan Alamat Anda (lengkap dengan RT/RW)">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-inline my-2">
                                                <div class="row justify-content-center align-items-center flex-wrap">
                                                    <div class="form-label col-sm col-sm-4 col-md col-md-4">
                                                        <div class="laebl label-default form-check-label">
                                                            <label for="telepon">Nomor Telepon</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm col-sm-1">:</div>
                                                    <div class="col-sm col-sm-6 col-md col-md-6">
                                                        <input type="text" inputmode="numeric" required="required"
                                                            name="telepon" id="telepon" maxlength="13"
                                                            class="form-control" value="<?= $data['telepon'] ?>"
                                                            placeholder="Masukkan Nomor Telepon Anda">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-inline my-2">
                                                <div class="row justify-content-center align-items-center flex-wrap">
                                                    <div class="form-label col-sm col-sm-4 col-md col-md-4">
                                                        <div class="laebl label-default form-check-label">
                                                            <label for="telepon">Jumlah Setoran</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm col-sm-1">:</div>
                                                    <div class="col-sm col-sm-6 col-md col-md-6">
                                                        <input type="text" inputmode="numeric" required="required"
                                                            name="jmlSetoran" id="jmlSetoran" maxlength="11"
                                                            class="form-control" value="<?= $data['jmlSetoran'] ?>"
                                                            placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-inline my-2">
                                                <div class="row justify-content-center align-items-center flex-wrap">
                                                    <div class="form-label col-sm col-sm-4 col-md col-md-4">
                                                        <div class="laebl label-default form-check-label">
                                                            <label for="telepon">Saldo</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm col-sm-1">:</div>
                                                    <div class="col-sm col-sm-6 col-md col-md-6">
                                                        <input type="text" inputmode="numeric" required="required"
                                                            name="saldo" id="saldo" maxlength="11" class="form-control"
                                                            value="<?= $data['saldo'] ?>" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer my-2">
                                                <div class="text-center">
                                                    <a href="?page=pengguna" aria-current="page">
                                                        <button type="button" class="btn btn-default btn-outline-dark"
                                                            style="width: 10%;"><i class="fas fa-arrow-left"></i>
                                                        </button>
                                                    </a>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fas fa-save fa-fw fa-1x"></i>
                                                        UPDATE DATA
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