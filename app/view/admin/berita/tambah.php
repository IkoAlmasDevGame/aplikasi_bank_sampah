<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tambah Berita</title>
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
    </head>

    <body>
        <?php require_once("../ui/sidebar.php") ?>
        <div class="panel panel-default bg-body-secondary rounded-3 p-4">
            <div class="panel-heading shadow-sm p-2">
                <h4 class="panel-title fs-2 display-2 fst-normal fw-semibold">
                    <i class="bx bx-fw bx-news fa-1x"></i>
                    Tambah Berita
                </h4>
                <div class="d-flex justify-content-end align-items-end flex-wrap">
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beranda" aria-current="page" class="text-decoration-none">
                            Beranda
                        </a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beritaAdmin" aria-current="page" class="text-decoration-none">
                            Data Berita
                        </a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?aksi=tambahBerita" aria-current="page" class="text-decoration-none">
                            Tambah Berita
                        </a>
                    </li>
                </div>
            </div>
            <div class="panel-body my-1">
                <div class="d-flex justify-content-center align-items-center flex-wrap">
                    <div class="col-sm col-sm-7 col-md col-md-7">
                        <div class="card shadow mb-4">
                            <div class="card-header py-2">
                                <h4 class="card-title fs-3 display-3 fst-normal text-center">Tambah Berita</h4>
                            </div>
                            <div class="card-body my-2">
                                <form action="?aksi=tambah-berita" role="form" class="form-group"
                                    enctype="multipart/form-data" method="post">
                                    <?php require_once("../../../model/berita.php"); ?>
                                    <?php $news = new model\berita($koneksi); ?>
                                    <div class="form-inline my-2">
                                        <div class="row form-justify">
                                            <div class="form-label col-sm col-sm-4 col-md col-md-4">
                                                <label for="">ID Berita</label>
                                            </div>
                                            <div class="col-sm col-sm-1">:</div>
                                            <div class="col-sm col-sm-6 col-md col-md-6">
                                                <input type="text" name="idBerita" readonly required
                                                    class="form-control" value="<?= $news->buatKode("BRT"); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-inline my-2">
                                        <div class="row form-justify">
                                            <div class="form-label col-sm col-sm-4 col-md col-md-4">
                                                <label for="">Judul Berita</label>
                                            </div>
                                            <div class="col-sm col-sm-1">:</div>
                                            <div class="col-sm col-sm-6 col-md col-md-6">
                                                <input type="text" name="judul" id="" class="form-control"
                                                    placeholder="Judul Berita" autocomplete="off" autofocus required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-inline my-2">
                                        <div class="row form-justify">
                                            <div class="form-label col-sm col-sm-4 col-md col-md-4">
                                                <label for="">Isi Berita</label>
                                            </div>
                                            <div class="col-sm col-sm-1">:</div>
                                            <div class="col-sm col-sm-6">
                                                <textarea name="isi" id="" maxlength="300" placeholder="isi berita ..."
                                                    class="form-control" required rows="3" cols="135"></textarea>
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
                                                    <img src="https://th.bing.com/th/id/OIP.jxhJvX2q8gLQmiFuOWa1bAHaHa?w=161&h=180&c=7&r=0&o=5&pid=1.7"
                                                        id="preview" alt="" width="64" class="img-rounded img-fluid">
                                                </div>
                                                <div class="form-control my-3">
                                                    <input type="file" name="gambar" id="gambar" accept="image/*"
                                                        class="form-control-file" onchange="previewImage(this)"
                                                        aria-required="true">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-inline my-2">
                                        <div class="row form-justify">
                                            <div class="form-label col-sm col-sm-4 col-md col-md-4">
                                                <label for="">Sumber Berita</label>
                                            </div>
                                            <div class="col-sm col-sm-1">:</div>
                                            <div class="col-sm col-sm-6 col-md col-md-6">
                                                <input type="text" name="sumber" id="" maxlength="300"
                                                    class="form-control" placeholder="Sumber Berita" autocomplete="off"
                                                    autofocus required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer my-2">
                                        <div class="text-center">
                                            <a href="?page=beritaAdmin" aria-current="page">
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