<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php require_once("../config/config.php"); ?>
        <?php $setting = $koneksi->query("SELECT * FROM setting")->fetch_array(); ?>
        <title><?php echo $setting['nama'] . " Login" ?></title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link rel="stylesheet" href="preloader.css">
        <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            font-family: 'Times New Roman';
            font-weight: 300;
            font-size: 16px;
            font-style: normal;
        }

        body {
            background: rgba(100, 100, 100, 0.600);
        }

        .card {
            width: 550px;
        }

        @media (max-width:720px) {
            .card {
                max-width: 100%;
            }
        }
        </style>
    </head>

    <body onload="startTime()">
        <!-- Layout Body Preloader -->
        <div id="preloader">
            <div class="spinner"></div>
        </div>
        <!-- Layout Body Preloader -->

        <!-- Layout Login Aplikasi Bank Sampah -->
        <div id="content" style="display:none;">
            <!-- Start Header Section -->
            <header class="header">
                <div class="navbar navbar-expand-lg bg-body-secondary position-sticky sticky-sm-bottom">
                    <div class="container-fluid">
                        <a href="login.php" class="navbar-brand fs-6 text-start text-dark">
                            <?php echo ucwords(ucfirst($setting['nama'])) ?> </a>
                        <div class="col-sm-auto col-md-auto">
                            <div id="days" style="font-size: 12px;"></div>
                            <div style="font-size: 12px;" id="clock"></div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- End Header Section -->
            <div class="container-fluid mt-4 pt-5">
                <div class="d-flex justify-content-center align-items-center flex-wrap mt-1 pt-1">
                    <div class="card shadow mb-4">
                        <div class="card-header py-2">
                            <h4 class="card-title text-center">
                                Login - <?php echo $setting['nama'] ?> -
                            </h4>
                        </div>
                        <div class="my-2 card-body">
                            <?php require_once("../model/authentication.php"); ?>
                            <?php require_once("../controller/controller.php"); ?>
                            <?php $login = new controller\AuthLogin($koneksi); ?>
                            <?php if (!isset($_GET['aksi'])): ?>
                            <?php else: ?>
                            <?php switch ($_GET['aksi']) {
                                case 'login-users':
                                    $login->LoginAuthen();
                                    break;

                                default:
                                    require_once("../controller/controller.php");
                                    break;
                            } ?>
                            <?php endif; ?>
                            <form action="?aksi=login-users" role="form" method="post">
                                <div class="form-group">
                                    <div class="form-inline">
                                        <div class="row justify-content-start align-items-center flex-wrap">
                                            <div class="form-label col-sm-3 col-md-3">
                                                <label for="" class="label label-default">Username</label>
                                            </div>
                                            <div class="col-sm-1 col-md-1">:</div>
                                            <div class="col-sm-7 col-md-7">
                                                <input type="text" name="username" id="username" class="form-control"
                                                    placeholder="masukkan username anda ...">
                                            </div>
                                        </div>
                                        <div class="my-2"></div>
                                        <div class="row justify-content-start align-items-center flex-wrap">
                                            <div class="form-label col-sm-3 col-md-3">
                                                <label for="" class="label label-default">Password</label>
                                            </div>
                                            <div class="col-sm-1 col-md-1">:</div>
                                            <div class="col-sm-7 col-md-7">
                                                <input type="password" name="password" id="password"
                                                    class="form-control" placeholder="masukkan password anda ...">
                                            </div>
                                        </div>
                                        <div class="my-2">
                                            <div class="row justify-content-start align-items-center flex-wrap">
                                                <div class="form-label col-sm-3 col-md-3">
                                                    <label for="" class="label label-default">Akses</label>
                                                </div>
                                                <div class="col-sm-1 col-md-1">:</div>
                                                <div class="col-sm-7 col-md-7">
                                                    <select name="akses" class="form-select" id="">
                                                        <option value="">=== Login Sebagai ===</option>
                                                        <option value="admin">admin</option>
                                                        <option value="pengguna">pengguna</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="my-2"></div>
                                        <div class="form-inline row justify-content-start
                                 align-items-start flex-wrap">
                                            <div class="form-label col-sm-4 col-md-4">
                                                <input type="hidden" name="angka1" value="<?= $angka1 ?>">
                                                <input type="hidden" name="angka2" value="<?= $angka2 ?>">
                                                <label for="" class="label label-default">
                                                    <?php echo $angka1 . " + " . $angka2; ?> = ?</label>
                                            </div>
                                            <div class="col-sm-5 col-md-5">
                                                <input type="number" class="form-control" aria-required="TRUE"
                                                    name="hasil" placeholder="Capthca" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer my-2">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-outline-light">
                                            <i class="fa fa-fw fa-sign-in-alt fa-1x"></i>
                                            <span>Sign In</span>
                                        </button>
                                        <button type="reset" class="btn btn-danger btn-outline-light">
                                            <i class="fas fa-fw fa-close fa-1x"></i>
                                            <span>Cancel</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="text-center">
                                <?php echo "&copy " . $setting['developer'] . ", " . date('Y'); ?>
                            </div>
                            <div class="text-center">
                                <a href="register.php" aria-current="page" class="btn btn-lnk">
                                    <i class="fas fa-registered fa-fw fa-1x"></i>
                                    Registerasi
                                </a>
                                <br>
                                <a href="index.php" aria-current="page" class="btn btn-info btn-outline-dark">
                                    Kembali Ke Halaman Utama
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <!-- === Layout Awal Script -->
    <!-- Layout Login Aplikasi Bank Sampah -->
    <script type="text/javascript">
    function startTime() {
        var day = ["minggu", "senin", "selasa", "rabu", "kamis", "jumat", "sabtu"];
        var month = ["januari", "februari", "maret", "april", "mei", "juni", "juli", "agustus", "september", "oktober",
            "november", "desember"
        ];
        var today = new Date();
        var h = today.getHours();
        var tahun = today.getFullYear();
        var m = today.getMinutes();
        var s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('days').innerHTML =
            " " + day[today.getDay()] + ", " + today.getDate() + " " + month[today.getMonth()] + " " + tahun;
        document.getElementById('clock').innerHTML =
            "Waktu Sekarang : " +
            h + " : " + m + " : " + s + "";
        var t = setTimeout(startTime, 500);
    }

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i
        }; // add zero in front of numbers < 10
        return i;
    }
    </script>
    <script crossorigin="anonymous" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>
    <script crossorigin="anonymous" src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js">
    </script>
    <script crossorigin="anonymous" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="preloader.js"></script>
    </body>

</html>