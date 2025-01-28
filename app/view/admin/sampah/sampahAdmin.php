<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Sampah</title>
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
        <div class="panel-heading shadow-sm p-2">
            <h4 class="panel-title fs-2 display-2 fst-normal fw-semibold">
                <i class="fa fa-fw fa-1x fa-trash-alt"></i>
                Data Sampah
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
            </div>
        </div>
        <div class="panel-body">
            <section class="content">
                <div class="content-wrapper">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h4 class="card-title fs-3 display-3 fst-normal">Daftar Sampah</h4>
                        </div>
                        <div class="card-body my-2">
                            <div class="card-tools">
                                <a href="?aksi=tambahSampah" aria-current="page">
                                    <button type="button" class="btn btn-danger">
                                        <i class="fa fa-fw fa-1x fa-plus"></i>
                                        Tambah
                                    </button>
                                </a>
                                <a href="?page=stocksampahAdmin" aria-current="page">
                                    <button type="button" class="btn btn-info">
                                        <i class="fa fa-fw fa-1x fa-cubes"></i>
                                        Stock Sampah
                                    </button>
                                </a>
                            </div>
                            <div class="card-footer my-2">
                                <div class="container-fluid">
                                    <div class="table-responsive">
                                        <table class="table table-striped-columns table-bordered" id="datatable2">
                                            <thead>
                                                <tr>
                                                    <th class="text-center fw-normal">No</th>
                                                    <th class="text-center fw-normal">ID Sampah</th>
                                                    <th class="text-center fw-normal">Jenis Sampah</th>
                                                    <th class="text-center fw-normal">Nama Sampah</th>
                                                    <th class="text-center fw-normal">Satuan</th>
                                                    <th class="text-center fw-normal">Harga</th>
                                                    <th class="text-center fw-normal">Gambar</th>
                                                    <th class="text-center fw-normal">Keterangan</th>
                                                    <th class="text-center fw-normal">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                <?php $ress = $sampah->sampah(); ?>
                                                <?php foreach ($ress as $row): ?>
                                                    <tr>
                                                        <td class="text-center fw-normal"><?php echo $i; ?></td>
                                                        <td class="text-center fw-normal">
                                                            <?php echo $row['idSampah'] ?>
                                                        </td>
                                                        <td class="text-center fw-normal">
                                                            <?php echo $row['jenisSampah'] ?>
                                                        </td>
                                                        <td class="text-center fw-normal">
                                                            <?php echo $row['namaSampah'] ?>
                                                        </td>
                                                        <td class="text-center fw-normal">
                                                            <?php echo $row['satuan'] ?>
                                                        </td>
                                                        <td class="text-center fw-normal">
                                                            <?php echo "Rp. " . number_format($row['harga'], 2, ",", ".")  ?>
                                                        </td>
                                                        <td>
                                                            <div class="text-center">
                                                                <div class="img-responsive">
                                                                    <img src="../../../../assets/foto_sampah/<?php echo $row["gambar"]; ?>"
                                                                        width="50">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-wrap fw-normal">
                                                            <?php echo $row['deskripsi'] ?>
                                                        </td>
                                                        <td class="text-center text-wrap">
                                                            <a href="?aksi=editSampah&idSampah=<?= $row['idSampah'] ?>"
                                                                aria-current="page">
                                                                <button type="button" class="btn btn-warning">
                                                                    <i class="fa fa-regular fa-edit fa-1x"></i>
                                                                </button>
                                                            </a>
                                                            <a href="?aksi=Sampah-hapus&idSampah=<?= $row['idSampah'] ?>"
                                                                aria-current="page"
                                                                onclick="return confirm('Anda yakin ingin menghapus data ini?')">
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
            </section>
        </div>
    </div>
    <?php require_once("../ui/footer.php") ?>