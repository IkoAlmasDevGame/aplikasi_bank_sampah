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
    <style type="text/css">
        .table {
            width: 990px;
        }

        @media (min-width:990px) {
            .table {
                min-width: 990px;
            }
        }
    </style>
</head>

<body>
    <?php require_once("../ui/sidebar.php") ?>
    <div class="panel panel-default bg-body-secondary rounded-3 p-4">
        <div class="panel-heading">
            <h4 class="panel-title fs-2 display-2 fst-normal fw-semibold shadow-sm">
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
            </div>
        </div>
        <div class="panel-body">
            <section class="content">
                <div class="content-wrapper">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h4 class="card-title fs-3 display-3 fst-normal">Daftar Pengguna</h4>
                        </div>
                        <div class="card-body my-2">
                            <div class="card-tools">
                                <div class="text-start">
                                    <a href="?page=pengguna" aria-current="page">
                                        <button type="button" class="btn btn-danger">
                                            <i class="fa fa-fw fa-refresh fa-1x"></i>
                                            Muat Ulang Halaman
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
                                                    <th class="text-center fw-normal">Nomor Induk Pegawai</th>
                                                    <th class="text-center fw-normal">Foto Pengguna</th>
                                                    <th class="text-center fw-normal">Nama Pengguna</th>
                                                    <th class="text-center fw-normal">Nomor Induk Kependudukan</th>
                                                    <th class="text-center fw-normal">User Name</th>
                                                    <th class="text-center fw-normal">Telepon</th>
                                                    <th class="text-center fw-normal">
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                <?php $pengguna = $users->pengguna(); ?>
                                                <?php foreach ($pengguna as $row) : ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $i; ?></td>
                                                        <td class="text-center"><?php echo $row['idUser'] ?></td>
                                                        <td class="text-center">
                                                            <button type='button' data-bs-toggle='modal'
                                                                data-bs-target='#id<?php echo $row['idUser'] ?>'
                                                                class='btn btn-info'>
                                                                <i class="fa fa-eye fa-1x fa-fw"></i>
                                                            </button>
                                                        </td>
                                                        <td class="text-center"><?php echo $row['namaUser'] ?></td>
                                                        <td class="text-center"><?php echo $row['nik'] ?></td>
                                                        <td class="text-center"><?php echo $row['username'] ?></td>
                                                        <td class="text-center"><?php echo $row['telepon'] ?></td>
                                                        <td class="text-center text-wrap">
                                                            <a href="?aksi=editpengguna&idUser=<?= $row['idUser'] ?>"
                                                                aria-current="page">
                                                                <button type="button" class="btn btn-warning">
                                                                    <i class="fa fa-regular fa-edit fa-1x"></i>
                                                                </button>
                                                            </a>
                                                            <a href="?aksi=pengguna-hapus&idUser=<?= $row['idUser'] ?>"
                                                                aria-current="page"
                                                                onclick="return confirm('Anda yakin ingin menghapus data ini?')">
                                                                <button type="button" class="btn btn-danger">
                                                                    <i class="fa fa-regular fa-trash-alt fa-1x"></i>
                                                                </button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <div class="modal fade" id="id<?php echo $row['idUser'] ?>"
                                                        tabindex="-1">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">
                                                                        <?php echo $row['namaUser'] . "" ?></h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="text-end">
                                                                        <div class="bg-secondary container
                                                                             h-100 rounded-1">
                                                                            <small class="text-light">
                                                                                <?php echo $row['namaUser'] ?>
                                                                            </small>
                                                                            <br>
                                                                            <img src="../../../../assets/foto/<?= $row['gambar'] ?>"
                                                                                alt="" class="img-responsive"
                                                                                style="width: 100px; max-width: 100%;">
                                                                            <br>
                                                                            <small class="text-light">
                                                                                <?php echo $row['gambar'] ?>
                                                                            </small>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="form-inline my-2">
                                                                        <div class="row justify-content-start 
                                                                            align-items-start flex-wrap">
                                                                            <div class="form-label col-sm col-sm-4">
                                                                                <label for="">Alamat</label>
                                                                            </div>
                                                                            <div class="col-sm-1">:</div>
                                                                            <div class="col-sm col-sm-5 text-nowrap">
                                                                                <?php echo $row['alamat'] ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-inline my-2">
                                                                        <div class="row justify-content-start 
                                                                            align-items-start flex-wrap">
                                                                            <div class="form-label col-sm col-sm-4">
                                                                                <label for="">Jumlah Setoran</label>
                                                                            </div>
                                                                            <div class="col-sm-1">:</div>
                                                                            <div class="col-sm col-sm-5">
                                                                                <?php echo number_format($row['jmlSetoran']) ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-inline my-2">
                                                                        <div class="row justify-content-start 
                                                                            align-items-start flex-wrap">
                                                                            <div class="form-label col-sm col-sm-4">
                                                                                <label for="">Jumlah Penarikan</label>
                                                                            </div>
                                                                            <div class="col-sm-1">:</div>
                                                                            <div class="col-sm col-sm-5">
                                                                                <?php echo number_format($row['jmlPenarikan']) ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-inline my-2">
                                                                        <div class="row justify-content-start 
                                                                            align-items-start flex-wrap">
                                                                            <div class="form-label col-sm col-sm-4">
                                                                                <label for="">Saldo</label>
                                                                            </div>
                                                                            <div class="col-sm-1">:</div>
                                                                            <div class="col-sm col-sm-5">
                                                                                <?php echo "Rp. " . number_format($row['saldo'], 2, ",", ".")  ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer my-2">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php $i++; ?>
                                                <?php endforeach ?>
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