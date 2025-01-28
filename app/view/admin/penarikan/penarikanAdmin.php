<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penarikan</title>
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
</head>

<body>
    <?php require_once("../ui/sidebar.php") ?>
    <div class="panel panel-default bg-body-secondary rounded-3 p-4">
        <div class="panel-heading shadow-sm p-2">
            <h4 class="panel-title fs-2 display-2 fst-normal fw-semibold">
                <i class="bx bx-fw bx-wallet fa-1x"></i>
                Data Penarikan
            </h4>
            <div class="d-flex justify-content-end align-items-end flex-wrap">
                <li class="breadcrumb breadcrumb-item">
                    <a href="?page=beranda" aria-current="page" class="text-decoration-none">
                        Beranda
                    </a>
                </li>
                <li class="breadcrumb breadcrumb-item">
                    <a href="?page=penarikanAdmin" aria-current="page" class="text-decoration-none">
                        Data Penarikan
                    </a>
                </li>
            </div>
        </div>
        <div class="panel-body">
            <section class="content">
                <div class="content-wrapper">
                    <div class="card shadow mb-3">
                        <div class="card-header py-2">
                            <h4 class="card-title fs-3 display-3 fst-normal">Daftar Penarikan Pengguna</h4>
                        </div>
                        <div class="card-body my-2">
                            <div class="card-tools">
                                <div class="card-tools">
                                    <a href="?aksi=tambahPenarikan" aria-current="page">
                                        <button type="button" class="btn btn-danger">
                                            <i class="fa fa-fw fa-1x fa-plus"></i>
                                            Tambah
                                        </button>
                                    </a>
                                    <a href="?page=penarikanAdmin" aria-current="page">
                                        <button type="button" class="btn btn-info">
                                            <i class="fa fa-fw fa-1x fa-refresh"></i>
                                            Muat Ulang Halaman
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
                                                    <th class="text-center fw-normal">ID Penarikan</th>
                                                    <th class="text-center fw-normal">Tanggal Penarikan</th>
                                                    <th class="text-center fw-normal">ID User</th>
                                                    <th class="text-center fw-normal">Nama Penarik</th>
                                                    <th class="text-center fw-normal">Jumlah Saldo yang Ditarik</th>
                                                    <th class="text-center fw-normal">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                <?php $ress = $penarikan->penarikan(); ?>
                                                <?php foreach ($ress as $row): ?>
                                                    <?php $kode = $row["idUser"] ?>
                                                    <?php $namaUser = query("SELECT namaUser FROM users WHERE idUser = '$kode'"); ?>
                                                    <tr>
                                                        <td class="text-center fw-normal"><?php echo $i; ?></td>
                                                        <td class="text-center fw-normal">
                                                            <?php echo $row['idTarik'] ?>
                                                        </td>
                                                        <td class="text-center fw-normal">
                                                            <?php echo $row['tglTarik'] ?>
                                                        </td>
                                                        <td class="text-center fw-normal">
                                                            <?php echo $row['idUser'] ?>
                                                        </td>
                                                        <?php foreach ($namaUser as $user): ?>
                                                            <td class="text-center fw-normal">
                                                                <?php echo $user['namaUser']; ?>
                                                            </td>
                                                        <?php endforeach; ?>
                                                        <td class="text-center fw-normal">
                                                            <?php echo "Rp. " . number_format($row['jmlPenarikan'], 2, ",", ".") ?>
                                                        </td>
                                                        <td class="text-center text-wrap">
                                                            <a href="?aksi=editPenarikan&idTarik=<?= $row['idTarik'] ?>"
                                                                aria-current="page">
                                                                <button type="button" class="btn btn-warning">
                                                                    <i class="fa fa-regular fa-edit fa-1x"></i>
                                                                </button>
                                                            </a>
                                                            <a href="?aksi=hapus-penarikan&id=<?= $row['idTarik'] ?>"
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