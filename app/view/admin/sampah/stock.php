<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Stock Sampah</title>
        <?php if ($_SESSION['level'] == 'admin'): ?>
        <?php require_once("../ui/header.php") ?>
        <?php require_once("../../../config/config.php") ?>
        <?php else: ?>
        <?php header('location:../ui/header.php?page=beranda') ?>
        <?php exit(0) ?>
        <?php endif; ?>
        <style type="text/css">
        .table {
            width: 720px;
        }

        @media (min-width:720px) {
            .table {
                min-width: 720px;
            }
        }
        </style>
    </head>

    <body>
        <?php require_once("../ui/sidebar.php") ?>
        <div class="panel panel-default bg-body-secondary rounded-3 p-4">
            <div class="panel-heading">
                <h4 class="panel-title fs-2 display-2 fst-normal fw-semibold shadow-sm">
                    <i class="fa fa-fw fa-1x fa-trash-alt"></i>
                    Data Stock Sampah
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
                        <a href="?page=stocksampahAdmin" aria-current="page" class="text-decoration-none">
                            Data Stock Sampah
                        </a>
                    </li>
                </div>
            </div>
            <div class="panel-body">
                <section class="content">
                    <div class="content-wrapper">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h4 class="card-title fs-3 display-3 fst-normal">Daftar Stock Sampah</h4>
                            </div>
                            <div class="card-body my-2">
                                <div class="card-tools">
                                    <a href="?page=stocksampahAdmin" aria-current="page">
                                        <button type="button" class="btn btn-danger">
                                            <i class="fa fa-fw fa-1x fa-refresh"></i>
                                            Muat Ulang Halaman
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
                                                        <th class="text-center fw-normal">ID Stock</th>
                                                        <th class="text-center fw-normal">Nama Sampah</th>
                                                        <th class="text-center fw-normal">Stok</th>
                                                        <th class="text-center fw-normal">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    <?php $ress = $sampah->stock_sampah(); ?>
                                                    <?php foreach ($ress as $row): ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $i; ?></td>
                                                        <td class="text-center"><?php echo $row['idStock'] ?></td>
                                                        <td class="text-center"><?php echo $row['namaSampah'] ?></td>
                                                        <td class="text-center"><?php echo $row['stock'] . " KG" ?></td>
                                                        <td class="text-center text-wrap">
                                                            <a href="?aksi=StockSampah-hapus&idStock=<?=$row['idStock']?>"
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