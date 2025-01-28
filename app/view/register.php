<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php require_once("../config/config.php"); ?>
        <?php $setting = $koneksi->query("SELECT * FROM setting")->fetch_array(); ?>
        <title><?php echo $setting['nama'] . " Register" ?></title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link rel="stylesheet" href="preloader.css">
        <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            font-family: 'Times New Roman';
            font-weight: normal;
            font-size: 12px;
            font-style: normal;
        }

        body {
            background: rgba(100, 100, 100, 0.600);
        }

        .card {
            width: 600px;
        }

        @media (max-width:720px) {
            .card {
                max-width: 720px;
            }
        }
        </style>
    </head>

    <body>
        <!-- Layout Body Preloader -->
        <div id="preloader">
            <div class="spinner"></div>
        </div>
        <!-- Layout Body Preloader -->

        <!-- Layout Register Aplikasi Bank Sampah -->
        <div id="content" style="display:none;">
            <!-- Start Header Section -->
            <header class="header">
                <div class="navbar navbar-expand-lg bg-body-secondary position-sticky sticky-sm-bottom">
                    <div class="container-fluid">
                        <a href="register.php" class="navbar-brand fs-6 text-start text-dark">
                            <?php echo ucwords(ucfirst($setting['nama'])) ?> </a>
                        <div class="col-sm-auto col-md-auto">
                            <div id="days" style="font-size: 12px;"></div>
                            <div style="font-size: 12px;" id="clock"></div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- End Header Section -->
            <section class="content">
                <div class="content-wrapper">
                    <div class="container-fluid mt-4 pt-5">
                        <div class="d-flex justify-content-center align-items-center flex-wrap">
                            <div class="card shadow mb-4">
                                <div class="card-header py-2">
                                    <h4 class="card-title text-center">
                                        Registerasi - <?php echo $setting['nama'] ?> -
                                    </h4>
                                </div>
                                <div class="card-body my-2">
                                    <?php require_once("../model/pengguna.php"); ?>
                                    <?php require_once("../controller/controller.php"); ?>
                                    <?php $users = new controller\pengguna($koneksi); ?>
                                    <?php if (!isset($_GET['aksi'])): ?>
                                    <?php else: ?>
                                    <?php switch ($_GET['aksi']) {
                                        case 'tambah-users':
                                            $users->tambah_users();
                                            break;

                                        default:
                                            require_once("../controller/controller.php");
                                            break;
                                    } ?>
                                    <?php endif; ?>
                                    <form action="?aksi=tambah-users" role="form" class="form-group"
                                        enctype="multipart/form-data" method="post">
                                        <div class="form-inline my-2">
                                            <div class="row justify-content-center align-items-center flex-wrap">
                                                <div class="form-label col-sm col-sm-4 col-md col-md-4">
                                                    <div class="laebl label-default form-check-label">
                                                        <label for="nama">Nama Lengkap</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm col-sm-1">:</div>
                                                <div class="col-sm col-sm-6 col-md col-md-6">
                                                    <input type="text" name="nama" class="form-control"
                                                        placeholder="Masukkan Nama Lengkap Anda" id="nama">
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
                                                            id="preview" alt="" width="64"
                                                            class="img-rounded img-fluid">
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
                                            <div class="row justify-content-center align-items-center flex-wrap">
                                                <div class="form-label col-sm col-sm-4 col-md col-md-4">
                                                    <div class="laebl label-default form-check-label">
                                                        <label for="nik">NIK</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm col-sm-1">:</div>
                                                <div class="col-sm col-sm-6 col-md col-md-6">
                                                    <input type="text" maxlength="16" inputmode="numeric" name="nik"
                                                        id="nik" class="form-control"
                                                        placeholder="Masukkan Nomor Induk Kewarganegaraan">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline my-2">
                                            <div class="row justify-content-center align-items-center flex-wrap">
                                                <div class="form-label col-sm col-sm-4 col-md col-md-4">
                                                    <div class="laebl label-default form-check-label">
                                                        <label for="alamat">Alamat</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm col-sm-1">:</div>
                                                <div class="col-sm col-sm-6 col-md col-md-6">
                                                    <input type="text" name="alamat" maxlength="100" id="alamat"
                                                        class="form-control"
                                                        placeholder="Masukkan Alamat Anda (lengkap dengan RT/RW)">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline my-2">
                                            <div class="row justify-content-center align-items-center flex-wrap">
                                                <div class="form-label col-sm col-sm-4 col-md col-md-4">
                                                    <div class="laebl label-default form-check-label">
                                                        <label for="telepon">Nomor Telepon</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm col-sm-1">:</div>
                                                <div class="col-sm col-sm-6 col-md col-md-6">
                                                    <input type="text" inputmode="numeric" name="telepon" id="telepon"
                                                        maxlength="13" class="form-control"
                                                        placeholder="Masukkan Nomor Telepon Anda">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline my-2">
                                            <div class="row justify-content-center align-items-center flex-wrap">
                                                <div class="form-label col-sm col-sm-4 col-md col-md-4">
                                                    <div class="laebl label-default form-check-label">
                                                        <label for="username">Username</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm col-sm-1">:</div>
                                                <div class="col-sm col-sm-6 col-md col-md-6">
                                                    <input type="text" name="username" maxlength="20" id="username"
                                                        class="form-control" placeholder="Masukkan Username Anda">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline my-2">
                                            <div class="row justify-content-center align-items-center flex-wrap">
                                                <div class="form-label col-sm col-sm-4 col-md col-md-4">
                                                    <div class="laebl label-default form-check-label">
                                                        <label for="password">password</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm col-sm-1">:</div>
                                                <div class="col-sm col-sm-6 col-md col-md-6">
                                                    <input type="password" name="password" maxlength="20" id="password"
                                                        class="form-control" placeholder="Masukkan Password Anda">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline my-2">
                                            <div class="row justify-content-center align-items-center flex-wrap">
                                                <div class="form-label col-sm col-sm-4 col-md col-md-4">
                                                    <div class="laebl label-default form-check-label">
                                                        <label for="password2">Konfirmasi Password</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm col-sm-1">:</div>
                                                <div class="col-sm col-sm-6 col-md col-md-6">
                                                    <input type="password" name="password2" maxlength="20"
                                                        id="password2" class="form-control"
                                                        placeholder="Konfirmasi Password Anda">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="jmlSetoran">
                                        <input type="hidden" name="jmlPenarikan">
                                        <input type="hidden" name="saldo">
                                        <div class="card-footer my-2">
                                            <div class="text-center">
                                                <a href="login.php" aria-current="page">
                                                    <button type="button" class="btn btn-default btn-outline-dark"
                                                        style="width: 10%;"><i class="fas fa-arrow-left"></i>
                                                    </button>
                                                </a>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save fa-fw fa-1x"></i>
                                                    SUBMIT REGISTERASI
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
        <!-- Layout Register Aplikasi Bank Sampah -->
        <script src="preloader.js"></script>
        <script>
        function previewImage(input) {
            const file = input.files[0];
            if (file) {
                const preview = document.getElementById('preview');
                preview.src = URL.createObjectURL(file);
                preview.onload = function() {
                    URL.revokeObjectURL(preview.src); // Free memory
                };
            }
        }
        </script>
        <script crossorigin="anonymous"
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
        </script>
        <script crossorigin="anonymous" src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js">
        </script>
        <script crossorigin="anonymous" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </body>

</html>