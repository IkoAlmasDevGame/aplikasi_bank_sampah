<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Setoran</title>
        <?php if ($_SESSION['level'] == 'admin'): ?>
        <?php require_once("../ui/header.php") ?>
        <?php require_once("../../../config/config.php") ?>
        <?php else: ?>
        <?php header('location:../ui/header.php?page=beranda') ?>
        <?php exit(0) ?>
        <?php endif; ?>
        <style type="text/css">
        .table {
            width: 1100px;
        }

        @media (min-width:1100px) {
            .table {
                min-width: 1100px;
            }
        }
        </style>
    </head>

    <body>
        <?php require_once("../ui/sidebar.php") ?>
        <div class="panel panel-default bg-body-secondary rounded-3 p-4">
            <div class="panel-heading">
                <h4 class="panel-title fs-2 display-2 fst-normal fw-semibold shadow-sm">
                    <i class="bi bi-wallet fa-fw fa-1x"></i>
                    Data Setoran
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
                </div>
            </div>
            <div class="panel-body">
                <section class="content">
                    <div class="content-wrapper">
                        <div class="card shadow mb-3">
                            <div class="card-header py-3">
                                <h4 class="card-title fs-4 fw-normal fst-normal text-dark display-4">
                                    <i class="fa fa-trash-alt fa-fw fa-1x"></i>
                                    Daftar Setoran Pengguna
                                </h4>
                            </div>
                            <div class="card-body my-2">
                                <div class="card-tools">
                                    <div class="text-start">
                                        <a href="?page=setoranAdmin" aria-current="page">
                                            <button type="button" class="btn btn-danger">
                                                <i class="fa fa-fw fa-refresh fa-1x"></i>
                                                Muat Ulang Halaman
                                            </button>
                                        </a>
                                        <a href="?aksi=tambahSetoran" aria-current="page">
                                            <button type="button" class="btn btn-primary">
                                                <i class="fa fa-fw fa-plus fa-1x"></i>
                                                Tambah Setoran
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-footer my-2">
                                    <div class="container-fluid">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped-columns" id="datatable2">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center fw-normal">No</th>
                                                        <th class="text-center fw-normal">ID Setoran</th>
                                                        <th class="text-center fw-normal">Tanggal Setoran</th>
                                                        <th class="text-center fw-normal">Nama Penyetor</th>
                                                        <th class="text-center fw-normal">Nama Sampah</th>
                                                        <th class="text-center fw-normal">Berat</th>
                                                        <th class="text-center fw-normal">Harga / KG</th>
                                                        <th class="text-center fw-normal">Total Harga</th>
                                                        <th class="text-center fw-normal">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $setoran = $withdraw->setoran(); ?>
                                                    <?php $i = 1; ?>
                                                    <?php foreach ($setoran as $row) : ?>
                                                    <?php $kode = $row["idUser"] ?>
                                                    <?php $namaUser = mysqli_query($koneksi, "SELECT namaUser FROM users WHERE idUser = '$kode'"); ?>
                                                    <?php $kode2 = $row["idSampah"] ?>
                                                    <?php $namaSampah = mysqli_query($koneksi, "SELECT namaSampah, harga FROM sampah WHERE idSampah = '$kode2'"); ?>
                                                    <tr>
                                                        <td class="text-center fw-normal"><?php echo $i; ?></td>
                                                        <td class="text-center fw-normal">
                                                            <?php echo $row['idSetor'] ?>
                                                        </td>
                                                        <td class="text-center fw-normal">
                                                            <?php echo $row['tglSetor'] ?>
                                                        </td>
                                                        <?php foreach ($namaUser as $user) : ?>
                                                        <td class="text-center fw-normal">
                                                            <?php echo $user['namaUser']; ?>
                                                        </td>
                                                        <?php endforeach; ?>
                                                        <?php foreach ($namaSampah as $sampah) : ?>
                                                        <td class="text-center fw-normal">
                                                            <?php echo $sampah['namaSampah']; ?>
                                                        </td>
                                                        <td class="text-center fw-normal">
                                                            <?php echo $row['berat'] . " KG" ?>
                                                        </td>
                                                        <td class="text-center fw-normal">
                                                            <?php echo "Rp. " . number_format($sampah['harga'], 2, ",", ".") ?>
                                                        </td>
                                                        <td class="text-center fw-normal">
                                                            <?php echo "Rp. " . number_format(($row['total']), 2, ",", ".") ?>
                                                        </td>
                                                        <?php endforeach; ?>
                                                        <td class="text-center text-wrap">
                                                            <a href="?aksi=editSetoran&idSetoran=<?= $row['idSetor'] ?>"
                                                                aria-current="page">
                                                                <button type="button" class="btn btn-warning">
                                                                    <i class="fa fa-regular fa-edit fa-1x"></i>
                                                                </button>
                                                            </a>
                                                            <a href="?aksi=setoran-hapus&id=<?= $row['idSetor'] ?>"
                                                                aria-current="page"
                                                                onclick="return confirm('Anda yakin ingin menghapus data ini?')">
                                                                <button type="button" class="btn btn-danger">
                                                                    <i class="fa fa-fw fa-trash fa-1x"></i>
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
                </section>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>