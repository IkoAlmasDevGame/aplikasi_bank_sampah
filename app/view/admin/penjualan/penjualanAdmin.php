<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Penjualan</title>
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
                    <i class="bx bx-money-withdraw fa-fw fa-1x"></i>
                    Data Penjualan
                </h4>
                <div class="d-flex justify-content-end align-items-end flex-wrap">
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=beranda" aria-current="page" class="text-decoration-none">
                            Beranda
                        </a>
                    </li>
                    <li class="breadcrumb breadcrumb-item">
                        <a href="?page=penjualanAdmin" aria-current="page" class="text-decoration-none">
                            Data Penjualan
                        </a>
                    </li>
                </div>
            </div>
            <div class="panel-body">
                <section class="content">
                    <div class="content-wrapper">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h4 class="card-title fs-2 display-2 text-black fst-normal fw-normal">
                                    <i class="fa fa-regular fa-trash-alt fa-1x fa-fw"></i>Daftar Penjualan Sampah
                                </h4>
                            </div>
                            <div class="card-body my-2">
                                <div class="card-tools">
                                    <div class="text-start">
                                        <a href="?page=penjualanAdmin" aria-current="page">
                                            <button type="button" class="btn btn-danger">
                                                <i class="fa fa-fw fa-refresh fa-1x"></i>
                                                Muat Ulang Halaman
                                            </button>
                                        </a>
                                        <a href="?aksi=tambahPenjualan" aria-current="page">
                                            <button type="button" class="btn btn-primary">
                                                <i class="fa fa-fw fa-plus fa-1x"></i>
                                                Tambah Penjualan
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-footer my-2">
                                    <div class="container-fluid">
                                        <div class="table-responsive">
                                            <table class="table table-striped-columns table-bordered" id="datatable2">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center fw-normal">No</th>
                                                        <th class="text-center fw-normal">ID Penjualan</th>
                                                        <th class="text-center fw-normal">Nama Sampah</th>
                                                        <th class="text-center fw-normal">Berat</th>
                                                        <th class="text-center fw-normal">Tanggal Penjualan</th>
                                                        <th class="text-center fw-normal">Nama Pembeli</th>
                                                        <th class="text-center fw-normal">Nomor Pembeli</th>
                                                        <th class="text-center fw-normal">Harga</th>
                                                        <th class="text-center fw-normal">Total Pendapatan</th>
                                                        <th class="text-center fw-normal">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    <?php $penjualan = $selling->penjualan(); ?>
                                                    <?php foreach ($penjualan as $row) : ?>
                                                    <?php $kode = $row["idSampah"]; ?>
                                                    <?php $namaUser = query("SELECT namaSampah FROM sampah WHERE idSampah = '$kode'"); ?>
                                                    <tr>
                                                        <td class="text-center fw-normal"><?php echo $i; ?></td>
                                                        <td class="text-center fw-normal">
                                                            <?php echo $row['idJual'] ?>
                                                        </td>
                                                        <?php foreach ($namaUser as $user) : ?>
                                                        <td class="text-center fw-normal">
                                                            <?php echo $user['namaSampah']; ?>
                                                        </td>
                                                        <?php endforeach; ?>
                                                        <td class="text-center fw-normal"><?php echo $row['berat'] ?>
                                                        </td>
                                                        <td class="text-center fw-normal">
                                                            <?php echo $row['tglPenjualan'] ?>
                                                        </td>
                                                        <td class="text-center fw-normal">
                                                            <?php echo $row['namaPembeli'] ?>
                                                        </td>
                                                        <td class="text-center fw-normal">
                                                            <?php echo $row['nomorPembeli'] ?>
                                                        </td>
                                                        <td class="text-center fw-normal">
                                                            <?php echo "Rp. " . number_format($row['harga'], 2, ",", ".") ?>
                                                        </td>
                                                        <td class="text-center fw-normal">
                                                            <?php echo "Rp. " . number_format($row['totalPendapatan'], 2, ",", ".") ?>
                                                        </td>
                                                        <td class="text-center text-wrap">
                                                            <a href="?aksi=hapus-penjualan&id=<?= $row['idJual'] ?>"
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