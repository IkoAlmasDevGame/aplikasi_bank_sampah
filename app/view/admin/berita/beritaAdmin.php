<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Berita</title>
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
            <div class="panel-heading shadow-sm p-2">
                <h4 class="panel-title fs-2 display-2 fst-normal fw-semibold">
                    <i class="bx bx-fw bx-news fa-1x"></i>
                    Data Berita
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
                </div>
            </div>
            <div class="panel-body">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h4 class="card-title fs-3 display-3 fst-normal">Daftar Berita</h4>
                    </div>
                    <div class="card-body my-2">
                        <div class="card-tools">
                            <a href="?aksi=tambahBerita" aria-current="page">
                                <button type="button" class="btn btn-danger">
                                    <i class="fa fa-fw fa-1x fa-plus"></i>
                                    Tambah Berita
                                </button>
                            </a>
                            <a href="?page=beritaAdmin" aria-current="page">
                                <button type="button" class="btn btn-info">
                                    <i class="fa fa-fw fa-1x fa-refresh"></i>
                                    Muat Ulang Halaman
                                </button>
                            </a>
                        </div>
                        <div class="card-footer my-2">
                            <div class="container-fluid">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped-columns" id="datatable2">
                                        <thead>
                                            <tr>
                                                <th class="text-center fw-normal">No</th>
                                                <th class="text-center fw-normal">ID Berita</th>
                                                <th class="text-center fw-normal">Judul</th>
                                                <th class="text-center fw-normal">Isi Berita</th>
                                                <th class="text-center fw-normal">Gambar</th>
                                                <th class="text-center fw-normal">Sumber</th>
                                                <th class="text-center fw-normal" width="10%">Pengaturan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php $berita = $news->berita(); ?>
                                            <?php foreach ($berita as $row): ?>
                                            <tr>
                                                <td class="text-center fw-normal"><?php echo $i; ?></td>
                                                <td class="text-center fw-normal"><?php echo $row['idBerita'] ?></td>
                                                <td class="text-center fw-normal">
                                                    <?php
                                                    $a = $row['judul'];
                                                    // echo $a;
                                                    if (strlen($a) > 20) {
                                                        echo substr($a, 0, 20), " (...)";
                                                    } else {
                                                        echo $a;
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center fw-normal">
                                                    <?php
                                                    $a = $row['isi'];
                                                    // echo $a;
                                                    if (strlen($a) > 30) {
                                                        echo substr($a, 0, 30), " (...)";
                                                    } else {
                                                        echo $a;
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <img src="../../../../assets/berita/<?= $row['gambar'] ?>" alt=""
                                                        class="img-responsive" style="width: 50px; max-width: 100%;">
                                                </td>
                                                <td class="text-center fw-normal">
                                                    <?php
                                                    $a = $row['sumber'];
                                                    // echo $a;
                                                    if (strlen($a) > 20) {
                                                        echo substr($a, 0, 20), " (...)";
                                                    } else {
                                                        echo $a;
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center text-wrap">
                                                    <a href="?aksi=editBerita&id=<?= $row['idBerita'] ?>"
                                                        aria-current="page">
                                                        <button type="button" class="btn btn-warning">
                                                            <i class="fa fa-regular fa-edit fa-1x"></i>
                                                        </button>
                                                    </a>
                                                    <a href="?aksi=hapus-berita&id=<?= $row['idBerita'] ?>"
                                                        onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                                        aria-current="page">
                                                        <button type="button" class="btn btn-danger">
                                                            <i class="fa fa-regular fa-trash-alt fa-1x"></i>
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>