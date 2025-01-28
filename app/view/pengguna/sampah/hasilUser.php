<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Penarikan Saldo</title>
    <?php if ($_SESSION['users_akses'] == 'pengguna'): ?>
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
        <div class="panel-heading">
            <h4 class="panel-title fs-2 display-2 fst-normal fw-semibold shadow-sm">
                <i class="bi bi-wallet fa-fw fa-1x"></i>
                Data Pengumpulan Anda
            </h4>
            <div class="d-flex justify-content-end align-items-end flex-wrap">
                <li class="breadcrumb breadcrumb-item">
                    <a href="?page=beranda" aria-current="page" class="text-decoration-none">
                        Beranda
                    </a>
                </li>
                <li class="breadcrumb breadcrumb-item">
                    <a href="?page=hasilUser" aria-current="page" class="text-decoration-none">
                        Data Pengumpulan Anda
                    </a>
                </li>
            </div>
            <div class="panel-body my-1">
                <div class="card shadow mb-4">
                    <div class="card-header py-2">
                        <h4 class="card-title">Data Pengumpulan Anda</h4>
                    </div>
                    <div class="card-body my-2">
                        <div class="card-tools">
                            <a href="?page=hasilUser" aria-current="page">
                                <button type="button" class="btn btn-danger">
                                    <i class="fa fa-fw fa-refresh fa-1x"></i>
                                    Muat Ulang Halaman
                                </button>
                            </a>
                        </div>
                        <div class="card-footer my-2">
                            <div class="container-fluid">
                                <div class="table-responsive">
                                    <table class="table table-striped-columns" id="datatable2">
                                        <thead>
                                            <tr>
                                                <th class="text-center fw-normal">No</th>
                                                <th class="text-center fw-normal">Tanggal Setoran</th>
                                                <th class="text-center fw-normal">Nama Sampah</th>
                                                <th class="text-center fw-normal">Berat</th>
                                                <th class="text-center fw-normal">Harga/KG</th>
                                                <th class="text-center fw-normal">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php $ress = $koneksi->query("SELECT * FROM setoran WHERE idUser = '$_SESSION[idUser]' ORDER BY tglSetor ASC"); ?>
                                            <?php foreach ($ress as $row): ?>
                                                <?php $kode2 = $row["idSampah"] ?>
                                                <?php $namaSampah = $koneksi->query("SELECT namaSampah,harga FROM sampah WHERE idSampah = '$kode2'"); ?>
                                                <tr>
                                                    <td class="text-center fw-normal"><?php echo $i; ?></td>
                                                    <td class="text-center fw-normal">
                                                        <?php echo $row['tglSetor'] ?>
                                                    </td>
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