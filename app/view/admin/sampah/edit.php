<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Data Sampah</title>
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
                    <i class="fa fa-fw fa-1x fa-trash-alt"></i>
                    Edit Data Sampah
                </h4>
                <div class="d-flex justify-content-end align-items-end flex-wrap">
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beranda" aria-current="page" class="text-decoration-none">
                            Beranda
                        </a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=sampahAdmin" aria-current="page" class="text-decoration-none">
                            Data Sampah
                        </a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?aksi=editSampah&idSampah=<?= $_GET['idSampah'] ?>" aria-current="page"
                            class="text-decoration-none">
                            Edit Data Sampah
                        </a>
                    </li>
                </div>
            </div>
            <div class="panel-body">
                <section class="content">
                    <div class="content-wrapper">
                        <div class="d-flex justify-content-center align-items-center flex-wrap">
                            <div class="col-sm col-sm-7 col-md col-md-7">
                                <div class="card shadow mb-3">
                                    <div class="card-header py-2">
                                        <h4 class="card-title fs-4 display-4 text-center fst-normal fw-normal">
                                            Tambah Data Sampah
                                        </h4>
                                    </div>
                                    <div class="card-body my-2">
                                        <?php $id = htmlspecialchars($_GET['idSampah']); ?>
                                        <?php $ress = $sampah->edit_sampah($id); ?>
                                        <?php $data = mysqli_fetch_array($ress); ?>
                                        <form action="?aksi=Sampah-edit" enctype="multipart/form-data" role="form"
                                            class="form-group" method="post">
                                            <div class="form-inline my-2">
                                                <div class="row form-justify">
                                                    <div class="form-label col-sm col-sm-4 col-md col-md-4">
                                                        <label for="jenisSampah">Jenis Sampah</label>
                                                    </div>
                                                    <div class="col-sm col-sm-1">:</div>
                                                    <div class="col-sm col-sm-5 col-md col-md-5">
                                                        <input type="hidden" name="idSampah"
                                                            value="<?= $data['idSampah'] ?>">
                                                        <select name="jenisSampah" id="jenisSampah" required="required"
                                                            class="form-select">
                                                            <option <?php if ($data['jenisSampah'] == 'Organik') { ?>
                                                                value="Organik" selected <?php } ?>>
                                                                Organik</option>
                                                            <option <?php if ($data['jenisSampah'] == 'Anorganik') { ?>
                                                                value="Anorganik" selected <?php } ?>>Anorganik</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-inline my-2">
                                                <div class="row form-justify">
                                                    <div class="form-label col-sm col-sm-4 col-md col-md-4">
                                                        <label for="namaSampah">Nama Sampah</label>
                                                    </div>
                                                    <div class="col-sm col-sm-1">:</div>
                                                    <div class="col-sm col-sm-5 col-md col-md-5">
                                                        <input type="hidden" name="namalama"
                                                            value="<?php echo $data["namaSampah"]; ?>">
                                                        <input type="text" name="namaSampah"
                                                            value="<?= $data['namaSampah'] ?>" id="namaSampah" autofocus
                                                            placeholder="Nama Sampah" required="required"
                                                            autocomplete="off" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-inline my-2">
                                                <div class="row form-justify-2">
                                                    <div class="form-label col-sm col-sm-4 col-md col-md-4">
                                                        <label for="satuan">Harga Satuan</label>
                                                    </div>
                                                    <div class="col-sm col-sm-1">:</div>
                                                    <div class="col-sm col-sm-5 col-md col-md-5">
                                                        <input type="text" inputmode="numeric" autofocus
                                                            required="required" placeholder="Rp. " class="form-control"
                                                            name="harga" value="<?= $data['harga'] ?>" id="harga">
                                                        <div class="my-1"></div>
                                                        <select name="satuan" id="satuan" required="required"
                                                            class="form-select">
                                                            <option <?php if ($data['satuan'] == 'KG') { ?> value="KG"
                                                                selected <?php } ?>>KG</option>
                                                            <option <?php if ($data['satuan'] == 'PC') { ?> value="PC"
                                                                selected <?php } ?>>PC</option>
                                                            <option <?php if ($data['satuan'] == 'LT') { ?> value="LT"
                                                                selected <?php } ?>>LT</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-inline my-2">
                                                <div class="row form-justify-2">
                                                    <div class="form-label col-sm col-sm-4 col-md col-md-4">
                                                        <div class="laebl label-default form-check-label">
                                                            <label for="gambar">Foto</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm col-sm-1">:</div>
                                                    <div class="col-sm col-sm-5 col-md col-md-5">
                                                        <div class="form-icon img-thumbnail w-25">
                                                            <img <?php if ($data['gambar'] != ""): ?>
                                                                src="../../../../assets/foto_sampah/<?= $data['gambar'] ?>"
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
                                                            id=""> Jika ingin ubah foto (Klick ini)
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-inline my-2">
                                                <div class="row form-justify-2">
                                                    <div class="form-label col-sm col-sm-4 col-md col-md-4">
                                                        <label for="keterangan">Keterangan</label>
                                                    </div>
                                                    <div class="col-sm col-sm-1">:</div>
                                                    <div class="col-sm col-sm-5 col-md col-md-5">
                                                        <textarea name="deskripsi" rows="5" required="required"
                                                            maxlength="400" id="keterangan" placeholder="keterangan"
                                                            autocomplete="off"
                                                            class="form-control"><?= $data['deskripsi'] ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer my-2">
                                                <div class="text-center">
                                                    <a href="?page=sampahAdmin" aria-current="page">
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